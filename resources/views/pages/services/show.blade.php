<x-layouts.landing
    :title="__('services.' . $service['key'] . '.meta_title')"
    :metaDescription="__('services.' . $service['key'] . '.meta_description')"
>

    @push('structured-data')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => __('services.' . $service['key'] . '.badge'),
        'description' => __('services.' . $service['key'] . '.meta_description'),
        'provider' => [
            '@type' => 'Organization',
            'name' => 'AcuarelaSoft',
            'url' => \App\Support\LocalizedRoute::route('home', [], 'es'),
        ],
        'areaServed' => ['MX', 'US', 'LATAM'],
        'url' => \App\Support\LocalizedRoute::route('service', ['service' => $service['slug']]),
        'inLanguage' => \App\Support\LocalizedRoute::languageTag(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endpush

    {{-- ============================================================
         HERO
         ============================================================ --}}
    <section class="relative min-h-[52vh] flex items-center overflow-hidden" aria-labelledby="service-hero-heading">

        {{-- Watercolor wash background --}}
        <div class="absolute inset-0 -z-20 bg-paper" aria-hidden="true"></div>
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background-image:
                radial-gradient(ellipse 75% 65% at 8% 20%, rgba(111,168,216,0.20) 0%, transparent 68%),
                radial-gradient(ellipse 55% 50% at 88% 70%, rgba(242,184,178,0.14) 0%, transparent 62%),
                radial-gradient(ellipse 40% 38% at 50% 95%, rgba(191,231,214,0.12) 0%, transparent 55%);"></div>

        {{-- Decorative blobs --}}
        <div class="absolute top-12 right-10 w-14 h-14 rounded-2xl bg-[#F08A3C]/80 -z-10" aria-hidden="true"></div>
        <div class="absolute bottom-16 left-[42%] hidden lg:block w-10 h-10 rounded-2xl bg-acuarela-400/40 -z-10" aria-hidden="true"></div>

        <div class="max-w-6xl mx-auto px-6 pt-28 pb-20 md:pt-36 md:pb-28 w-full">
            {{-- Breadcrumb --}}
            <nav class="mb-8 flex items-center gap-2 font-sans text-sm text-ink/50" aria-label="{{ app()->getLocale() === 'es' ? 'Ruta de navegación' : 'Breadcrumb' }}">
                <a href="{{ \App\Support\LocalizedRoute::route('home') }}"
                   class="hover:text-petroleo transition-colors duration-200">
                    {{ app()->getLocale() === 'es' ? 'Inicio' : 'Home' }}
                </a>
                <svg class="w-3.5 h-3.5 text-ink/30" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                <span class="text-ink/70">{{ __('services.' . $service['key'] . '.badge') }}</span>
            </nav>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-xl">
                    {{-- Badge --}}
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-pill border border-acuarela-300/50 bg-acuarela-50/70 text-acuarela-700 font-sans text-sm font-semibold mb-6">
                        <span class="size-2 rounded-full bg-orange-400"></span>
                        {{ __('services.' . $service['key'] . '.badge') }}
                    </span>

                    <h1 id="service-hero-heading" class="font-heading text-ink text-4xl sm:text-5xl font-bold leading-[1.08] tracking-tight mb-5">
                        {{ __('services.' . $service['key'] . '.title') }}
                    </h1>

                    <p class="font-sans text-ink/70 text-lg md:text-xl leading-relaxed mb-5 italic">
                        {{ __('services.' . $service['key'] . '.tagline') }}
                    </p>

                    <p class="font-sans text-ink/65 text-base leading-relaxed mb-10">
                        {{ __('services.' . $service['key'] . '.description') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ \App\Support\LocalizedRoute::route('home') . '#contacto' }}"
                           class="bg-petroleo text-paper font-sans font-semibold px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base text-center">
                            {{ __('services.cta_contact') }}
                        </a>
                        <a href="{{ \App\Support\LocalizedRoute::route('intake') }}"
                           class="bg-paper/80 text-ink font-sans font-semibold px-8 py-3.5 rounded-soft border border-ink/15 transition-all duration-200 hover:bg-paper hover:border-ink/25 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-acuarela-400 text-base text-center">
                            {{ __('services.cta_intake') }}
                        </a>
                    </div>
                </div>

                {{-- Hero icon card --}}
                <div class="flex justify-center lg:justify-end">
                    <div class="w-full max-w-sm rounded-[18px] border border-acuarela-300/35 bg-paper/90 backdrop-blur-[3px] p-8 shadow-[0_4px_32px_rgba(46,107,120,0.07)]">
                        <div class="flex flex-col items-center text-center gap-6">
                            <div class="w-20 h-20 flex items-center justify-center rounded-2xl {{ $service['icon_bg'] }}">
                                <svg class="w-10 h-10 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon_path'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-heading text-ink text-xl font-semibold mb-2">{{ __('services.' . $service['key'] . '.badge') }}</p>
                                <p class="font-sans text-ink/60 text-sm leading-relaxed">{{ __('services.' . $service['key'] . '.tagline') }}</p>
                            </div>
                            <div class="w-full flex flex-wrap justify-center gap-2">
                                @foreach(array_slice($service['techs'], 0, 4) as $tech)
                                    <span class="px-3 py-1 rounded-pill bg-acuarela-400/10 font-sans text-xs font-medium text-petroleo border border-acuarela-400/20">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Brush-stroke separator --}}
    <svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
        <path d="M0,15 Q150,5 300,14 T600,12 T900,16 T1200,13" stroke="rgba(111,168,216,0.3)" stroke-width="3" fill="none" stroke-linecap="round"/>
    </svg>

    {{-- ============================================================
         FEATURES
         ============================================================ --}}
    <section class="relative py-20 px-6 md:py-28 overflow-hidden reveal" aria-labelledby="features-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background: radial-gradient(ellipse 70% 55% at 20% 35%, rgba(111,168,216,0.08) 0%, transparent 65%);"></div>

        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-14">
                <h2 id="features-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-3">{{ __('services.features_title') }}</h2>
            </div>

            <ul class="grid sm:grid-cols-2 gap-8 list-none">
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-11 h-11 mb-5 flex items-center justify-center rounded-soft {{ $service['icon_bg'] }}">
                            <svg class="w-5 h-5 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-ink text-lg font-semibold mb-2">{{ __('services.' . $service['key'] . '.feature_1_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('services.' . $service['key'] . '.feature_1_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-11 h-11 mb-5 flex items-center justify-center rounded-soft bg-salmon/15">
                            <svg class="w-5 h-5 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-ink text-lg font-semibold mb-2">{{ __('services.' . $service['key'] . '.feature_2_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('services.' . $service['key'] . '.feature_2_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-11 h-11 mb-5 flex items-center justify-center rounded-soft bg-mint/20">
                            <svg class="w-5 h-5 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-ink text-lg font-semibold mb-2">{{ __('services.' . $service['key'] . '.feature_3_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('services.' . $service['key'] . '.feature_3_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-11 h-11 mb-5 flex items-center justify-center rounded-soft bg-acuarela-400/10">
                            <svg class="w-5 h-5 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-ink text-lg font-semibold mb-2.5">{{ __('services.' . $service['key'] . '.feature_4_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('services.' . $service['key'] . '.feature_4_desc') }}</p>
                    </article>
                </li>
            </ul>
        </div>
    </section>

    {{-- ============================================================
         PROCESS
         ============================================================ --}}
    <section class="relative py-20 px-6 md:py-28 overflow-hidden reveal" aria-labelledby="process-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background: radial-gradient(ellipse 65% 50% at 80% 40%, rgba(242,184,178,0.10) 0%, transparent 65%);"></div>

        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-14">
                <h2 id="process-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-3">{{ __('services.process_title') }}</h2>
            </div>

            <ol class="relative ml-4 space-y-10 list-none border-l-2 border-acuarela-400/20">
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-0 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold shrink-0">1</span>
                    <p class="font-sans text-ink/75 text-base leading-relaxed pt-1">{{ __('services.' . $service['key'] . '.process_1') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-0 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold shrink-0">2</span>
                    <p class="font-sans text-ink/75 text-base leading-relaxed pt-1">{{ __('services.' . $service['key'] . '.process_2') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-0 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold shrink-0">3</span>
                    <p class="font-sans text-ink/75 text-base leading-relaxed pt-1">{{ __('services.' . $service['key'] . '.process_3') }}</p>
                </li>
            </ol>
        </div>
    </section>

    {{-- ============================================================
         TECH STACK
         ============================================================ --}}
    <section class="relative py-16 px-6 md:py-24 overflow-hidden reveal" aria-labelledby="tech-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background: radial-gradient(ellipse 60% 45% at 50% 50%, rgba(191,231,214,0.10) 0%, transparent 60%);"></div>

        <div class="max-w-4xl mx-auto text-center">
            <h2 id="tech-heading" class="font-heading text-ink text-2xl md:text-3xl font-bold mb-8">{{ __('services.tech_title') }}</h2>
            <ul class="flex flex-wrap justify-center gap-3 list-none" aria-label="{{ __('services.tech_title') }}">
                @foreach ($service['techs'] as $tech)
                    <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">
                        {{ $tech }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- ============================================================
         OTHER SERVICES
         ============================================================ --}}
    @php
        $otherServices = collect(config('site_services'))
            ->where('slug', '!=', $service['slug'])
            ->shuffle()
            ->take(3)
            ->values();
    @endphp
    <section class="py-20 px-6 md:py-28 reveal" aria-labelledby="related-heading">
        <div class="max-w-5xl mx-auto">
            <h2 id="related-heading" class="font-heading text-ink text-2xl md:text-3xl font-bold mb-8 text-center">{{ __('services.related_title') }}</h2>
            <ul class="grid sm:grid-cols-3 gap-6 list-none">
                @foreach ($otherServices as $other)
                    <li>
                        <a href="{{ \App\Support\LocalizedRoute::route('service', ['service' => $other['slug']]) }}"
                           class="group flex flex-col h-full bg-paper rounded-soft p-6 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 no-underline">
                            <div class="w-10 h-10 mb-4 flex items-center justify-center rounded-soft {{ $other['icon_bg'] }} transition-transform duration-200 group-hover:scale-110">
                                <svg class="w-5 h-5 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $other['icon_path'] }}"/>
                                </svg>
                            </div>
                            <h3 class="font-heading text-ink text-base font-semibold mb-1.5 group-hover:text-petroleo transition-colors duration-200">
                                {{ __('services.' . $other['key'] . '.badge') }}
                            </h3>
                            <p class="font-sans text-ink/60 text-sm leading-relaxed grow">
                                {{ __('services.' . $other['key'] . '.tagline') }}
                            </p>
                            <span class="mt-4 inline-flex items-center gap-1.5 font-sans text-sm font-medium text-petroleo">
                                {{ app()->getLocale() === 'es' ? 'Ver servicio' : 'View service' }}
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- ============================================================
         BOTTOM CTA
         ============================================================ --}}
    <section class="relative py-24 px-6 md:py-32 overflow-hidden reveal" aria-labelledby="cta-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 65% 65% at 25% 50%, rgba(242,184,178,0.14) 0%, transparent 62%),
                radial-gradient(ellipse 50% 50% at 80% 40%, rgba(191,231,214,0.10) 0%, transparent 58%);"></div>

        {{-- Subtle grid overlay --}}
        <div class="absolute inset-0 -z-10 opacity-40" aria-hidden="true"
             style="background-image: linear-gradient(to right, rgba(46,107,120,0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(46,107,120,0.05) 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="max-w-2xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-pill border border-orange-300/50 bg-orange-50/70 text-orange-700 font-sans text-sm font-semibold mb-6">
                <span class="size-2 rounded-full bg-orange-400"></span>
                {{ app()->getLocale() === 'es' ? 'Clientes Fundadores' : 'Founding Clients' }}
            </span>

            <h2 id="cta-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4 leading-tight">
                {{ __('services.' . $service['key'] . '.cta_title') }}
            </h2>
            <p class="font-sans text-ink/60 text-lg mb-10">
                {{ __('services.cta_section_subtitle') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16 md:mb-24">
                <a href="{{ \App\Support\LocalizedRoute::route('home') . '#contacto' }}"
                   class="bg-petroleo text-paper font-sans font-semibold px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base text-center">
                    {{ __('services.cta_contact') }}
                </a>
                <a href="{{ \App\Support\LocalizedRoute::route('intake') }}"
                   class="bg-paper/80 text-ink font-sans font-semibold px-8 py-3.5 rounded-soft border border-ink/15 transition-all duration-200 hover:bg-paper hover:border-ink/25 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-acuarela-400 text-base text-center">
                    {{ __('services.cta_intake') }}
                </a>
            </div>
        </div>
    </section>

</x-layouts.landing>
