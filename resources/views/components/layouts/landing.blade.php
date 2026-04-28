<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? __('landing.meta_title') }}</title>
    <meta name="description" content="{{ $metaDescription ?? __('landing.meta_description') }}">

    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    {{-- Hreflang for bilingual SEO --}}
    <link rel="alternate" hreflang="es" href="{{ url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ url('/en') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? __('landing.meta_title') }}">
    <meta property="og:description" content="{{ $metaDescription ?? __('landing.meta_description') }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AcuarelaSoft">
    <meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_MX' : 'en_US' }}">
    <meta property="og:locale:alternate" content="{{ app()->getLocale() === 'es' ? 'en_US' : 'es_MX' }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? __('landing.meta_title') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? __('landing.meta_description') }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- JSON-LD Structured Data --}}
    @stack('structured-data')
</head>
<body>
    <header>
        <nav aria-label="{{ app()->getLocale() === 'es' ? 'Navegación principal' : 'Main navigation' }}">
            <a href="{{ route('home') }}" aria-label="AcuarelaSoft - {{ __('landing.footer_tagline') }}">
                AcuarelaSoft
            </a>

            <ul>
                <li><a href="#servicios">{{ __('landing.nav_services') }}</a></li>
                <li><a href="#proceso">{{ __('landing.nav_process') }}</a></li>
                <li><a href="#por-que-nosotros">{{ __('landing.nav_why_us') }}</a></li>
                <li><a href="#contacto">{{ __('landing.nav_contact') }}</a></li>
            </ul>

            <div>
                <a href="#contacto">{{ __('landing.nav_cta') }}</a>
            </div>

            {{-- Language switcher --}}
            <nav aria-label="{{ app()->getLocale() === 'es' ? 'Selector de idioma' : 'Language selector' }}">
                <ul>
                    <li>
                        <a href="{{ url('/') }}" lang="es" hreflang="es" {{ app()->getLocale() === 'es' ? 'aria-current=true' : '' }}>ES</a>
                    </li>
                    <li>
                        <a href="{{ url('/en') }}" lang="en" hreflang="en" {{ app()->getLocale() === 'en' ? 'aria-current=true' : '' }}>EN</a>
                    </li>
                </ul>
            </nav>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <section aria-label="{{ __('landing.footer_contact_heading') }}">
            <p><strong>AcuarelaSoft</strong></p>
            <p>{{ __('landing.footer_tagline') }}</p>
        </section>

        <section aria-label="{{ __('landing.footer_contact_heading') }}">
            <h2>{{ __('landing.footer_contact_heading') }}</h2>
            <address>
                <ul>
                    <li>
                        <a href="mailto:contacto@acuarelasoft.dev">contacto@acuarelasoft.dev</a>
                    </li>
                    <li>
                        <a href="https://wa.me/5256494401900" rel="noopener noreferrer" target="_blank">
                            WhatsApp: +52 56 4944 0190
                        </a>
                    </li>
                </ul>
            </address>
        </section>

        <section aria-label="{{ __('landing.footer_location_heading') }}">
            <h2>{{ __('landing.footer_location_heading') }}</h2>
            <p>{{ __('landing.footer_location') }}</p>
        </section>

        <section aria-label="{{ __('landing.footer_social_heading') }}">
            <h2>{{ __('landing.footer_social_heading') }}</h2>
            <ul>
                <li>
                    <a href="https://www.linkedin.com/in/rodrigo-sanvicente/" rel="noopener noreferrer" target="_blank">
                        LinkedIn
                    </a>
                </li>
            </ul>
        </section>

        <nav aria-label="{{ __('landing.footer_legal_heading') }}">
            <h2>{{ __('landing.footer_legal_heading') }}</h2>
            <ul>
                <li><a href="#">{{ __('landing.footer_privacy') }}</a></li>
                <li><a href="#">{{ __('landing.footer_terms') }}</a></li>
            </ul>
        </nav>

        <nav aria-label="{{ app()->getLocale() === 'es' ? 'Selector de idioma' : 'Language selector' }}">
            <ul>
                <li>
                    <a href="{{ url('/') }}" lang="es" hreflang="es" {{ app()->getLocale() === 'es' ? 'aria-current=true' : '' }}>ES</a>
                </li>
                <li>
                    <a href="{{ url('/en') }}" lang="en" hreflang="en" {{ app()->getLocale() === 'en' ? 'aria-current=true' : '' }}>EN</a>
                </li>
            </ul>
        </nav>

        <p><small>{{ __('landing.footer_copyright', ['year' => date('Y')]) }}</small></p>
    </footer>

    {{-- WhatsApp floating link --}}
    <aside aria-label="WhatsApp">
        <a href="https://wa.me/5256494401900?text={{ urlencode(app()->getLocale() === 'es' ? 'Hola, me interesa una consulta sobre desarrollo de software.' : 'Hi, I\'m interested in a software development consultation.') }}" rel="noopener noreferrer" target="_blank" aria-label="{{ app()->getLocale() === 'es' ? 'Contactar por WhatsApp' : 'Contact via WhatsApp' }}">
            WhatsApp
        </a>
    </aside>
</body>
</html>
