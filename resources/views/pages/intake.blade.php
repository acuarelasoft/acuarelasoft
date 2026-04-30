<x-layouts.landing
    :title="__('intake.meta_title')"
    :metaDescription="__('intake.meta_description')"
    :canonical="app()->getLocale() === 'en' ? route('intake.en') : route('intake')"
    :hreflangEs="route('intake')"
    :hreflangEn="route('intake.en')"
>
    @push('structured-data')
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => __('intake.hero_title'),
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'AcuarelaSoft',
                    'url' => url('/'),
                ],
                'serviceType' => 'Software requirements discovery',
                'areaServed' => ['MX', 'US'],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endpush

    <livewire:pages::intake />
</x-layouts.landing>
