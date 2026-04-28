<x-layouts.landing>

    {{-- JSON-LD: Organization + WebSite --}}
    @push('structured-data')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "AcuarelaSoft",
        "alternateName": "Acuarela Soft",
        "url": "https://acuarelasoft.dev",
        "description": "{{ __('landing.meta_description') }}",
        "email": "contacto@acuarelasoft.dev",
        "telephone": "+525649440190",
        "foundingDate": "2026",
        "address": {
            "@@type": "PostalAddress",
            "addressLocality": "Ciudad de México",
            "addressRegion": "CDMX",
            "addressCountry": "MX"
        },
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+525649440190",
            "email": "contacto@acuarelasoft.dev",
            "contactType": "sales"
        },
        "sameAs": [
            "https://www.linkedin.com/in/rodrigo-sanvicente/"
        ],
        "numberOfEmployees": {
            "@@type": "QuantitativeValue",
            "minValue": 2,
            "maxValue": 5
        },
        "knowsAbout": [
            "Laravel",
            "Angular",
            "Node.js",
            "PHP",
            "TypeScript",
            "MariaDB",
            "PostgreSQL",
            "AWS",
            "Docker",
            "Tailwind CSS"
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "AcuarelaSoft",
        "alternateName": "Acuarela Soft",
        "url": "https://acuarelasoft.dev"
    }
    </script>
    @endpush

    {{-- ============================================================
         HERO SECTION — Watercolor wash background
         ============================================================ --}}
    <section id="hero" class="relative min-h-[80vh] flex items-center overflow-hidden" aria-label="{{ __('landing.hero_headline') }}">
        {{-- Multi-color watercolor wash --}}
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 70% 50% at 15% 25%, rgba(111,168,216,0.20) 0%, transparent 70%),
                radial-gradient(ellipse 50% 60% at 80% 60%, rgba(242,184,178,0.15) 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 50% 85%, rgba(191,231,214,0.12) 0%, transparent 60%);">
        </div>

        <div class="max-w-4xl mx-auto px-6 py-20 text-center">
            <p class="font-accent text-acuarela-400 text-xl md:text-2xl mb-4">{{ __('landing.footer_tagline') }}</p>
            <h1 class="font-heading text-ink text-4xl sm:text-5xl md:text-6xl font-bold leading-tight mb-6">{{ __('landing.hero_headline') }}</h1>
            <p class="font-sans text-ink/75 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">{{ __('landing.hero_subheadline') }}</p>

            <nav class="flex flex-col sm:flex-row gap-4 justify-center mb-12" aria-label="{{ app()->getLocale() === 'es' ? 'Acciones principales' : 'Main actions' }}">
                <a href="#contacto" class="bg-petroleo text-paper font-sans font-medium px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base">
                    {{ __('landing.hero_cta_primary') }}
                </a>
                <a href="#servicios" class="bg-transparent text-petroleo font-sans font-medium px-8 py-3.5 rounded-soft border border-salmon transition-all duration-200 hover:bg-salmon/10 hover:border-salmon/80 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-salmon text-base">
                    {{ __('landing.hero_cta_secondary') }}
                </a>
            </nav>

            <ul class="flex flex-wrap justify-center gap-x-8 gap-y-3 font-sans text-sm text-ink/60" aria-label="{{ app()->getLocale() === 'es' ? 'Indicadores de confianza' : 'Trust indicators' }}">
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
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('landing.hero_trust_cloud') }}
                </li>
            </ul>
        </div>
    </section>

    {{-- Brush-stroke separator --}}
    <svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
        <path d="M0,15 Q100,5 200,14 T400,12 T600,16 T800,11 T1000,15 T1200,13" stroke="rgba(111,168,216,0.3)" stroke-width="3" fill="none" stroke-linecap="round"/>
    </svg>

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
            <a href="#contacto" class="inline-flex bg-petroleo text-paper font-sans font-medium px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base">
                {{ __('landing.mid_cta_button') }}
            </a>
        </div>
    </section>

    {{-- Brush-stroke separator --}}
    <svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
        <path d="M0,15 Q150,8 300,16 T600,12 T900,17 T1200,14" stroke="rgba(191,231,214,0.35)" stroke-width="3" fill="none" stroke-linecap="round"/>
    </svg>

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
         EARLY CLIENTS OFFER — Highlighted section
         ============================================================ --}}
    <section id="oferta" class="relative py-16 px-6 overflow-hidden reveal" aria-labelledby="offer-heading">
        <div class="absolute inset-0 -z-10" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 70% 60% at 25% 40%, rgba(242,184,178,0.15) 0%, transparent 65%),
                radial-gradient(ellipse 50% 50% at 80% 60%, rgba(111,168,216,0.12) 0%, transparent 60%);">
        </div>
        <div class="max-w-2xl mx-auto text-center">
            <h2 id="offer-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.offer_title') }}</h2>
            <p class="font-sans text-ink/70 text-lg leading-relaxed mb-8">{{ __('landing.offer_desc') }}</p>
            <a href="#contacto" class="inline-flex bg-petroleo text-paper font-sans font-medium px-8 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base">
                {{ __('landing.offer_cta') }}
            </a>
            <p class="mt-4 font-sans text-sm text-ink/50">{{ __('landing.offer_scarcity') }}</p>
        </div>
    </section>

    {{-- Brush-stroke separator --}}
    <svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
        <path d="M0,13 Q200,20 400,12 T800,16 T1200,14" stroke="rgba(242,184,178,0.3)" stroke-width="3" fill="none" stroke-linecap="round"/>
    </svg>

    {{-- ============================================================
         CONTACT FORM
         ============================================================ --}}
    <section id="contacto" class="py-20 px-6 reveal" aria-labelledby="contact-heading">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-12">
                <h2 id="contact-heading" class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">{{ __('landing.contact_title') }}</h2>
                <p class="font-sans text-ink/60 text-lg">{{ __('landing.contact_subtitle') }}</p>
            </div>

            @session('success')
                <div role="status" aria-live="polite" class="mb-8 p-4 rounded-soft bg-mint/20 border border-mint/40 text-center">
                    <p class="font-sans text-ink font-medium">{{ $value }}</p>
                </div>
            @endsession

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
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
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('name') ? 'border-salmon' : '' }}"
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
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('email') ? 'border-salmon' : '' }}"
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
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30"
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
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30"
                        >
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Project type --}}
                    <div>
                        <label for="project_type" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_project_type') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}" class="text-salmon no-underline">*</abbr></label>
                        <select
                            id="project_type"
                            name="project_type"
                            required
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 {{ $errors->has('project_type') ? 'border-salmon' : '' }}"
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

                    {{-- Budget --}}
                    <div>
                        <label for="budget" class="block font-sans text-sm font-medium text-ink mb-1.5">{{ __('landing.contact_budget') }}</label>
                        <select id="budget" name="budget"
                            class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15">
                            <option value="">{{ __('landing.contact_select_placeholder') }}</option>
                            <option value="under_20k" @selected(old('budget') === 'under_20k')>{{ __('landing.contact_budget_under_20k') }}</option>
                            <option value="20k_50k" @selected(old('budget') === '20k_50k')>{{ __('landing.contact_budget_20k_50k') }}</option>
                            <option value="50k_100k" @selected(old('budget') === '50k_100k')>{{ __('landing.contact_budget_50k_100k') }}</option>
                            <option value="over_100k" @selected(old('budget') === 'over_100k')>{{ __('landing.contact_budget_over_100k') }}</option>
                            <option value="unsure" @selected(old('budget') === 'unsure')>{{ __('landing.contact_budget_unsure') }}</option>
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
                        rows="5"
                        class="w-full px-4 py-3 rounded-soft bg-paper border border-acuarela-400/20 font-sans text-ink text-base transition-all duration-200 resize-y focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15 placeholder:text-ink/30 {{ $errors->has('message') ? 'border-salmon' : '' }}"
                        aria-describedby="message-hint {{ $errors->has('message') ? 'message-error' : '' }}"
                        {{ $errors->has('message') ? 'aria-invalid=true' : '' }}
                    >{{ old('message') }}</textarea>
                    <p id="message-hint" class="mt-1 font-sans text-xs text-ink/40">{{ app()->getLocale() === 'es' ? 'Máximo 500 caracteres.' : 'Maximum 500 characters.' }}</p>
                    @error('message')
                        <p id="message-error" role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="text-center pt-2">
                    <button type="submit" class="bg-petroleo text-paper font-sans font-medium px-10 py-3.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo text-base w-full sm:w-auto">
                        {{ __('landing.contact_submit') }}
                    </button>
                    <p class="mt-4 font-sans text-sm text-ink/50">{{ __('landing.contact_note') }}</p>
                    <p class="mt-1 font-sans text-xs text-ink/40">{{ __('landing.contact_privacy') }}</p>
                </div>
            </form>
        </div>
    </section>

</x-layouts.landing>
