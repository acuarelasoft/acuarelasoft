<?php

return [
    'categories' => [
        'platform' => ['position' => 1],
        'commerce' => ['position' => 2],
        'operations' => ['position' => 3],
        'engagement' => ['position' => 4],
        'ai_data' => ['position' => 5],
        'infrastructure' => ['position' => 6],
    ],

    'modules' => [
        'listing-catalogos' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Search index (Elasticsearch/Algolia optional)', 'Cache', 'Pagination'],
        ],
        'gestion-usuarios-permissions' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['OAuth/OIDC', 'Identity provider (Auth0/Keycloak)', 'Audit database'],
        ],
        'sistema-facturacion' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Payment gateway', 'Accounting integrations', 'Local fiscal compliance'],
        ],
        'conexiones-terceros' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['HTTP client', 'Queues/retries', 'Schema registry'],
        ],
        'envio-correos-masivos' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['SMTP/ESP provider', 'Queues', 'SPF/DKIM/DMARC'],
        ],
        'newsletter' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Bulk mailing module', 'Template manager', 'Segmentation system'],
        ],
        'maps-geolocation' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Map providers', 'Geocoding service'],
        ],
        'chatbots-whatsapp-telegram' => [
            'category' => 'engagement',
            'complexity' => 'media-alta',
            'dependencies' => ['Official WhatsApp/Telegram APIs', 'Dialogue platform', 'Webhooks'],
        ],
        'mensajeria-privada' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Realtime/WebSockets', 'Message storage', 'Push notifications'],
        ],
        'pasarela-pagos' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Stripe/PayU/Adyen', 'Fraud systems', 'Webhooks'],
        ],
        'sistema-agendar' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Calendar integrations', 'Notifications', 'Conflict logic'],
        ],
        'formularios' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Validation engine', 'Structured storage', 'Export service'],
        ],
        'integraciones-ia' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['AI providers', 'Task queues', 'Usage monitor'],
        ],
        'repositorio-archivos' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['Object storage', 'CDN', 'Thumbnail service'],
        ],
        'transcripcion-traduccion-ia' => [
            'category' => 'ai_data',
            'complexity' => 'alta',
            'dependencies' => ['Transcription APIs', 'Media storage', 'Post-processing pipeline'],
        ],
        'almacen-entradas-salidas' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['POS/ERP integration', 'Inventory model', 'Notifications'],
        ],
        'control-asistencia' => [
            'category' => 'operations',
            'complexity' => 'media',
            'dependencies' => ['Hardware SDKs or mobile apps', 'HR/payroll integration'],
        ],
        'identificacion-biometrica' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['Biometric hardware/SDKs', 'Encryption', 'Legal compliance'],
        ],
        'venta-tickets' => [
            'category' => 'commerce',
            'complexity' => 'media-alta',
            'dependencies' => ['Payment gateway', 'QR/barcode generator', 'Validator integration'],
        ],
        'punto-venta' => [
            'category' => 'commerce',
            'complexity' => 'alta',
            'dependencies' => ['Hardware integration', 'Offline sync', 'POS/payment gateway'],
        ],
        'kpis-dashboards' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['Data warehouse', 'ETL', 'Visualization engine', 'Alerting system'],
        ],
        'informes-exportacion' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['File generation engine', 'PDF/XLSX libraries', 'Storage', 'Scheduler'],
        ],
        'sistema-arriendo' => [
            'category' => 'commerce',
            'complexity' => 'media-alta',
            'dependencies' => ['Billing', 'Payment gateway', 'Contract generation'],
        ],
        'suscripciones' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Recurring billing gateway', 'Invoicing', 'Webhooks'],
        ],
        'multi-idioma' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['i18n framework', 'Translation service', 'Resource manager'],
        ],
        'paqueteria-seguimiento-flota' => [
            'category' => 'operations',
            'complexity' => 'alta',
            'dependencies' => ['GPS/telemetry', 'Route optimizer', 'Maps and carrier integration'],
        ],
        'autenticacion-avanzada' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['Identity provider', 'MFA provider', 'Certificates'],
        ],
        'registro-eventos-telemetria' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Collector', 'Data warehouse', 'Client SDKs'],
        ],
        'busqueda-avanzada' => [
            'category' => 'ai_data',
            'complexity' => 'media',
            'dependencies' => ['Elasticsearch/Algolia', 'Index pipelines', 'CDN cache'],
        ],
        'cms-gestion-contenido' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Headless API', 'WYSIWYG editor', 'Media storage'],
        ],
        'feature-flags' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Feature flag service', 'Client SDKs', 'Telemetry'],
        ],
        'experimentacion-ab-testing' => [
            'category' => 'platform',
            'complexity' => 'media',
            'dependencies' => ['Experiment SDKs', 'Event storage', 'Analytics'],
        ],
        'trazabilidad-tracing-error-tracking' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['OpenTelemetry', 'Sentry', 'Trace storage'],
        ],
        'api-gateway-gestion-trafico' => [
            'category' => 'infrastructure',
            'complexity' => 'media-alta',
            'dependencies' => ['Kong/Apigee/Envoy', 'TLS certificates', 'Monitoring system'],
        ],
        'scheduler-background-jobs' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Queue backend', 'Monitoring dashboard', 'Storage'],
        ],
        'backup-versionado-dr' => [
            'category' => 'infrastructure',
            'complexity' => 'media',
            'dependencies' => ['Backup storage', 'Automation scripts', 'Runbooks'],
        ],
        'multi-tenant-gestion' => [
            'category' => 'platform',
            'complexity' => 'alta',
            'dependencies' => ['Tenancy architecture', 'Tenant billing', 'Quota monitoring'],
        ],
        'portal-cliente-selfservice' => [
            'category' => 'engagement',
            'complexity' => 'media',
            'dependencies' => ['Billing integration', 'Ticketing system', 'Authentication'],
        ],
        'gestion-promociones-cupones' => [
            'category' => 'commerce',
            'complexity' => 'media',
            'dependencies' => ['Checkout'],
        ],
    ],
];
