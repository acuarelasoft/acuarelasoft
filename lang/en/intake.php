<?php

return [
    'meta_title' => 'Web App Module Catalog | AcuarelaSoft',
    'meta_description' => 'Explore the modules we can implement in your web app: catalogs, payments, dashboards, automation, integrations, and more.',

    'hero_title' => 'Modules We Can Implement in Your Web App',
    'hero_subtitle' => 'Explore the modules and capabilities we can build for your project.',

    'info' => [
        'cta_title' => 'Want help prioritizing the right stack?',
        'cta_description' => 'Share your business goals and we will help you define an initial module combination, technical scope, and recommended next step.',
        'cta_action' => 'Contact the team',
    ],

    'categories' => [
        'platform' => 'Core Platform',
        'commerce' => 'Commerce and Billing',
        'operations' => 'Operations and Logistics',
        'engagement' => 'Communication and Engagement',
        'ai_data' => 'AI, Data and Content',
        'infrastructure' => 'Infrastructure and Reliability',
    ],

    'complexity' => [
        'baja' => 'Low',
        'baja-media' => 'Low-Medium',
        'media' => 'Medium',
        'media-alta' => 'Medium-High',
        'alta' => 'High',
    ],

    'helpers' => [
        'dependencies' => 'Dependencies',
        'use_cases' => 'Example use cases',
    ],

    'modules' => [
        'listing-catalogos' => ['short' => 'Catalog', 'label' => 'Listings and catalogs', 'description' => 'Manage item collections with CRUD, filters, search, and pagination for high-volume catalogs.', 'use_cases' => ['E-commerce catalog', 'Service listings', 'Multichannel catalogs']],
        'gestion-usuarios-permissions' => ['short' => 'Users and access', 'label' => 'User and permissions management', 'description' => 'Roles, permissions, profile administration, and enterprise-grade access governance.', 'use_cases' => ['Granular permissions panels', 'Role delegation', 'Corporate access control']],
        'sistema-facturacion' => ['short' => 'Billing', 'label' => 'Billing system', 'description' => 'Generate invoices and tax documents with recurring and one-time billing flows.', 'use_cases' => ['B2B/B2C invoicing', 'Fiscal documents', 'Reconciliation']],
        'conexiones-terceros' => ['short' => 'API integration', 'label' => 'Third-party integrations', 'description' => 'Consume and expose external APIs with retries, throttling, and schema validation.', 'use_cases' => ['ERP synchronization', 'Partner API consumption', 'Webhook management']],
        'envio-correos-masivos' => ['short' => 'Bulk email', 'label' => 'Bulk email sending', 'description' => 'High-scale email delivery with templates, personalization, and delivery metrics.', 'use_cases' => ['Transactional campaigns', 'Mass notifications', 'Digest emails']],
        'newsletter' => ['short' => 'Newsletter', 'label' => 'Newsletter management', 'description' => 'Create, schedule, and segment newsletters with campaign analytics.', 'use_cases' => ['Periodic communications', 'Email onboarding', 'Weekly newsletters']],
        'maps-geolocation' => ['short' => 'Maps and geo', 'label' => 'Maps and geolocation', 'description' => 'Geocoding, routes, and proximity queries with map providers.', 'use_cases' => ['Branch locator', 'Delivery routes', 'Nearby search']],
        'chatbots-whatsapp-telegram' => ['short' => 'Messaging bots', 'label' => 'WhatsApp and Telegram chatbots', 'description' => 'Conversational bot flows with webhook orchestration and optional NLU.', 'use_cases' => ['Automated support', 'Interactive notifications', 'Guided workflows']],
        'mensajeria-privada' => ['short' => 'Private messaging', 'label' => 'Private in-app messaging', 'description' => 'Real-time user messaging with history, moderation, and notifications.', 'use_cases' => ['Client-agent conversations', 'In-app messaging', 'Internal support']],
        'pasarela-pagos' => ['short' => 'Payments', 'label' => 'Payment gateway', 'description' => 'Secure payment processing with tokenization, anti-fraud, and reconciliation.', 'use_cases' => ['Subscription billing', 'E-commerce checkout', 'Micropayments']],
        'sistema-agendar' => ['short' => 'Scheduling', 'label' => 'Scheduling system', 'description' => 'Calendar, availability, reminders, and timezone-aware booking logic.', 'use_cases' => ['Room bookings', 'Medical scheduling', 'Service appointments']],
        'formularios' => ['short' => 'Dynamic forms', 'label' => 'Dynamic forms', 'description' => 'Conditional forms with validation, versioning, and webhook processing.', 'use_cases' => ['Registration forms', 'Surveys', 'Advanced forms']],
        'integraciones-ia' => ['short' => 'AI integration', 'label' => 'AI workflow integrations', 'description' => 'Integrate AI models into operational workflows with latency and cost controls.', 'use_cases' => ['Auto-classification', 'Text generation', 'Recommendations']],
        'repositorio-archivos' => ['short' => 'File repository', 'label' => 'File repository / photo manager', 'description' => 'Manage files with versioning, permissions, metadata search, and previews.', 'use_cases' => ['Media library', 'Document repository', 'Client sync']],
        'transcripcion-traduccion-ia' => ['short' => 'AI transcription', 'label' => 'AI transcription and translation', 'description' => 'Transcribe and translate audio/video with timestamps and language detection.', 'use_cases' => ['Automatic subtitles', 'Meeting indexing', 'Media translation']],
        'almacen-entradas-salidas' => ['short' => 'Warehouse', 'label' => 'Warehouse management', 'description' => 'Track stock movements, lot traceability, and low-stock alerts.', 'use_cases' => ['Product inventory', 'Supply control', 'Reorder alerts']],
        'control-asistencia' => ['short' => 'Attendance', 'label' => 'Attendance control', 'description' => 'Attendance tracking with shifts, exceptions, and payroll-oriented reporting.', 'use_cases' => ['Time tracking', 'Rotating shifts', 'Payroll reports']],
        'identificacion-biometrica' => ['short' => 'Biometric', 'label' => 'Biometric identification', 'description' => 'Secure biometric enrollment and matching for controlled verification.', 'use_cases' => ['Secure access', 'KYC verification', 'Attendance verification']],
        'venta-tickets' => ['short' => 'Ticket sales', 'label' => 'Ticketing and passes', 'description' => 'Issue, reserve, validate, and refund tickets with QR/barcode support.', 'use_cases' => ['Event ticketing', 'Transport tickets', 'Activity booking']],
        'punto-venta' => ['short' => 'Point of sale', 'label' => 'Point of sale (POS)', 'description' => 'In-person sales workflows with hardware integrations and offline sync.', 'use_cases' => ['Retail stores', 'Restaurants', 'Kiosks']],
        'kpis-dashboards' => ['short' => 'KPIs and alerts', 'label' => 'KPIs, dashboards and alerts', 'description' => 'Lets teams see whether the business is on track through clear KPIs and receive early alerts when performance starts to drift.', 'use_cases' => ['Business KPI tracking', 'Sales tracking', 'SLA monitoring', 'System health', 'Capacity alerts', 'Operational monitoring']],
        'informes-exportacion' => ['short' => 'Files and reports', 'label' => 'File generation, reporting and exports', 'description' => 'Generate PDF/XLSX/CSV documents and reports with filters, scheduling, and secure exports for clients or third parties.', 'use_cases' => ['Accounting reports', 'Downloadable reports', 'Statements', 'Contracts', 'Third-party exports']],
        'sistema-arriendo' => ['short' => 'Rentals', 'label' => 'Rental management', 'description' => 'Manage contracts, periods, payments, and rental document workflows.', 'use_cases' => ['Property rentals', 'Equipment rentals', 'Vehicle rentals']],
        'suscripciones' => ['short' => 'Subscriptions', 'label' => 'Recurring subscriptions', 'description' => 'Plan lifecycle management for monthly or yearly subscriptions.', 'use_cases' => ['SaaS plans', 'Memberships', 'Annual subscriptions']],
        'multi-idioma' => ['short' => 'Multi-language', 'label' => 'Internationalization (i18n/l10n)', 'description' => 'Localization-ready interfaces with translation and regional formatting support.', 'use_cases' => ['Multi-country apps', 'Localized content', 'Translatable UI']],
        'paqueteria-seguimiento-flota' => ['short' => 'Fleet tracking', 'label' => 'Shipping, tracking, and fleet', 'description' => 'Real-time logistics with route assignment, ETA, and SLA visibility.', 'use_cases' => ['Home deliveries', 'Fleet management', 'Transport marketplace']],
        'autenticacion-avanzada' => ['short' => 'Advanced auth', 'label' => 'Advanced authentication', 'description' => 'SSO, MFA, OAuth/OIDC/SAML federation for enterprise access.', 'use_cases' => ['Enterprise directory integration', 'Single login across apps']],
        'registro-eventos-telemetria' => ['short' => 'Event telemetry', 'label' => 'Event tracking and telemetry', 'description' => 'Collect user/system events for analytics pipelines and BI reporting.', 'use_cases' => ['Product funnels', 'Behavior tracking', 'Usage analytics']],
        'busqueda-avanzada' => ['short' => 'Advanced search', 'label' => 'Advanced relevance search', 'description' => 'Faceted full-text search with relevance tuning and suggestions.', 'use_cases' => ['Catalog search', 'Content discovery', 'Autocomplete']],
        'cms-gestion-contenido' => ['short' => 'Headless CMS', 'label' => 'Content management (CMS)', 'description' => 'Headless content workflows for websites and apps without redeploys.', 'use_cases' => ['Landing pages', 'Blogs', 'Content management']],
        'feature-flags' => ['short' => 'Feature flags', 'label' => 'Feature flags and release management', 'description' => 'Controlled feature rollout by environment or user segment.', 'use_cases' => ['Controlled rollouts', 'Canary releases', 'Fast feature rollback']],
        'experimentacion-ab-testing' => ['short' => 'A/B testing', 'label' => 'Experimentation and A/B testing', 'description' => 'Run experiments, compare variants, and evaluate statistical outcomes.', 'use_cases' => ['Conversion optimization', 'UI experiments', 'Hypothesis validation']],
        'trazabilidad-tracing-error-tracking' => ['short' => 'Tracing & errors', 'label' => 'Tracing and error tracking', 'description' => 'Distributed tracing and correlated error monitoring for debugging.', 'use_cases' => ['Latency diagnostics', 'Failure correlation', 'Exception tracking']],
        'api-gateway-gestion-trafico' => ['short' => 'API gateway', 'label' => 'API gateway and traffic management', 'description' => 'Traffic control with auth, rate limiting, caching, and quotas.', 'use_cases' => ['Public API exposure', 'Client quotas', 'Response caching']],
        'scheduler-background-jobs' => ['short' => 'Jobs workers', 'label' => 'Scheduler and background jobs', 'description' => 'Asynchronous processing with retries, priorities, and visibility.', 'use_cases' => ['Scheduled campaigns', 'Media processing', 'Periodic syncs']],
        'backup-versionado-dr' => ['short' => 'Backup DR', 'label' => 'Backup and disaster recovery', 'description' => 'Automated backup, restore, retention, and recovery verification.', 'use_cases' => ['Database restore', 'File recovery', 'DR drills']],
        'multi-tenant-gestion' => ['short' => 'Multi-tenant', 'label' => 'Multi-tenant management', 'description' => 'Tenant isolation, onboarding, quotas, and tenant-based billing support.', 'use_cases' => ['Multi-company SaaS', 'Per-client data isolation', 'Tenant onboarding']],
        'portal-cliente-selfservice' => ['short' => 'Client portal', 'label' => 'Client self-service portal', 'description' => 'Self-service area for billing, support, and account management.', 'use_cases' => ['Subscription management', 'Invoice downloads', 'Order tracking']],
        'gestion-promociones-cupones' => ['short' => 'Promotions', 'label' => 'Promotions, coupons, and loyalty', 'description' => 'Discount rules, coupons, and loyalty programs for checkout optimization.', 'use_cases' => ['Discount campaigns', 'Loyalty points', 'Marketing coupons']],
    ],
];
