<x-layouts.landing
    :title="__('intake.thank_you.title')"
    :metaDescription="__('intake.meta_description')"
    robots="noindex, follow"
>
    @push('structured-data')
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => __('intake.thank_you.title'),
                'description' => __('intake.thank_you.subtitle'),
                'url' => \App\Support\LocalizedRoute::route('intake.thanks'),
                'inLanguage' => \App\Support\LocalizedRoute::languageTag(),
                'isPartOf' => [
                    '@id' => \App\Support\LocalizedRoute::route('home').'#website',
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endpush

    <section class="relative overflow-hidden py-20 md:py-28">
        <div class="absolute inset-0" aria-hidden="true" style="background: radial-gradient(ellipse 62% 48% at 20% 20%, rgba(191,231,214,0.20) 0%, transparent 70%), radial-gradient(ellipse 54% 52% at 82% 74%, rgba(111,168,216,0.18) 0%, transparent 74%);"></div>

        <div class="relative mx-auto max-w-3xl px-6 text-center reveal">
            <p class="font-accent text-xl text-petroleo">AcuarelaSoft</p>
            <h1 class="mt-2 font-heading text-4xl font-bold text-ink md:text-5xl">{{ __('intake.thank_you.title') }}</h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-ink/80 md:text-lg">{{ __('intake.thank_you.subtitle') }}</p>

            <a href="{{ \App\Support\LocalizedRoute::route('home') }}" class="mt-8 inline-flex rounded-soft bg-petroleo px-6 py-3 text-sm font-semibold text-paper transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo">
                {{ __('intake.thank_you.cta') }}
            </a>
        </div>
    </section>
</x-layouts.landing>
