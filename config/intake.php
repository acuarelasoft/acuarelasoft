<?php

return [
    'complexity_weights' => [
        'baja' => 1,
        'baja-media' => 2,
        'media' => 3,
        'media-alta' => 5,
        'alta' => 8,
    ],

    'size_thresholds' => [
        'S' => 10,
        'M' => 25,
        'L' => 45,
    ],

    'budget_tier_thresholds' => [
        'low' => 15,
        'medium' => 35,
    ],

    'categories' => [
        'platform' => ['position' => 1],
        'commerce' => ['position' => 2],
        'operations' => ['position' => 3],
        'engagement' => ['position' => 4],
        'ai_data' => ['position' => 5],
        'infrastructure' => ['position' => 6],
    ],

    'presets' => [
        'ecommerce' => [
            'modules' => [
                'listing-catalogos',
                'pasarela-pagos',
                'sistema-facturacion',
                'venta-tickets',
                'gestion-promociones-cupones',
                'informes-exportacion',
            ],
        ],
        'saas_b2b' => [
            'modules' => [
                'gestion-usuarios-permissions',
                'autenticacion-avanzada',
                'suscripciones',
                'portal-cliente-selfservice',
                'kpis-dashboards',
                'feature-flags',
            ],
        ],
        'logistica' => [
            'modules' => [
                'paqueteria-seguimiento-flota',
                'maps-geolocation',
                'registro-eventos-telemetria',
                'kpis-dashboards',
                'scheduler-background-jobs',
            ],
        ],
    ],

    'modules' => [
        'listing-catalogos' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Search index (Elasticsearch/Algolia optional)', 'Cache', 'Pagination'],
            'use_cases' => ['E-commerce catalog', 'Service listings', 'Multichannel catalogs'],
        ],
        'gestion-usuarios-permissions' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['OAuth/OIDC', 'Identity provider (Auth0/Keycloak)', 'Audit database'],
            'use_cases' => ['Granular permissions panels', 'Role delegation', 'Corporate access control'],
        ],
        'sistema-facturacion' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Payment gateway', 'Accounting integrations', 'Local fiscal compliance'],
            'use_cases' => ['B2B/B2C invoicing', 'Fiscal documents', 'Reconciliation'],
        ],
        'conexiones-terceros' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['HTTP client', 'Queues/retries', 'Schema registry'],
            'use_cases' => ['ERP synchronization', 'Partner API consumption', 'Webhook management'],
        ],
        'envio-correos-masivos' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['SMTP/ESP provider', 'Queues', 'SPF/DKIM/DMARC'],
            'use_cases' => ['Transactional campaigns', 'Mass notifications', 'Digest emails'],
        ],
        'newsletter' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Bulk mailing module', 'Template manager', 'Segmentation system'],
            'use_cases' => ['Periodic communications', 'Email onboarding', 'Weekly newsletters'],
        ],
        'maps-geolocation' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Map providers', 'Geocoding service'],
            'use_cases' => ['Branch locator', 'Delivery routes', 'Nearby search'],
        ],
        'chatbots-whatsapp-telegram' => [
            'category' => 'engagement',
            'complexity' => 'media-alta',
            'dependencies' => ['Official WhatsApp/Telegram APIs', 'Dialogue platform', 'Webhooks'],
            'use_cases' => ['Automated support', 'Interactive notifications', 'Guided workflows'],
        ],
        'mensajeria-privada' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Realtime/WebSockets', 'Message storage', 'Push notifications'],
            'use_cases' => ['Client-agent conversations', 'In-app messaging', 'Internal support'],
        ],
        'pasarela-pagos' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Stripe/PayU/Adyen', 'Fraud systems', 'Webhooks'],
            'use_cases' => ['Subscription billing', 'E-commerce checkout', 'Micropayments'],
        ],
        'sistema-agendar' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Calendar integrations', 'Notifications', 'Conflict logic'],
            'use_cases' => ['Room bookings', 'Medical scheduling', 'Service appointments'],
        ],
        'formularios' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Validation engine', 'Structured storage', 'Export service'],
            'use_cases' => ['Registration forms', 'Surveys', 'Advanced forms'],
        ],
        'integraciones-ia' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['AI providers', 'Task queues', 'Usage monitor'],
            'use_cases' => ['Auto-classification', 'Text generation', 'Recommendations'],
        ],
        'repositorio-archivos' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['Object storage', 'CDN', 'Thumbnail service'],
            'use_cases' => ['Media library', 'Document repository', 'Client sync'],
        ],
        'transcripcion-traduccion-ia' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['Transcription APIs', 'Media storage', 'Post-processing pipeline'],
            'use_cases' => ['Automatic subtitles', 'Meeting indexing', 'Media translation'],
        ],
        'almacen-entradas-salidas' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['POS/ERP integration', 'Inventory model', 'Notifications'],
            'use_cases' => ['Product inventory', 'Supply control', 'Reorder alerts'],
        ],
        'control-asistencia' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Hardware SDKs or mobile apps', 'HR/payroll integration'],
            'use_cases' => ['Time tracking', 'Rotating shifts', 'Payroll reports'],
        ],
        'identificacion-biometrica' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['Biometric hardware/SDKs', 'Encryption', 'Legal compliance'],
            'use_cases' => ['Secure access', 'KYC verification', 'Attendance verification'],
        ],
        'venta-tickets' => [
            'category' => 'commerce',
            'complexity' => 'media-alta',
            'dependencies' => ['Payment gateway', 'QR/barcode generator', 'Validator integration'],
            'use_cases' => ['Event ticketing', 'Transport tickets', 'Activity booking'],
        ],
        'punto-venta' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Hardware integration', 'Offline sync', 'POS/payment gateway'],
            'use_cases' => ['Retail stores', 'Restaurants', 'Kiosks'],
        ],
        'kpis-dashboards' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['Data warehouse', 'ETL', 'Visualization engine', 'Alerting system'],
            'use_cases' => ['Business KPI tracking', 'Sales tracking', 'SLA monitoring', 'System health', 'Capacity alerts', 'Operational monitoring'],
        ],
        'informes-exportacion' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['File generation engine', 'PDF/XLSX libraries', 'Storage', 'Scheduler'],
            'use_cases' => ['Accounting reports', 'Downloadable reports', 'Statements', 'Contracts', 'Third-party exports'],
        ],
        'sistema-arriendo' => [
            'category' => 'commerce',
            'complexity' => 'media-alta',
            'dependencies' => ['Billing', 'Payment gateway', 'Contract generation'],
            'use_cases' => ['Property rentals', 'Equipment rentals', 'Vehicle rentals'],
        ],
        'suscripciones' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Recurring billing gateway', 'Invoicing', 'Webhooks'],
            'use_cases' => ['SaaS plans', 'Memberships', 'Annual subscriptions'],
        ],
        'multi-idioma' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['i18n framework', 'Translation service', 'Resource manager'],
            'use_cases' => ['Multi-country apps', 'Localized content', 'Translatable UI'],
        ],
        'paqueteria-seguimiento-flota' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['GPS/telemetry', 'Route optimizer', 'Maps and carrier integration'],
            'use_cases' => ['Home deliveries', 'Fleet management', 'Transport marketplace'],
        ],
        'autenticacion-avanzada' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['Identity provider', 'MFA provider', 'Certificates'],
            'use_cases' => ['Enterprise directory integration', 'Single login across apps'],
        ],
        'registro-eventos-telemetria' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Collector', 'Data warehouse', 'Client SDKs'],
            'use_cases' => ['Product funnels', 'Behavior tracking', 'Usage analytics'],
        ],
        'busqueda-avanzada' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['Elasticsearch/Algolia', 'Index pipelines', 'CDN cache'],
            'use_cases' => ['Catalog search', 'Content discovery', 'Autocomplete'],
        ],
        'cms-gestion-contenido' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Headless API', 'WYSIWYG editor', 'Media storage'],
            'use_cases' => ['Landing pages', 'Blogs', 'Content management'],
        ],
        'feature-flags' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Feature flag service', 'Client SDKs', 'Telemetry'],
            'use_cases' => ['Controlled rollouts', 'Canary releases', 'Fast feature rollback'],
        ],
        'experimentacion-ab-testing' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Experiment SDKs', 'Event storage', 'Analytics'],
            'use_cases' => ['Conversion optimization', 'UI experiments', 'Hypothesis validation'],
        ],
        'trazabilidad-tracing-error-tracking' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['OpenTelemetry', 'Sentry', 'Trace storage'],
            'use_cases' => ['Latency diagnostics', 'Failure correlation', 'Exception tracking'],
        ],
        'api-gateway-gestion-trafico' => [
            'category' => 'infrastructure',
            'complexity' => 'media-alta',
            'dependencies' => ['Kong/Apigee/Envoy', 'TLS certificates', 'Monitoring system'],
            'use_cases' => ['Public API exposure', 'Client quotas', 'Response caching'],
        ],
        'scheduler-background-jobs' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Queue backend', 'Monitoring dashboard', 'Storage'],
            'use_cases' => ['Scheduled campaigns', 'Media processing', 'Periodic syncs'],
        ],
        'backup-versionado-dr' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Backup storage', 'Automation scripts', 'Runbooks'],
            'use_cases' => ['Database restore', 'File recovery', 'DR drills'],
        ],
        'multi-tenant-gestion' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['Tenancy architecture', 'Tenant billing', 'Quota monitoring'],
            'use_cases' => ['Multi-company SaaS', 'Per-client data isolation', 'Tenant onboarding'],
        ],
        'portal-cliente-selfservice' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Billing integration', 'Ticketing system', 'Authentication'],
            'use_cases' => ['Subscription management', 'Invoice downloads', 'Order tracking'],
        ],
        'gestion-promociones-cupones' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Checkout'],
            'use_cases' => ['Discount campaigns', 'Loyalty points', 'Marketing coupons'],
        ],
    ],
];
