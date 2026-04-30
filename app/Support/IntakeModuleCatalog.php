<?php

namespace App\Support;

class IntakeModuleCatalog
{
    /**
     * @return array<string, mixed>
     */
    public static function categories(): array
    {
        return config('intake.categories', []);
    }

    /**
     * @return array<string, mixed>
     */
    public static function presets(): array
    {
        return config('intake.presets', []);
    }

    /**
     * @return array<string, mixed>
     */
    public static function modules(): array
    {
        return config('intake.modules', []);
    }

    /**
     * @return list<string>
     */
    public static function moduleIds(): array
    {
        return array_keys(static::modules());
    }

    /**
     * @return array<string, mixed>
     */
    public static function module(string $moduleId): array
    {
        return static::modules()[$moduleId] ?? [];
    }
}
