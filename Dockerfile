# syntax=docker/dockerfile:1.7

FROM composer:2 AS composer_deps

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader


FROM node:22-bookworm-slim AS frontend_build

WORKDIR /app

COPY package.json package-lock.json* ./

# Flux imports CSS from vendor/, so it must exist in the frontend build stage.
COPY --from=composer_deps /app/vendor ./vendor

RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build


FROM dunglas/frankenphp:1-php8.4-bookworm AS app

WORKDIR /app

RUN install-php-extensions pcntl

# Bring Composer binary into runtime image for optimized autoload dumps if needed.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install only required PHP dependencies for production.
COPY --from=composer_deps /app/vendor ./vendor

# Copy application source.
COPY . .

# Use production environment file inside the container.
COPY .env.production .env

# Copy compiled frontend assets.
COPY --from=frontend_build /app/public/build ./public/build

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views \
    storage/logs bootstrap/cache database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data /app \
    && chmod -R ug+rwx storage bootstrap/cache \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8000

USER www-data

CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
