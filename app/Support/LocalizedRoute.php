<?php

namespace App\Support;

class LocalizedRoute
{
    public const DEFAULT_LOCALE = 'es';

    /**
     * @var list<string>
     */
    public const SUPPORTED_LOCALES = ['es', 'en'];

    public static function resolveLocale(?string $locale = null): string
    {
        $resolvedLocale = $locale ?? app()->getLocale();

        return in_array($resolvedLocale, self::SUPPORTED_LOCALES, true)
            ? $resolvedLocale
            : self::DEFAULT_LOCALE;
    }

    public static function routeName(string $baseName, ?string $locale = null): string
    {
        $resolvedLocale = self::resolveLocale($locale);

        return $resolvedLocale === self::DEFAULT_LOCALE
            ? $baseName
            : $resolvedLocale.'.'.$baseName;
    }

    /**
     * Use an array for standard named-route parameters, or a string when the
     * underlying route has a single wildcard segment.
     *
     * @param  array<string, mixed>|string  $parameters
     */
    public static function route(string $baseName, array|string $parameters = [], ?string $locale = null, bool $absolute = true): string
    {
        return route(self::routeName($baseName, $locale), $parameters, $absolute);
    }

    /**
     * @param  array<string, mixed>|string  $parameters
     * @return array<string, string>
     */
    public static function alternates(string $baseName, array|string $parameters = []): array
    {
        return [
            'es-MX' => self::route($baseName, $parameters, 'es'),
            'en' => self::route($baseName, $parameters, 'en'),
            'x-default' => self::route($baseName, $parameters, 'es'),
        ];
    }

    public static function languageTag(?string $locale = null): string
    {
        return self::resolveLocale($locale) === 'es' ? 'es-MX' : 'en';
    }

    public static function ogLocale(?string $locale = null): string
    {
        return self::resolveLocale($locale) === 'es' ? 'es_MX' : 'en_US';
    }

    public static function alternateOgLocale(?string $locale = null): string
    {
        return self::resolveLocale($locale) === 'es' ? 'en_US' : 'es_MX';
    }
}
