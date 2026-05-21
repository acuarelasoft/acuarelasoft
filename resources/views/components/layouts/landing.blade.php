@php
    use App\Support\LocalizedRoute;
    use Illuminate\Support\Str;

    $currentRoute = request()->route();
    $currentRouteName = $currentRoute?->getName();
    $currentRouteParameters = $currentRoute?->parameters() ?? [];
    $baseRouteName = $currentRouteName ? Str::after($currentRouteName, 'en.') : null;
    $resolvedCanonical = $canonical ?? ($baseRouteName ? LocalizedRoute::route($baseRouteName, $currentRouteParameters) : url()->current());
    $resolvedAlternates = $alternates ?? ($baseRouteName ? LocalizedRoute::alternates($baseRouteName, $currentRouteParameters) : LocalizedRoute::alternates('home'));
    $robotsContent = $robots ?? 'index, follow';
@endphp
<!DOCTYPE html>
<html lang="{{ LocalizedRoute::languageTag() }}">
<head>
    @production
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MH8NTBCZ');</script>
        <!-- End Google Tag Manager -->
    @endproduction
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? __('landing.meta_title') }}</title>
    <meta name="description" content="{{ $metaDescription ?? __('landing.meta_description') }}">
    <meta name="robots" content="{{ $robotsContent }}">

    <link rel="canonical" href="{{ $resolvedCanonical }}">

    @foreach ($resolvedAlternates as $hreflang => $href)
        <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $href }}">
    @endforeach

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? __('landing.meta_title') }}">
    <meta property="og:description" content="{{ $metaDescription ?? __('landing.meta_description') }}">
    <meta property="og:url" content="{{ $resolvedCanonical }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AcuarelaSoft">
    <meta property="og:locale" content="{{ LocalizedRoute::ogLocale() }}">
    <meta property="og:locale:alternate" content="{{ LocalizedRoute::alternateOgLocale() }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? __('landing.meta_title') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? __('landing.meta_description') }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @production
        <link rel="preconnect" href="https://challenges.cloudflare.com">
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endproduction

    {{-- Bunny Fonts (GDPR-friendly) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:600,700|inter:400,500,600|pacifico:400" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- JSON-LD Structured Data --}}
    @stack('structured-data')
    </head>
<body class="relative bg-paper paper-bg font-sans text-ink antialiased">
    @production
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MH8NTBCZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endproduction

    {{-- SVG Filters for watercolor effects --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            <filter id="watercolor-edge">
                <feTurbulence type="turbulence" baseFrequency="0.03" numOctaves="3" result="turbulence" seed="2"/>
                <feDisplacementMap in="SourceGraphic" in2="turbulence" scale="6" xChannelSelector="R" yChannelSelector="G"/>
            </filter>
        </defs>
    </svg>

    @php($landingBaseUrl = LocalizedRoute::route('home'))
    @php($landingServicesUrl = $landingBaseUrl . '#servicios')
    @php($landingProcessUrl = $landingBaseUrl . '#proceso')
    @php($landingWhyUsUrl = $landingBaseUrl . '#por-que-nosotros')
    @php($landingContactUrl = $landingBaseUrl . '#contacto')
    @php($landingTextureUrl = asset('assets/textures/texture.webp'))

    {{-- ============ HEADER / NAV ============ --}}
    <div class="pointer-events-none fixed inset-0 z-1 overflow-hidden" aria-hidden="true">
        <div class="absolute inset-0 opacity-[0.15] mix-blend-multiply"
             style="background-image: url('{{ $landingTextureUrl }}'); background-repeat: no-repeat; background-size: cover; background-position: center top;"></div>
    </div>

    <div class="relative z-10">
    <header class="sticky top-0 z-50 bg-paper/85 backdrop-blur-[12px] border-b border-acuarela-400/15 transition-colors duration-300">
        <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between" aria-label="{{ app()->getLocale() === 'es' ? 'Navegación principal' : 'Main navigation' }}">
            {{-- Logo --}}
            <x-brand-logo size="md" />

            {{-- Desktop nav links --}}
            <ul class="hidden md:flex gap-8 font-sans text-sm font-medium text-ink/70">
                <li><a href="{{ $landingServicesUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_services') }}</a></li>
                <li><a href="{{ $landingProcessUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_process') }}</a></li>
                <li><a href="{{ $landingWhyUsUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_why_us') }}</a></li>
                <li><a href="{{ $landingContactUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_contact') }}</a></li>
            </ul>

             <div class="flex items-center gap-4">
                 {{-- Language switcher --}}
                 <nav class="flex gap-1 text-xs font-sans font-medium" aria-label="{{ app()->getLocale() === 'es' ? 'Selector de idioma' : 'Language selector' }}">
                          <a href="{{ $resolvedAlternates['es-MX'] }}" lang="es-MX" hreflang="es-MX"
                        class="px-2 py-1 rounded-soft transition-colors duration-200 {{ app()->getLocale() === 'es' ? 'bg-acuarela-400/15 text-petroleo' : 'text-ink/50 hover:text-petroleo' }}"
                        {{ app()->getLocale() === 'es' ? 'aria-current=true' : '' }}>ES</a>
                          <a href="{{ $resolvedAlternates['en'] }}" lang="en" hreflang="en"
                        class="px-2 py-1 rounded-soft transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-acuarela-400/15 text-petroleo' : 'text-ink/50 hover:text-petroleo' }}"
                        {{ app()->getLocale() === 'en' ? 'aria-current=true' : '' }}>EN</a>
                 </nav>

                {{-- CTA button --}}
                <a href="{{ $landingContactUrl }}" class="hidden sm:inline-flex bg-petroleo text-paper font-sans text-sm font-medium px-5 py-2.5 rounded-soft transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo">
                    {{ __('landing.nav_cta') }}
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button type="button" class="md:hidden p-2 text-ink/70 hover:text-petroleo transition-colors" aria-label="Menu" aria-expanded="false" id="mobile-menu-btn">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
        </nav>

        {{-- Mobile menu panel --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-acuarela-400/10 bg-paper/95 backdrop-blur-[12px]">
            <ul class="flex flex-col gap-1 px-6 py-4 font-sans text-sm font-medium text-ink/70">
                <li><a href="{{ $landingServicesUrl }}" class="block py-2 hover:text-petroleo transition-colors">{{ __('landing.nav_services') }}</a></li>
                <li><a href="{{ $landingProcessUrl }}" class="block py-2 hover:text-petroleo transition-colors">{{ __('landing.nav_process') }}</a></li>
                <li><a href="{{ $landingWhyUsUrl }}" class="block py-2 hover:text-petroleo transition-colors">{{ __('landing.nav_why_us') }}</a></li>
                <li><a href="{{ $landingContactUrl }}" class="block py-2 hover:text-petroleo transition-colors">{{ __('landing.nav_contact') }}</a></li>
            </ul>
            <div class="px-6 pb-4">
                <a href="{{ $landingContactUrl }}" class="block text-center bg-petroleo text-paper font-sans text-sm font-medium px-5 py-2.5 rounded-soft transition-all duration-200 hover:bg-[#245A65]">
                    {{ __('landing.nav_cta') }}
                </a>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    {{-- ============ FOOTER ============ --}}
    <footer class="relative bg-paper border-t border-acuarela-300/25 overflow-hidden" aria-label="Footer">
        <div class="absolute inset-0" aria-hidden="true"
             style="background:
                radial-gradient(ellipse 62% 54% at 14% 24%, rgba(111,168,216,0.12) 0%, transparent 68%),
                radial-gradient(ellipse 44% 42% at 84% 70%, rgba(242,184,178,0.10) 0%, transparent 62%);"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.34]" aria-hidden="true"
               style="background-image: url('{{ asset('assets/textures/palete.webp') }}'); background-repeat: no-repeat; background-size: cover; background-position: right center;"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 py-14 md:py-16">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                <section>
                    <x-brand-logo size="lg" />

                    <p class="mt-5 max-w-xs font-sans text-[1.0625rem] font-medium leading-relaxed text-ink/85">{{ __('landing.footer_tagline_description') }}</p>

                    <ul class="mt-6 flex items-center gap-3" aria-label="{{ __('landing.footer_social_heading') }}">
                        <li>
                            <a href="https://www.linkedin.com/in/rodrigo-sanvicente/" rel="noopener noreferrer" target="_blank" class="inline-flex items-center justify-center size-10 rounded-soft border border-acuarela-300/40 bg-paper/70 text-ink/70 transition-all duration-200 hover:text-petroleo hover:border-acuarela-400/55" aria-label="LinkedIn">
                                <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3A2 2 0 0 1 21 5V19A2 2 0 0 1 19 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H19M8 10H5V19H8V10M6.5 8.31A1.75 1.75 0 1 0 6.5 4.81A1.75 1.75 0 0 0 6.5 8.31M19 19V13.62C19 10.74 17.44 9.38 15.35 9.38C13.66 9.38 12.91 10.31 12.5 10.97V10H9.5V19H12.5V14C12.5 12.69 12.75 11.42 14.38 11.42C15.98 11.42 16 12.92 16 14.08V19H19Z"/></svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/5256494401900" rel="noopener noreferrer" target="_blank" class="inline-flex items-center justify-center size-10 rounded-soft border border-acuarela-300/40 bg-paper/70 text-ink/70 transition-all duration-200 hover:text-petroleo hover:border-acuarela-400/55" aria-label="WhatsApp">
                                <svg class="size-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:contacto@acuarelasoft.com" class="inline-flex items-center justify-center size-10 rounded-soft border border-acuarela-300/40 bg-paper/70 text-ink/70 transition-all duration-200 hover:text-petroleo hover:border-acuarela-400/55" aria-label="Email">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-15A2.25 2.25 0 0 1 2.25 16.5v-9m19.5 0A2.25 2.25 0 0 0 19.5 5.25h-15A2.25 2.25 0 0 0 2.25 7.5m19.5 0-9.334 6.223a.75.75 0 0 1-.832 0L2.25 7.5"/></svg>
                            </a>
                        </li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-sans text-sm font-bold uppercase tracking-[0.14em] text-petroleo mb-4">{{ __('landing.footer_services_heading') }}</h2>
                     <ul class="space-y-2.5 font-sans text-[1rem] font-medium text-ink/88">
                         @foreach (config('site_services') as $service)
                             <li>
                                <a href="{{ LocalizedRoute::route('service', ['service' => $service['slug']]) }}" class="hover:text-petroleo transition-colors duration-200">
                                     {{ __('services.' . $service['key'] . '.title') }}
                                 </a>
                             </li>
                        @endforeach
                    </ul>
                </section>

                <section>
                    <h2 class="font-sans text-sm font-bold uppercase tracking-[0.14em] text-petroleo mb-4">{{ __('landing.footer_company_heading') }}</h2>
                    <ul class="space-y-2.5 font-sans text-[1rem] font-medium text-ink/88">
                        <li><a href="{{ $landingWhyUsUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.footer_company_about') }}</a></li>
                        <li><a href="{{ $landingServicesUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_services') }}</a></li>
                        <li><a href="{{ $landingContactUrl }}" class="hover:text-petroleo transition-colors duration-200">{{ __('landing.nav_contact') }}</a></li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-sans text-sm font-bold uppercase tracking-[0.14em] text-petroleo mb-4">{{ __('landing.footer_get_in_touch_heading') }}</h2>
                    <address class="not-italic space-y-4 font-sans text-[1rem] font-medium text-ink/88">
                        <p>
                            <a href="mailto:contacto@acuarelasoft.com" class="hover:text-petroleo transition-colors duration-200">contacto@acuarelasoft.com</a>
                        </p>

                        <div class="space-y-2">
                            <div class="rounded-soft border border-acuarela-300/35 bg-paper/70 px-3 py-2.5">
                                <p class="text-xs font-bold uppercase tracking-[0.1em] text-petroleo/85">
                                    {{ app()->getLocale() === 'es' ? 'Sede CDMX' : 'CDMX Office' }}
                                </p>
                                <a href="https://wa.me/5256494401900" rel="noopener noreferrer" target="_blank" class="mt-1 block text-[1rem] font-semibold hover:text-petroleo transition-colors duration-200" aria-label="{{ app()->getLocale() === 'es' ? 'WhatsApp sede CDMX' : 'CDMX office WhatsApp' }}">+52 56 4944 0190</a>
                            </div>

                            <div class="rounded-soft border border-acuarela-300/35 bg-paper/70 px-3 py-2.5">
                                <p class="text-xs font-bold uppercase tracking-[0.1em] text-petroleo/85">
                                    {{ app()->getLocale() === 'es' ? 'Sede Monterrey' : 'Monterrey Office' }}
                                </p>
                                <a href="https://wa.me/5218112495823" rel="noopener noreferrer" target="_blank" class="mt-1 block text-[1rem] font-semibold hover:text-petroleo transition-colors duration-200" aria-label="{{ app()->getLocale() === 'es' ? 'WhatsApp sede Monterrey' : 'Monterrey office WhatsApp' }}">+52 1 81 1249 5823</a>
                            </div>
                        </div>
                    </address>
                </section>
            </div>

        </div>
    </footer>

    {{-- WhatsApp floating button --}}
    <aside class="fixed bottom-6 right-6 z-50" aria-label="WhatsApp">
        <a href="https://wa.me/5256494401900?text={{ urlencode(app()->getLocale() === 'es' ? 'Hola, me interesa una consulta sobre desarrollo de software.' : 'Hi, I\'m interested in a software development consultation.') }}"
           rel="noopener noreferrer" target="_blank"
           class="flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-lg transition-all duration-200 hover:scale-110 hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#25D366]"
           aria-label="{{ app()->getLocale() === 'es' ? 'Contactar por WhatsApp' : 'Contact via WhatsApp' }}">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>
    </aside>
    </div>

    {{-- Mobile menu toggle & reveal animations --}}
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');
        });

        // Intersection Observer for section reveal animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
