<?php

namespace App\Support;

class LocalizedRoute
{
    /**
     * Use an array for standard named-route parameters, or a string when the
     * underlying route has a single wildcard segment.
     *
     * @param  array<string, mixed>|string  $parameters
     */
    public static function route(string $baseName, array|string $parameters = []): string
    {
        return route($baseName, $parameters);
    }

    public static function languageTag(): string
    {
        return 'es-MX';
    }

    public static function ogLocale(): string
    {
        return 'es_MX';
    }
}
