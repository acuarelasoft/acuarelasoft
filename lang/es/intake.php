<?php

return [
    'meta_title' => 'Módulos para tu web app | AcuarelaSoft',
    'meta_description' => 'Explora los módulos que podemos implementar en tu web app: catálogo, pagos, dashboards, automatización, integraciones y más.',

    'hero_title' => 'Módulos que Podemos Implementar en tu Web App',
    'hero_subtitle' => 'Explora los módulos y capacidades que podemos construir para tu proyecto.',

    'info' => [
        'cta_title' => '¿Quieres que prioricemos un stack para tu proyecto?',
        'cta_description' => 'Cuéntanos tu objetivo de negocio y te ayudamos a definir una primera combinación de módulos, alcance técnico y siguiente paso recomendado.',
        'cta_action' => 'Contactar al equipo',
    ],

    'categories' => [
        'platform' => 'Plataforma base',
        'commerce' => 'Comercio y facturación',
        'operations' => 'Operaciones y logística',
        'engagement' => 'Comunicación y engagement',
        'ai_data' => 'IA, datos y contenido',
        'infrastructure' => 'Infraestructura y confiabilidad',
    ],

    'complexity' => [
        'baja' => 'Baja',
        'baja-media' => 'Baja-media',
        'media' => 'Media',
        'media-alta' => 'Media-alta',
        'alta' => 'Alta',
    ],

    'helpers' => [
        'dependencies' => 'Dependencias',
        'use_cases' => 'Casos de uso',
    ],

    'modules' => [
        'listing-catalogos' => ['short' => 'Catálogo', 'label' => 'Listing y catálogos', 'description' => 'Gestión de colecciones de ítems con CRUD, filtros, búsqueda y paginación para alto volumen.', 'use_cases' => ['Catálogo de e-commerce', 'Directorios de servicios', 'Catálogos multicanal']],
        'gestion-usuarios-permissions' => ['short' => 'Usuarios y permisos', 'label' => 'Gestión de usuarios y permissions', 'description' => 'Gestión de usuarios, roles y permisos con administración de accesos empresariales.', 'use_cases' => ['Paneles de permisos granulares', 'Delegación de roles', 'Control de acceso corporativo']],
        'sistema-facturacion' => ['short' => 'Facturación', 'label' => 'Sistema de facturación', 'description' => 'Generación de facturas y documentos fiscales con soporte recurrente y puntual.', 'use_cases' => ['Facturación B2B/B2C', 'Documentos fiscales', 'Conciliación']],
        'conexiones-terceros' => ['short' => 'Integración API', 'label' => 'Conexiones a terceros', 'description' => 'Consumo y exposición de APIs externas con reintentos y validación de contratos.', 'use_cases' => ['Sincronización con ERP', 'Consumo de API de partners', 'Gestión de webhooks']],
        'envio-correos-masivos' => ['short' => 'Correos masivos', 'label' => 'Envío de correos masivos', 'description' => 'Envío masivo con plantillas, personalización y métricas de apertura/clics.', 'use_cases' => ['Campañas transaccionales', 'Notificaciones masivas', 'Correos resumen']],
        'newsletter' => ['short' => 'Newsletter', 'label' => 'Newsletter', 'description' => 'Creación, programación y segmentación de boletines con analítica de campañas.', 'use_cases' => ['Comunicaciones periódicas', 'Onboarding por correo', 'Boletines semanales']],
        'maps-geolocation' => ['short' => 'Mapas y geo', 'label' => 'Maps y geolocalización', 'description' => 'Geocodificación, rutas y consultas por proximidad con proveedores de mapas.', 'use_cases' => ['Localizador de sucursales', 'Rutas de entrega', 'Búsqueda cercana']],
        'chatbots-whatsapp-telegram' => ['short' => 'Chatbots mensajería', 'label' => 'Chatbots WhatsApp/Telegram', 'description' => 'Responde automáticamente mensajes frecuentes en WhatsApp o Telegram, guía a los usuarios paso a paso y deriva a una persona cuando el caso lo requiere.', 'use_cases' => ['Soporte automatizado', 'Notificaciones interactivas', 'Flujos guiados']],
        'mensajeria-privada' => ['short' => 'Mensajería privada', 'label' => 'Mensajería privada in-app', 'description' => 'Mensajería entre usuarios con historial, notificaciones y moderación.', 'use_cases' => ['Conversaciones cliente-agente', 'Mensajería dentro de la app', 'Soporte interno']],
        'pasarela-pagos' => ['short' => 'Pagos', 'label' => 'Pasarela de pagos', 'description' => 'Procesamiento seguro de pagos con tokenización, antifraude y conciliación.', 'use_cases' => ['Cobro de suscripciones', 'Checkout e-commerce', 'Micropagos']],
        'sistema-agendar' => ['short' => 'Agenda y citas', 'label' => 'Sistema de agendar', 'description' => 'Calendarios, disponibilidad y recordatorios con manejo de zonas horarias.', 'use_cases' => ['Reservas de salas', 'Agendamiento médico', 'Citas de servicio']],
        'formularios' => ['short' => 'Formularios dinámicos', 'label' => 'Formularios dinámicos', 'description' => 'Formularios con lógica condicional, validaciones, versionado y webhooks.', 'use_cases' => ['Formularios de registro', 'Encuestas', 'Formularios avanzados']],
        'integraciones-ia' => ['short' => 'IA integrada', 'label' => 'Integraciones de IA', 'description' => 'Integración de modelos de IA en workflows con control de costo y latencia.', 'use_cases' => ['Clasificación automática', 'Generación de texto', 'Recomendaciones']],
        'repositorio-archivos' => ['short' => 'Repositorio archivos', 'label' => 'Repositorio de archivos', 'description' => 'Gestión de archivos con versionado, permisos, previews y búsqueda por metadata.', 'use_cases' => ['Biblioteca multimedia', 'Repositorio documental', 'Sincronización con clientes']],
        'transcripcion-traduccion-ia' => ['short' => 'Transcripción IA', 'label' => 'Transcripción y traducción IA', 'description' => 'Transcripción y traducción de audio/video con timestamps y detección de idioma.', 'use_cases' => ['Subtítulos automáticos', 'Indexación de reuniones', 'Traducción de contenido multimedia']],
        'almacen-entradas-salidas' => ['short' => 'Gestión almacén', 'label' => 'Función de almacén', 'description' => 'Control de inventario con entradas/salidas, lotes y alertas de stock crítico.', 'use_cases' => ['Inventario de productos', 'Control de suministros', 'Alertas de reposición']],
        'control-asistencia' => ['short' => 'Control asistencia', 'label' => 'Control de asistencia', 'description' => 'Registro de asistencia con turnos, excepciones y reportes para nómina.', 'use_cases' => ['Control de tiempo', 'Turnos rotativos', 'Reportes de nómina']],
        'identificacion-biometrica' => ['short' => 'Biométrico', 'label' => 'Identificación biométrica', 'description' => 'Enrolamiento y verificación biométrica con enfoque en seguridad y privacidad.', 'use_cases' => ['Acceso seguro', 'Verificación KYC', 'Verificación de asistencia']],
        'venta-tickets' => ['short' => 'Venta tickets', 'label' => 'Venta de tickets y boletos', 'description' => 'Emisión, reserva y validación de entradas con QR/barcode y reembolsos.', 'use_cases' => ['Ticketing de eventos', 'Boletos de transporte', 'Reserva de actividades']],
        'punto-venta' => ['short' => 'Punto de venta', 'label' => 'Punto de venta (POS)', 'description' => 'Ventas presenciales con hardware, inventario en tiempo real y sincronización.', 'use_cases' => ['Tiendas retail', 'Restaurantes', 'Kioscos']],
        'kpis-dashboards' => ['short' => 'KPIs y alertas', 'label' => 'KPIs, paneles y alertas', 'description' => 'Te permite ver en un solo lugar si el negocio va bien o mal con indicadores claros (ventas, tiempos, cumplimiento) y recibir alertas tempranas para corregir antes de que el problema crezca.', 'use_cases' => ['Seguimiento de KPIs del negocio', 'Seguimiento de ventas', 'Monitoreo de SLA', 'Salud del sistema', 'Alertas de capacidad', 'Monitoreo operativo']],
        'informes-exportacion' => ['short' => 'Archivos e informes', 'label' => 'Generación de archivos, informes y exportación', 'description' => 'Genera documentos y reportes en PDF/XLSX/CSV, con filtros, programación automática y exportación segura para compartir con clientes o terceros.', 'use_cases' => ['Reportes contables', 'Reportes descargables', 'Estados de cuenta', 'Contratos', 'Exportaciones a terceros']],
        'sistema-arriendo' => ['short' => 'Gestión arriendos', 'label' => 'Sistema de arriendo', 'description' => 'Gestión de contratos, periodos, pagos y documentos de arriendo.', 'use_cases' => ['Arriendo de propiedades', 'Arriendo de equipos', 'Arriendo de vehículos']],
        'suscripciones' => ['short' => 'Subscripciones', 'label' => 'Subscripciones', 'description' => 'Planes recurrentes con upgrades, downgrades y gestión de ciclos de cobro.', 'use_cases' => ['Planes SaaS', 'Membresías', 'Suscripciones anuales']],
        'multi-idioma' => ['short' => 'Multi idioma', 'label' => 'Multi idioma (i18n/l10n)', 'description' => 'Internacionalización y localización con formatos regionales por usuario.', 'use_cases' => ['Apps multinacionales', 'Contenido localizado', 'Interfaz traducible']],
        'paqueteria-seguimiento-flota' => ['short' => 'Seguimiento y flota', 'label' => 'Paquetería y flota', 'description' => 'Permite ver en un mapa dónde va cada envío, estimar hora de llegada, organizar rutas de reparto y detectar atrasos para actuar a tiempo.', 'use_cases' => ['Entregas a domicilio', 'Gestión de flota', 'Marketplace de transporte']],
        'autenticacion-avanzada' => ['short' => 'Autenticación avanzada', 'label' => 'Autenticación avanzada', 'description' => 'SSO, MFA y federación OAuth/OIDC/SAML para entornos corporativos.', 'use_cases' => ['Integración con directorio empresarial', 'Inicio de sesión único entre aplicaciones']],
        'registro-eventos-telemetria' => ['short' => 'Telemetría eventos', 'label' => 'Registro de eventos y telemetría', 'description' => 'Registra lo que ocurre en el sistema y cómo lo usan las personas para detectar problemas, medir resultados y tomar decisiones con datos reales.', 'use_cases' => ['Embudos de producto', 'Seguimiento de comportamiento', 'Analítica de uso']],
        'busqueda-avanzada' => ['short' => 'Búsqueda avanzada', 'label' => 'Búsqueda avanzada y relevancia', 'description' => 'Ayuda a que las personas encuentren más rápido lo que buscan con filtros útiles, sugerencias automáticas y resultados mejor ordenados.', 'use_cases' => ['Búsqueda en catálogo', 'Descubrimiento de contenido', 'Autocompletado']],
        'cms-gestion-contenido' => ['short' => 'CMS Headless', 'label' => 'CMS / Gestión de contenido', 'description' => 'Edición y publicación de contenido con APIs headless para frontend y mobile.', 'use_cases' => ['Landing pages', 'Blogs', 'Gestión de contenido']],
        'feature-flags' => ['short' => 'Feature flags', 'label' => 'Feature flags y lanzamientos', 'description' => 'Activa o desactiva funciones sin desplegar de nuevo, con lanzamiento gradual por entorno, segmento o porcentaje de usuarios y reversa rápida ante fallos.', 'use_cases' => ['Despliegues controlados', 'Lanzamientos canary', 'Reversión rápida de funcionalidades']],
        'experimentacion-ab-testing' => ['short' => 'A/B testing', 'label' => 'Experimentación y A/B testing', 'description' => 'Compara variantes reales de una funcionalidad para medir qué opción rinde mejor con datos y validar decisiones antes de escalar cambios.', 'use_cases' => ['Optimización de conversión', 'Experimentos de interfaz', 'Validación de hipótesis']],
        'trazabilidad-tracing-error-tracking' => ['short' => 'Tracing & Errors', 'label' => 'Trazabilidad y errores', 'description' => 'Tracing distribuido y correlación de errores para debugging avanzado.', 'use_cases' => ['Diagnóstico de latencia', 'Correlación de fallos', 'Seguimiento de excepciones']],
        'api-gateway-gestion-trafico' => ['short' => 'API Gateway', 'label' => 'API Gateway y tráfico', 'description' => 'Control de tráfico API con autenticación, rate limiting y cuotas.', 'use_cases' => ['Exposición de API pública', 'Cuotas por cliente', 'Caché de respuestas']],
        'scheduler-background-jobs' => ['short' => 'Jobs y workers', 'label' => 'Scheduler y background jobs', 'description' => 'Orquestación asíncrona de tareas con retries y priorización.', 'use_cases' => ['Campañas programadas', 'Procesamiento de medios', 'Sincronizaciones periódicas']],
        'backup-versionado-dr' => ['short' => 'Backup & DR', 'label' => 'Backup, versionado y DR', 'description' => 'Políticas automáticas de backup/restore y recuperación ante desastres.', 'use_cases' => ['Restauración de base de datos', 'Recuperación de archivos', 'Simulacros de DR']],
        'multi-tenant-gestion' => ['short' => 'Multi-tenant', 'label' => 'Multi-tenant y tenancy', 'description' => 'Aislamiento por tenant, onboarding y cuotas para SaaS multiempresa.', 'use_cases' => ['SaaS multiempresa', 'Aislamiento de datos por cliente', 'Onboarding de tenants']],
        'portal-cliente-selfservice' => ['short' => 'Portal cliente', 'label' => 'Portal cliente self-service', 'description' => 'Autoservicio para facturación, soporte, tickets y configuraciones.', 'use_cases' => ['Gestión de suscripciones', 'Descarga de facturas', 'Seguimiento de pedidos']],
        'gestion-promociones-cupones' => ['short' => 'Promociones y cupones', 'label' => 'Promociones, cupones y fidelización', 'description' => 'Reglas de descuentos, cupones y programas de fidelización en checkout.', 'use_cases' => ['Campañas de descuentos', 'Puntos de fidelización', 'Cupones de marketing']],
    ],
];
