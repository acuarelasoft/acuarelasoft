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
         HERO SECTION
         ============================================================ --}}
    <section id="hero" aria-label="{{ __('landing.hero_headline') }}">
        <h1>{{ __('landing.hero_headline') }}</h1>
        <p>{{ __('landing.hero_subheadline') }}</p>

        <nav aria-label="{{ app()->getLocale() === 'es' ? 'Acciones principales' : 'Main actions' }}">
            <a href="#contacto">{{ __('landing.hero_cta_primary') }}</a>
            <a href="#servicios">{{ __('landing.hero_cta_secondary') }}</a>
        </nav>

        <ul aria-label="{{ app()->getLocale() === 'es' ? 'Indicadores de confianza' : 'Trust indicators' }}">
            <li>{{ __('landing.hero_trust_experience') }}</li>
            <li>{{ __('landing.hero_trust_stack') }}</li>
            <li>{{ __('landing.hero_trust_ux') }}</li>
            <li>{{ __('landing.hero_trust_cloud') }}</li>
        </ul>
    </section>

    {{-- ============================================================
         PROBLEM → SOLUTION
         ============================================================ --}}
    <section id="problemas" aria-labelledby="problems-heading">
        <h2 id="problems-heading">{{ __('landing.problems_title') }}</h2>
        <p>{{ __('landing.problems_subtitle') }}</p>

        <dl>
            <div>
                <dt>{{ __('landing.pain_1') }}</dt>
                <dd>{{ __('landing.solution_1') }}</dd>
            </div>
            <div>
                <dt>{{ __('landing.pain_2') }}</dt>
                <dd>{{ __('landing.solution_2') }}</dd>
            </div>
            <div>
                <dt>{{ __('landing.pain_3') }}</dt>
                <dd>{{ __('landing.solution_3') }}</dd>
            </div>
        </dl>
    </section>

    {{-- ============================================================
         SERVICES
         ============================================================ --}}
    <section id="servicios" aria-labelledby="services-heading">
        <h2 id="services-heading">{{ __('landing.services_title') }}</h2>
        <p>{{ __('landing.services_subtitle') }}</p>

        <ul>
            <li>
                <article>
                    <h3>{{ __('landing.service_laravel_title') }}</h3>
                    <p>{{ __('landing.service_laravel_desc') }}</p>
                    <p><em>{{ __('landing.service_laravel_benefit') }}</em></p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.service_angular_title') }}</h3>
                    <p>{{ __('landing.service_angular_desc') }}</p>
                    <p><em>{{ __('landing.service_angular_benefit') }}</em></p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.service_node_title') }}</h3>
                    <p>{{ __('landing.service_node_desc') }}</p>
                    <p><em>{{ __('landing.service_node_benefit') }}</em></p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.service_db_title') }}</h3>
                    <p>{{ __('landing.service_db_desc') }}</p>
                    <p><em>{{ __('landing.service_db_benefit') }}</em></p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.service_cloud_title') }}</h3>
                    <p>{{ __('landing.service_cloud_desc') }}</p>
                    <p><em>{{ __('landing.service_cloud_benefit') }}</em></p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.service_consulting_title') }}</h3>
                    <p>{{ __('landing.service_consulting_desc') }}</p>
                    <p><em>{{ __('landing.service_consulting_benefit') }}</em></p>
                </article>
            </li>
        </ul>
    </section>

    {{-- ============================================================
         MID-PAGE CTA
         ============================================================ --}}
    <section id="cta-mid" aria-labelledby="mid-cta-heading">
        <h2 id="mid-cta-heading">{{ __('landing.mid_cta_title') }}</h2>
        <p>{{ __('landing.mid_cta_subtitle') }}</p>
        <a href="#contacto">{{ __('landing.mid_cta_button') }}</a>
    </section>

    {{-- ============================================================
         PROCESS
         ============================================================ --}}
    <section id="proceso" aria-labelledby="process-heading">
        <h2 id="process-heading">{{ __('landing.process_title') }}</h2>
        <p>{{ __('landing.process_subtitle') }}</p>

        <ol>
            <li>
                <h3>{{ __('landing.process_1_name') }}</h3>
                <p>{{ __('landing.process_1_desc') }}</p>
            </li>
            <li>
                <h3>{{ __('landing.process_2_name') }}</h3>
                <p>{{ __('landing.process_2_desc') }}</p>
            </li>
            <li>
                <h3>{{ __('landing.process_3_name') }}</h3>
                <p>{{ __('landing.process_3_desc') }}</p>
            </li>
            <li>
                <h3>{{ __('landing.process_4_name') }}</h3>
                <p>{{ __('landing.process_4_desc') }}</p>
            </li>
            <li>
                <h3>{{ __('landing.process_5_name') }}</h3>
                <p>{{ __('landing.process_5_desc') }}</p>
            </li>
        </ol>
    </section>

    {{-- ============================================================
         TECHNOLOGIES
         ============================================================ --}}
    <section id="tecnologias" aria-labelledby="tech-heading">
        <h2 id="tech-heading">{{ __('landing.tech_title') }}</h2>
        <p>{{ __('landing.tech_subtitle') }}</p>

        <ul aria-label="{{ __('landing.tech_title') }}">
            <li>Laravel</li>
            <li>Angular</li>
            <li>Node.js</li>
            <li>PHP</li>
            <li>TypeScript</li>
            <li>MariaDB</li>
            <li>PostgreSQL</li>
            <li>AWS</li>
            <li>Docker</li>
            <li>Tailwind CSS</li>
            <li>Git</li>
        </ul>
    </section>

    {{-- ============================================================
         WHY US
         ============================================================ --}}
    <section id="por-que-nosotros" aria-labelledby="why-heading">
        <h2 id="why-heading">{{ __('landing.why_title') }}</h2>
        <p>{{ __('landing.why_subtitle') }}</p>

        <ul>
            <li>
                <article>
                    <h3>{{ __('landing.why_experience_title') }}</h3>
                    <p>{{ __('landing.why_experience_desc') }}</p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.why_design_title') }}</h3>
                    <p>{{ __('landing.why_design_desc') }}</p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.why_fullstack_title') }}</h3>
                    <p>{{ __('landing.why_fullstack_desc') }}</p>
                </article>
            </li>
            <li>
                <article>
                    <h3>{{ __('landing.why_communication_title') }}</h3>
                    <p>{{ __('landing.why_communication_desc') }}</p>
                </article>
            </li>
        </ul>
    </section>

    {{-- ============================================================
         EARLY CLIENTS OFFER
         ============================================================ --}}
    <section id="oferta" aria-labelledby="offer-heading">
        <h2 id="offer-heading">{{ __('landing.offer_title') }}</h2>
        <p>{{ __('landing.offer_desc') }}</p>
        <a href="#contacto">{{ __('landing.offer_cta') }}</a>
        <p><small>{{ __('landing.offer_scarcity') }}</small></p>
    </section>

    {{-- ============================================================
         CONTACT FORM
         ============================================================ --}}
    <section id="contacto" aria-labelledby="contact-heading">
        <h2 id="contact-heading">{{ __('landing.contact_title') }}</h2>
        <p>{{ __('landing.contact_subtitle') }}</p>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            {{-- Honeypot anti-spam (hidden from real users) --}}
            <div aria-hidden="true" hidden>
                <label for="website">Website</label>
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name">{{ __('landing.contact_name') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}">*</abbr></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    autocomplete="name"
                    value="{{ old('name') }}"
                    aria-describedby="{{ $errors->has('name') ? 'name-error' : '' }}"
                    {{ $errors->has('name') ? 'aria-invalid=true' : '' }}
                >
                @error('name')
                    <p id="name-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email">{{ __('landing.contact_email') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}">*</abbr></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="email"
                    value="{{ old('email') }}"
                    aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}"
                    {{ $errors->has('email') ? 'aria-invalid=true' : '' }}
                >
                @error('email')
                    <p id="email-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="company">{{ __('landing.contact_company') }}</label>
                <input
                    type="text"
                    id="company"
                    name="company"
                    autocomplete="organization"
                    value="{{ old('company') }}"
                >
            </div>

            <div>
                <label for="phone">{{ __('landing.contact_phone') }}</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    autocomplete="tel"
                    value="{{ old('phone') }}"
                >
            </div>

            <div>
                <label for="project_type">{{ __('landing.contact_project_type') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}">*</abbr></label>
                <select
                    id="project_type"
                    name="project_type"
                    required
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
                    <p id="project-type-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="budget">{{ __('landing.contact_budget') }}</label>
                <select id="budget" name="budget">
                    <option value="">{{ __('landing.contact_select_placeholder') }}</option>
                    <option value="under_20k" @selected(old('budget') === 'under_20k')>{{ __('landing.contact_budget_under_20k') }}</option>
                    <option value="20k_50k" @selected(old('budget') === '20k_50k')>{{ __('landing.contact_budget_20k_50k') }}</option>
                    <option value="50k_100k" @selected(old('budget') === '50k_100k')>{{ __('landing.contact_budget_50k_100k') }}</option>
                    <option value="over_100k" @selected(old('budget') === 'over_100k')>{{ __('landing.contact_budget_over_100k') }}</option>
                    <option value="unsure" @selected(old('budget') === 'unsure')>{{ __('landing.contact_budget_unsure') }}</option>
                </select>
            </div>

            <div>
                <label for="message">{{ __('landing.contact_message') }} <abbr title="{{ app()->getLocale() === 'es' ? 'requerido' : 'required' }}">*</abbr></label>
                <textarea
                    id="message"
                    name="message"
                    required
                    maxlength="500"
                    rows="5"
                    aria-describedby="message-hint {{ $errors->has('message') ? 'message-error' : '' }}"
                    {{ $errors->has('message') ? 'aria-invalid=true' : '' }}
                >{{ old('message') }}</textarea>
                <p id="message-hint"><small>{{ app()->getLocale() === 'es' ? 'Máximo 500 caracteres.' : 'Maximum 500 characters.' }}</small></p>
                @error('message')
                    <p id="message-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit">{{ __('landing.contact_submit') }}</button>
                <p><small>{{ __('landing.contact_note') }}</small></p>
                <p><small>{{ __('landing.contact_privacy') }}</small></p>
            </div>
        </form>

        @session('success')
            <div role="status" aria-live="polite">
                <p>{{ $value }}</p>
            </div>
        @endsession
    </section>

</x-layouts.landing>
