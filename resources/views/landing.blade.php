<x-layouts.landing>

    @if (session()->has('success_key') || session()->has('success'))
        <div id="contact-success-banner" class="fixed inset-x-0 top-8 z-90 px-4 sm:px-6 pointer-events-none">
            <div role="status" aria-live="polite" class="mx-auto max-w-3xl pointer-events-auto rounded-soft border border-mint/45 bg-paper/95 backdrop-blur px-4 py-3 shadow-lg shadow-petroleo/10 sm:px-5">
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-mint/45 text-petroleo" aria-hidden="true">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    </span>

                    <p class="flex-1 font-sans text-sm sm:text-base text-ink font-medium leading-relaxed">
                        {{ session()->has('success_key') ? __(session('success_key')) : session('success') }}
                    </p>

                    <button
                        type="button"
                        onclick="document.getElementById('contact-success-banner')?.remove()"
                        class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-soft text-ink/60 transition hover:bg-acuarela-100 hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo"
                        aria-label="{{ __('landing.contact_success_close') }}"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- JSON-LD: Organization + WebSite --}}
    @push('structured-data')
    <script type="application/ld+json">
    {!! json_encode([
        '@'.'context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => \App\Support\LocalizedRoute::route('home', [], 'es').'#organization',
        'name' => 'AcuarelaSoft',
        'alternateName' => 'Acuarela Soft',
        'url' => \App\Support\LocalizedRoute::route('home', [], 'es'),
        'description' => __('landing.meta_description'),
        'email' => 'contacto@acuarelasoft.com',
        'telephone' => '+525649440190',
        'foundingDate' => '2026',
        'areaServed' => [
            ['@type' => 'Country', 'name' => 'Mexico'],
            ['@type' => 'Country', 'name' => 'United States'],
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Ciudad de México',
            'addressRegion' => 'CDMX',
            'addressCountry' => 'MX',
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => '+525649440190',
            'email' => 'contacto@acuarelasoft.com',
            'contactType' => 'sales',
            'availableLanguage' => ['es', 'en'],
            'areaServed' => 'MX',
        ],
        'sameAs' => [
            'https://www.linkedin.com/in/rodrigo-sanvicente/',
            'https://github.com/acuarelasoft/',
        ],
        'numberOfEmployees' => [
            '@type' => 'QuantitativeValue',
            'minValue' => 2,
            'maxValue' => 5,
        ],
        'knowsAbout' => [
            'Laravel',
            'Angular',
            'Node.js',
            'PHP',
            'TypeScript',
            'MariaDB',
            'PostgreSQL',
            'AWS',
            'Docker',
            'Tailwind CSS',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@'.'context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => \App\Support\LocalizedRoute::route('home').'#website',
        'name' => 'AcuarelaSoft',
        'alternateName' => 'Acuarela Soft',
        'url' => \App\Support\LocalizedRoute::route('home'),
        'inLanguage' => \App\Support\LocalizedRoute::languageTag(),
        'publisher' => [
            '@id' => \App\Support\LocalizedRoute::route('home', [], 'es').'#organization',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endpush

    {{-- ============================================================
         HERO SECTION — Split composition inspired by product mockup
         ============================================================ --}}
    <section id="hero" class="relative min-h-[86vh] flex items-center overflow-hidden" aria-label="El arte de crear software">
        <div class="absolute inset-0 -z-20 bg-paper" aria-hidden="true"></div>
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background-image:
                linear-gradient(to right, rgba(46,107,120,0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(46,107,120,0.08) 1px, transparent 1px),
                radial-gradient(ellipse 78% 58% at 14% 26%, rgba(111,168,216,0.22) 0%, transparent 70%),
                radial-gradient(ellipse 60% 52% at 84% 62%, rgba(242,184,178,0.16) 0%, transparent 64%),
                radial-gradient(ellipse 44% 42% at 56% 85%, rgba(191,231,214,0.14) 0%, transparent 58%);
                background-size: 32px 32px, 32px 32px, auto, auto, auto;
                background-position: center;"></div>

        <div class="absolute top-16 right-8 md:right-16 w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-[#F08A3C]/90 -z-10" aria-hidden="true"></div>
        <div class="absolute bottom-18 left-[48%] hidden md:block w-18 h-18 rounded-3xl bg-acuarela-400/55 blur-[0.5px] -z-10" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-6 py-18 md:py-24 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-pill border border-acuarela-300/50 bg-acuarela-50/70 text-acuarela-700 font-sans text-sm font-semibold mb-6">
                        <span class="size-2 rounded-full bg-orange-400"></span>
                        {{ app()->getLocale() === 'es' ? 'Desarrollo de software a medida' : 'Custom software development' }}
                    </span>

                    <h1 class="font-heading text-ink text-4xl sm:text-5xl md:text-6xl font-bold leading-[1.06] tracking-tight mb-6">
                        {{ app()->getLocale() === 'es' ? 'El arte de' : 'The art of' }}
                        <span class="block bg-clip-text text-transparent" style="background-image: linear-gradient(96deg, #4C62D7 0%, #915489 47%, #DB6E2F 100%);">
                            {{ app()->getLocale() === 'es' ? 'crear software' : 'crafting software' }}
                        </span>
                    </h1>

                    <p class="font-sans text-ink/78 text-lg md:text-2xl max-w-2xl mb-10 leading-relaxed">
                        {{ __('landing.hero_subheadline') }}
                    </p>

                    <nav class="flex flex-col sm:flex-row gap-4 mb-10" aria-label="{{ app()->getLocale() === 'es' ? 'Acciones principales' : 'Main actions' }}">
                        <a href="#contacto" class="bg-petroleo text-paper font-sans font-semibold px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base text-center">
                            {{ __('landing.hero_cta_primary') }}
                        </a>
                        <a href="#servicios" class="bg-paper/80 text-ink font-sans font-semibold px-8 py-3.5 rounded-soft border border-ink/15 transition-all duration-200 hover:bg-paper hover:border-ink/25 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-acuarela-400 text-base text-center">
                            {{ __('landing.hero_cta_secondary') }}
                        </a>
                    </nav>

                    <ul class="flex flex-wrap gap-x-7 gap-y-3 font-sans text-sm text-ink/60" aria-label="{{ app()->getLocale() === 'es' ? 'Indicadores de confianza' : 'Trust indicators' }}">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('landing.hero_trust_experience') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('landing.hero_trust_stack') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('landing.hero_trust_ux') }}
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <div class="rounded-[18px] border border-acuarela-300/35 bg-paper/90 backdrop-blur-[3px] p-3 sm:p-4">
                        <div class="rounded-[14px] border border-acuarela-300/25 bg-white/75 overflow-hidden">
                            <div class="h-10 px-4 flex items-center justify-between border-b border-acuarela-300/20 bg-paper/70">
                                <div class="flex items-center gap-2">
                                    <span class="size-2.5 rounded-full bg-red-300"></span>
                                    <span class="size-2.5 rounded-full bg-amber-300"></span>
                                    <span class="size-2.5 rounded-full bg-emerald-400"></span>
                                </div>
                                <span class="w-26 h-2 rounded-pill bg-ink/8"></span>
                            </div>

                            <div class="p-4 sm:p-5 space-y-4">
                                <div class="grid grid-cols-3 gap-2 sm:gap-3">
                                    <div class="rounded-soft border border-acuarela-200/70 bg-paper/70 p-3">
                                        <span class="w-8 h-1.5 block rounded-pill bg-ink/12 mb-2"></span>
                                        <p class="font-sans text-xl text-ink font-semibold leading-none">516</p>
                                        <p class="font-sans text-xs text-emerald-500 mt-1">+12.5%</p>
                                    </div>
                                    <div class="rounded-soft border border-acuarela-200/70 bg-paper/70 p-3">
                                        <span class="w-8 h-1.5 block rounded-pill bg-ink/12 mb-2"></span>
                                        <p class="font-sans text-xl text-ink font-semibold leading-none">1,444</p>
                                        <p class="font-sans text-xs text-emerald-500 mt-1">+8.2%</p>
                                    </div>
                                    <div class="rounded-soft border border-acuarela-200/70 bg-paper/70 p-3">
                                        <span class="w-8 h-1.5 block rounded-pill bg-ink/12 mb-2"></span>
                                        <p class="font-sans text-xl text-ink font-semibold leading-none">91</p>
                                        <p class="font-sans text-xs text-emerald-500 mt-1">+24.1%</p>
                                    </div>
                                </div>

                                <div class="h-36 rounded-soft border border-acuarela-200/70 bg-linear-to-r from-acuarela-100/40 via-salmon/15 to-acuarela-300/25 relative overflow-hidden">
                                    <div class="absolute inset-x-0 bottom-0 h-[68%]" style="background: linear-gradient(90deg, rgba(108,112,255,0.75) 0%, rgba(118,96,214,0.65) 22%, rgba(226,118,52,0.80) 52%, rgba(120,110,239,0.70) 77%, rgba(143,151,255,0.70) 100%); clip-path: polygon(0 68%, 12% 58%, 24% 63%, 38% 40%, 49% 45%, 61% 22%, 71% 26%, 83% 14%, 100% 18%, 100% 100%, 0 100%);"></div>
                                </div>

                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="size-6 rounded-full bg-acuarela-300/55"></span>
                                        <span class="h-2.5 w-full rounded-pill bg-ink/10"></span>
                                        <span class="px-2 py-0.5 rounded-soft bg-mint/35 font-sans text-[11px] text-emerald-700">Done</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="size-6 rounded-full bg-salmon/45"></span>
                                        <span class="h-2.5 w-full rounded-pill bg-ink/10"></span>
                                        <span class="px-2 py-0.5 rounded-soft bg-acuarela-100 font-sans text-[11px] text-acuarela-700">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Brush-stroke separator --}}
    <svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
        <path d="M0,15 Q100,5 200,14 T400,12 T600,16 T800,11 T1000,15 T1200,13" stroke="rgba(111,168,216,0.3)" stroke-width="3" fill="none" stroke-linecap="round"/>
    </svg>

    {{-- ============================================================
         FEATURED WORK SLIDER
         ============================================================ --}}
    <section id="muestras" class="relative py-20 px-6 overflow-hidden reveal" aria-labelledby="slider-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 68% 50% at 24% 38%, rgba(111,168,216,0.10) 0%, transparent 70%),
                radial-gradient(ellipse 56% 45% at 78% 62%, rgba(242,184,178,0.10) 0%, transparent 65%);"></div>

        @php
            $sliderCards = [
                [
                    'slug' => 'web-design',
                    'label' => __('landing.slider_web_design_label'),
                    'title' => __('landing.slider_web_design_title'),
                    'description' => __('landing.slider_web_design_desc'),
                    'image' => asset('assets/solutions/websites.jpeg'),
                ],
                [
                    'slug' => 'web-apps',
                    'label' => __('landing.slider_web_apps_label'),
                    'title' => __('landing.slider_web_apps_title'),
                    'description' => __('landing.slider_web_apps_desc'),
                    'image' => asset('assets/solutions/web-apps.jpeg'),
                ],
                [
                    'slug' => 'mobile-apps',
                    'label' => __('landing.slider_mobile_apps_label'),
                    'title' => __('landing.slider_mobile_apps_title'),
                    'description' => __('landing.slider_mobile_apps_desc'),
                    'image' => asset('assets/solutions/mobile-apps.jpeg'),
                ],
                [
                    'slug' => 'app-maintenance',
                    'label' => __('landing.slider_maintenance_label'),
                    'title' => __('landing.slider_maintenance_title'),
                    'description' => __('landing.slider_maintenance_desc'),
                    'image' => asset('assets/solutions/maintenance.jpeg'),
                ],
                [
                    'slug' => 'legacy-migration',
                    'label' => __('landing.slider_legacy_label'),
                    'title' => __('landing.slider_legacy_title'),
                    'description' => __('landing.slider_legacy_desc'),
                    'image' => asset('assets/solutions/legacy-migration.jpeg'),
                ],
                [
                    'slug' => 'web-servers',
                    'label' => __('landing.slider_servers_label'),
                    'title' => __('landing.slider_servers_title'),
                    'description' => __('landing.slider_servers_desc'),
                    'image' => asset('assets/solutions/servers.jpeg'),
                ],
                [
                    'slug' => 'desktop-apps',
                    'label' => __('landing.slider_desktop_label'),
                    'title' => __('landing.slider_desktop_title'),
                    'description' => __('landing.slider_desktop_desc'),
                    'image' => asset('assets/solutions/desktop-apps.jpeg'),
                ],
                [
                    'slug' => 'web-apis',
                    'label' => __('landing.slider_web_api_label'),
                    'title' => __('landing.slider_web_api_title'),
                    'description' => __('landing.slider_web_api_desc'),
                    'image' => asset('assets/solutions/web-api.jpeg'),
                ],
            ];
        @endphp

        <div class="max-w-6xl mx-auto">
            <div class="mb-8 md:mb-10">
                <h2 id="slider-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-2">{{ __('landing.slider_title') }}</h2>
                <p class="font-sans text-ink/60 text-base md:text-lg">{{ __('landing.slider_subtitle') }}</p>
            </div>

            <ul class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($sliderCards as $card)
                    <li>
                        <a href="{{ \App\Support\LocalizedRoute::route('service', ['service' => $card['slug']]) }}" class="group block h-full rounded-soft border border-acuarela-400/20 bg-paper overflow-hidden transition-all duration-250 hover:-translate-y-0.5 hover:border-acuarela-400/35 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo" aria-label="{{ __('landing.offer_cta') }}: {{ $card['title'] }}">
                            <div class="relative h-44">
                                <div class="absolute inset-0" style="background-image: url('{{ $card['image'] }}'); background-size: cover; background-position: center;"></div>
                                <div class="absolute inset-0 bg-linear-to-tr from-petroleo/25 via-acuarela-400/10 to-salmon/15"></div>
                                <div class="absolute top-4 left-4 inline-flex px-3 py-1 rounded-pill bg-paper/90 text-petroleo font-sans text-xs font-semibold">
                                    {{ $card['label'] }}
                                </div>
                            </div>

                            <div class="p-5 flex items-start gap-4">
                                <div class="grow">
                                    <h3 class="font-heading text-ink text-lg font-semibold mb-2">{{ $card['title'] }}</h3>
                                    <p class="font-sans text-sm text-ink/70 leading-relaxed">{{ $card['description'] }}</p>
                                </div>

                                <span class="shrink-0 inline-flex items-center justify-center size-10 rounded-full bg-paper border border-acuarela-400/25 text-petroleo transition-colors duration-200 group-hover:bg-acuarela-50 group-hover:border-acuarela-400/45" aria-hidden="true">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- ============================================================
        MID-PAGE CTA — Watercolor wash accent
        ============================================================ --}}
    <section id="cta-mid" class="relative py-16 px-6 overflow-hidden reveal" aria-labelledby="mid-cta-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 60% 70% at 30% 50%, rgba(242,184,178,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 75% 40%, rgba(191,231,214,0.10) 0%, transparent 55%);">
        </div>
        <div class="max-w-2xl mx-auto text-center">
            <h2 id="mid-cta-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.mid_cta_title') }}</h2>
            <p class="font-sans text-ink/60 text-lg mb-8">{{ __('landing.mid_cta_subtitle') }}</p>
            <a href="{{ \App\Support\LocalizedRoute::route('intake') }}" class="inline-flex bg-petroleo text-paper font-sans font-medium px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base">
                {{ __('landing.mid_cta_button') }}
            </a>
        </div>
    </section>

    {{-- ============================================================
         PROCESS — Timeline style
         ============================================================ --}}
    <section id="proceso" class="py-20 px-6 reveal" aria-labelledby="process-heading">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 id="process-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.process_title') }}</h2>
                <p class="font-sans text-ink/60 text-lg max-w-xl mx-auto">{{ __('landing.process_subtitle') }}</p>
            </div>

            <ol class="relative border-l-2 border-acuarela-400/20 ml-4 space-y-10 list-none">
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold">1</span>
                    <h3 class="font-heading text-ink text-xl font-semibold mb-2">{{ __('landing.process_1_name') }}</h3>
                    <p class="font-sans text-ink/70 leading-relaxed">{{ __('landing.process_1_desc') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold">2</span>
                    <h3 class="font-heading text-ink text-xl font-semibold mb-2">{{ __('landing.process_2_name') }}</h3>
                    <p class="font-sans text-ink/70 leading-relaxed">{{ __('landing.process_2_desc') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold">3</span>
                    <h3 class="font-heading text-ink text-xl font-semibold mb-2">{{ __('landing.process_3_name') }}</h3>
                    <p class="font-sans text-ink/70 leading-relaxed">{{ __('landing.process_3_desc') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold">4</span>
                    <h3 class="font-heading text-ink text-xl font-semibold mb-2">{{ __('landing.process_4_name') }}</h3>
                    <p class="font-sans text-ink/70 leading-relaxed">{{ __('landing.process_4_desc') }}</p>
                </li>
                <li class="pl-10 relative">
                    <span class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-petroleo text-paper flex items-center justify-center font-sans text-sm font-bold">5</span>
                    <h3 class="font-heading text-ink text-xl font-semibold mb-2">{{ __('landing.process_5_name') }}</h3>
                    <p class="font-sans text-ink/70 leading-relaxed">{{ __('landing.process_5_desc') }}</p>
                </li>
            </ol>
        </div>
    </section>

    {{-- ============================================================
         PROBLEM → SOLUTION
         ============================================================ --}}
    <section id="problemas" class="relative py-20 px-6 overflow-hidden reveal" aria-labelledby="problems-heading">
        {{-- Subtle blue wash --}}
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background: radial-gradient(ellipse 80% 60% at 20% 30%, rgba(111,168,216,0.10) 0%, transparent 70%);"></div>

        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-14">
                <h2 id="problems-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.problems_title') }}</h2>
                <p class="font-sans text-ink/60 text-lg max-w-xl mx-auto">{{ __('landing.problems_subtitle') }}</p>
            </div>

            <dl class="grid gap-8">
                <div class="bg-paper rounded-soft p-6 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5">
                    <dt class="font-heading text-ink text-lg font-semibold mb-2 flex items-start gap-3">
                        <span class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-salmon/20 text-salmon">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        </span>
                        {{ __('landing.pain_1') }}
                    </dt>
                    <dd class="font-sans text-ink/70 leading-relaxed ml-11">
                        <span class="text-petroleo font-medium">→</span> {{ __('landing.solution_1') }}
                    </dd>
                </div>
                <div class="bg-paper rounded-soft p-6 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5">
                    <dt class="font-heading text-ink text-lg font-semibold mb-2 flex items-start gap-3">
                        <span class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-salmon/20 text-salmon">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        </span>
                        {{ __('landing.pain_2') }}
                    </dt>
                    <dd class="font-sans text-ink/70 leading-relaxed ml-11">
                        <span class="text-petroleo font-medium">→</span> {{ __('landing.solution_2') }}
                    </dd>
                </div>
                <div class="bg-paper rounded-soft p-6 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5">
                    <dt class="font-heading text-ink text-lg font-semibold mb-2 flex items-start gap-3">
                        <span class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-salmon/20 text-salmon">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        </span>
                        {{ __('landing.pain_3') }}
                    </dt>
                    <dd class="font-sans text-ink/70 leading-relaxed ml-11">
                        <span class="text-petroleo font-medium">→</span> {{ __('landing.solution_3') }}
                    </dd>
                </div>
            </dl>
        </div>
    </section>

    {{-- ============================================================
         SERVICES
         ============================================================ --}}
    <section id="servicios" class="py-20 px-6 reveal" aria-labelledby="services-heading">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 id="services-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.services_title') }}</h2>
                <p class="font-sans text-ink/60 text-lg max-w-xl mx-auto">{{ __('landing.services_subtitle') }}</p>
            </div>

            <ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 list-none">
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-acuarela-400/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_laravel_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_laravel_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_laravel_benefit') }}</em></p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-salmon/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_angular_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_angular_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_angular_benefit') }}</em></p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-mint/20">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_node_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_node_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_node_benefit') }}</em></p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-acuarela-400/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_db_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_db_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_db_benefit') }}</em></p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-salmon/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_cloud_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_cloud_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_cloud_benefit') }}</em></p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-mint/20">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.service_consulting_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed mb-3">{{ __('landing.service_consulting_desc') }}</p>
                        <p class="font-sans text-petroleo text-sm font-medium"><em>{{ __('landing.service_consulting_benefit') }}</em></p>
                    </article>
                </li>
            </ul>
        </div>
    </section>




    {{-- ============================================================
         TECHNOLOGIES — Pill badges
         ============================================================ --}}
    <section id="tecnologias" class="relative py-16 px-6 overflow-hidden reveal" aria-labelledby="tech-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background: radial-gradient(ellipse 70% 50% at 60% 50%, rgba(111,168,216,0.08) 0%, transparent 65%);"></div>

        <div class="max-w-4xl mx-auto text-center">
            <h2 id="tech-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.tech_title') }}</h2>
            <p class="font-sans text-ink/60 text-lg mb-10">{{ __('landing.tech_subtitle') }}</p>

            <ul class="flex flex-wrap justify-center gap-3 list-none" aria-label="{{ __('landing.tech_title') }}">
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Laravel</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Angular</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Node.js</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">PHP</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">TypeScript</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">MariaDB</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">PostgreSQL</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">AWS</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Docker</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Tailwind CSS</li>
                <li class="px-5 py-2.5 rounded-pill bg-paper border border-acuarela-400/20 font-sans text-sm font-medium text-ink/80 transition-all duration-200 hover:border-acuarela-400/40 hover:text-petroleo">Git</li>
            </ul>
        </div>
    </section>



    {{-- ============================================================
         WHY US
         ============================================================ --}}
    <section id="por-que-nosotros" class="py-20 px-6 reveal" aria-labelledby="why-heading">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 id="why-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.why_title') }}</h2>
                <p class="font-sans text-ink/60 text-lg max-w-xl mx-auto">{{ __('landing.why_subtitle') }}</p>
            </div>

            <ul class="grid md:grid-cols-2 gap-8 list-none">
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-acuarela-400/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.why_experience_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('landing.why_experience_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-salmon/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.why_design_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('landing.why_design_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-mint/20">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L12 12.75 6.429 9.75m11.142 0l4.179 2.25-9.75 5.25-9.75-5.25 4.179-2.25"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.why_fullstack_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('landing.why_fullstack_desc') }}</p>
                    </article>
                </li>
                <li>
                    <article class="bg-paper rounded-soft p-8 border border-acuarela-400/15 transition-all duration-250 hover:border-acuarela-400/30 hover:-translate-y-0.5 h-full">
                        <div class="w-12 h-12 mb-5 flex items-center justify-center rounded-soft bg-acuarela-400/10">
                            <svg class="w-6 h-6 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                        </div>
                        <h3 class="font-heading text-ink text-xl font-semibold mb-3">{{ __('landing.why_communication_title') }}</h3>
                        <p class="font-sans text-ink/70 text-base leading-relaxed">{{ __('landing.why_communication_desc') }}</p>
                    </article>
                </li>
            </ul>
        </div>
    </section>



    {{-- ============================================================
         SCHEDULE A CALL — Early offer + scheduling form (merged)
         ============================================================ --}}
    <section id="contacto" class="relative py-20 px-6 overflow-hidden reveal" aria-labelledby="contact-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 65% 70% at 5% 55%, rgba(242,184,178,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 55% at 92% 25%, rgba(111,168,216,0.10) 0%, transparent 55%),
                radial-gradient(ellipse 40% 40% at 50% 98%, rgba(191,231,214,0.10) 0%, transparent 50%);">
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                {{-- Left: Offer content --}}
                <div class="lg:sticky lg:top-24">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-pill border border-orange-300/50 bg-orange-50/70 text-orange-700 font-sans text-sm font-semibold mb-6">
                        <span class="size-2 rounded-full bg-orange-400"></span>
                        {{ __('landing.offer_badge') }}
                    </span>

                    <h2 id="contact-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-5 leading-tight">
                        {{ __('landing.offer_title') }}
                    </h2>

                    <p class="font-sans text-ink/70 text-lg leading-relaxed mb-8">{{ __('landing.offer_desc') }}</p>

                    <ul class="space-y-4 mb-8 list-none">
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 shrink-0 size-5 rounded-full bg-mint/30 flex items-center justify-center">
                                <svg class="w-3 h-3 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </span>
                            <span class="font-sans text-ink/80 text-base">{{ __('landing.offer_benefit_1') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 shrink-0 size-5 rounded-full bg-mint/30 flex items-center justify-center">
                                <svg class="w-3 h-3 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </span>
                            <span class="font-sans text-ink/80 text-base">{{ __('landing.offer_benefit_2') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 shrink-0 size-5 rounded-full bg-mint/30 flex items-center justify-center">
                                <svg class="w-3 h-3 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </span>
                            <span class="font-sans text-ink/80 text-base">{{ __('landing.offer_benefit_3') }}</span>
                        </li>
                    </ul>

                    <p class="font-sans text-sm text-ink/50 flex items-center gap-2">
                        <svg class="w-4 h-4 text-salmon/70 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        {{ __('landing.offer_scarcity') }}
                    </p>
                </div>

                {{-- Right: Scheduling form --}}
                <div>
                    <div class="mb-6">
                        <h3 class="font-heading text-ink text-xl font-semibold mb-1">{{ __('landing.contact_title') }}</h3>
                        <p class="font-sans text-ink/60 text-base">{{ __('landing.contact_subtitle') }}</p>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="bg-paper/95 rounded-soft border border-acuarela-400/20 p-6 md:p-8 space-y-6 shadow-sm">
                        @csrf

                        {{-- Honeypot anti-spam --}}
                        <div aria-hidden="true" hidden>
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_name') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}" class="text-salmon no-underline">*</abbr></label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                    autocomplete="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('name') ? 'border-salmon' : '' }}"
                                    aria-describedby="{{ $errors->has('name') ? 'name-error' : '' }}"
                                    {{ $errors->has('name') ? 'aria-invalid=true' : '' }}
                                >
                                @error('name')
                                    <p id="name-error" role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_email') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}" class="text-salmon no-underline">*</abbr></label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                    autocomplete="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('email') ? 'border-salmon' : '' }}"
                                    aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}"
                                    {{ $errors->has('email') ? 'aria-invalid=true' : '' }}
                                >
                                @error('email')
                                    <p id="email-error" role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Company --}}
                            <div>
                                <label for="company" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_company') }}</label>
                                <input
                                    type="text"
                                    id="company"
                                    name="company"
                                    autocomplete="organization"
                                    value="{{ old('company') }}"
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30"
                                >
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_phone') }}</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    autocomplete="tel"
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30"
                                >
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Topic --}}
                            <div>
                                <label for="project_type" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_topic') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}" class="text-salmon no-underline">*</abbr></label>
                                <select
                                    id="project_type"
                                    name="project_type"
                                    required
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 {{ $errors->has('project_type') ? 'border-salmon' : '' }}"
                                    aria-describedby="{{ $errors->has('project_type') ? 'project-type-error' : '' }}"
                                    {{ $errors->has('project_type') ? 'aria-invalid=true' : '' }}
                                >
                                    <option value="">{{ __('landing.contact_select_placeholder') }}</option>
                                    <option value="new" @selected(old('project_type') === 'new')>{{ __('landing.contact_project_type_new') }}</option>
                                    <option value="modernization" @selected(old('project_type') === 'modernization')>{{ __('landing.contact_project_type_modernization') }}</option>
                                    <option value="consulting" @selected(old('project_type') === 'consulting')>{{ __('landing.contact_project_type_consulting') }}</option>
                                    <option value="other" @selected(old('project_type') === 'other')>{{ __('landing.contact_project_type_other') }}</option>
                                </select>
                                @error('project_type')
                                    <p id="project-type-error" role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Availability --}}
                            <div>
                                <label for="availability" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_availability') }}</label>
                                <select
                                    id="availability"
                                    name="availability"
                                    class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15"
                                >
                                    <option value="">{{ __('landing.contact_select_placeholder') }}</option>
                                    <option value="morning" @selected(old('availability') === 'morning')>{{ __('landing.contact_availability_morning') }}</option>
                                    <option value="afternoon" @selected(old('availability') === 'afternoon')>{{ __('landing.contact_availability_afternoon') }}</option>
                                    <option value="evening" @selected(old('availability') === 'evening')>{{ __('landing.contact_availability_evening') }}</option>
                                    <option value="flexible" @selected(old('availability') === 'flexible')>{{ __('landing.contact_availability_flexible') }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_message') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}" class="text-salmon no-underline">*</abbr></label>
                            <textarea
                                id="message"
                                name="message"
                                required
                                maxlength="500"
                                rows="4"
                                class="w-full px-4 py-3 rounded-soft bg-white border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 resize-y focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('message') ? 'border-salmon' : '' }}"
                                aria-describedby="message-hint {{ $errors->has('message') ? 'message-error' : '' }}"
                                {{ $errors->has('message') ? 'aria-invalid=true' : '' }}
                            >{{ old('message') }}</textarea>
                            <p id="message-hint" class="mt-1 font-sans text-xs text-ink/40">{{ app()->getLocale() === 'es' ? 'Máximo 500 caracteres.' : 'Maximum 500 characters.' }}</p>
                            @error('message')
                                <p id="message-error" role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Turnstile CAPTCHA --}}
                        @production
                        <div>
                            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.sitekey') }}" data-theme="light"></div>
                            @error('cf-turnstile-response')
                                <p role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                            @enderror
                        </div>
                        @endproduction

                        {{-- Submit --}}
                        <div class="pt-2">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-petroleo text-paper font-sans font-medium px-10 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                {{ __('landing.contact_submit') }}
                            </button>
                            <p class="mt-4 font-sans text-sm text-ink/50 text-center">{{ __('landing.contact_note') }}</p>
                            <p class="mt-1 font-sans text-xs text-ink/40 text-center">{{ __('landing.contact_privacy') }}</p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</x-layouts.landing>
