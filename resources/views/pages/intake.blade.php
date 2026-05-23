<x-layouts.landing
    :title="__('intake.meta_title')"
    :metaDescription="__('intake.meta_description')"
>
    @push('structured-data')
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => __('intake.hero_title'),
                'description' => __('intake.meta_description'),
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'AcuarelaSoft',
                    'url' => \App\Support\LocalizedRoute::route('home', [], 'es'),
                ],
                'serviceType' => 'Software requirements discovery',
                'areaServed' => ['MX', 'US'],
                'url' => \App\Support\LocalizedRoute::route('intake'),
                'inLanguage' => \App\Support\LocalizedRoute::languageTag(),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endpush

    <livewire:pages::intake />
</x-layouts.landing>
