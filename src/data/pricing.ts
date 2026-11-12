const photography = {
  establishmentSessionPrice: 4900,
  sessionMinutes: 90,
  editedPhotos: 15,
};

export const pricing = {
  currency: 'MXN',
  webDesign: {
    startingPrice: 8900,
    includedHostingMonths: 12,
    hostingMonthly: 350,
    hostingName: 'Hosting administrado',
    hostingIncludes: [
      'Alojamiento y certificado de seguridad.',
      'Conservación de una copia recuperable del sitio.',
      'Monitoreo automático de disponibilidad.',
      'Gestión básica de configuración y atención de incidencias del alojamiento por agenda.',
    ],
    hostingExcludes: [
      'Cambios de contenido, nuevas secciones o páginas; se cotizan aparte.',
      'Dominio y correo corporativo.',
    ],
    hostingExit:
      'Si después de los 12 meses no deseas continuar con el hosting administrado por AcuarelaSoft, te entregamos los archivos del proyecto o te ayudamos a migrar tu sitio a otra plataforma de hosting.',
  },
  photography,
  extras: [
    {
      id: 'photography',
      name: 'Fotografía de establecimiento',
      price: photography.establishmentSessionPrice,
      from: false,
      description: `Una ubicación, sesión de hasta ${photography.sessionMinutes} minutos y ${photography.editedPhotos} fotografías editadas.`,
    },
    {
      id: 'section',
      name: 'Sección adicional',
      price: 1200,
      from: false,
      description: 'Un bloque de contenido sencillo dentro de la misma página, como testimonios o galería.',
    },
    {
      id: 'page',
      name: 'Página adicional',
      price: 1800,
      from: true,
      description: 'Cada página interior adicional a la página base, con su propia dirección y basada en el diseño aprobado.',
    },
    {
      id: 'update',
      name: 'Actualizar o modificar una sección o página existente',
      price: 850,
      from: true,
      description: 'Cambios de textos, imágenes, datos o acomodo en una sección o página ya publicada, hasta 1 hora de trabajo. Cambios mayores se cotizan antes de realizarse.',
    },
  ],
  packages: [
    {
      id: 'essential',
      service: 'websites',
      name: 'Presencia Digital Esencial',
      price: 8900,
      billing: 'por proyecto',
      audience: 'Sitio informativo de una sola página para presentar tu negocio y recibir contactos.',
      includes: [
        'Una sola página informativa con hasta seis secciones, adaptada a celular y computadora.',
        'WhatsApp, formulario de contacto sencillo y enlaces a redes.',
        'Configuración básica para buscadores y carga de textos e imágenes proporcionados.',
        'Dos rondas de ajustes y publicación del sitio.',
        'Hosting y certificado de seguridad durante 12 meses desde la publicación.',
        'Garantía de corrección de defectos técnicos durante 30 días.',
      ],
      conditions: [
        'Al terminar los 12 meses, puedes continuar con el hosting administrado o recibir los archivos del proyecto y apoyo para migrar a otro hosting.',
        'El cliente proporciona textos, logotipo e imágenes. Dominio y correo corporativo se cotizan por separado.',
        'Tienda, blog autoadministrable, reservas, pagos e integraciones requieren otro presupuesto.',
      ],
    },
  ],
  onlineStores: {
    shopify: {
      id: 'shopify-customization',
      name: 'Shopify · Personalización',
      price: 8900,
      billing: 'por proyecto',
      audience: 'Para negocios que ya tienen cuenta, tema y catálogo utilizables en Shopify y quieren una tienda con mejor presentación.',
      includes: [
        'Adaptación de colores, tipografías, logotipo y distribución mediante las opciones del tema.',
        'Página de inicio con hasta seis secciones.',
        'Organización del menú y hasta cinco colecciones.',
        'Ajustes de presentación en hasta diez productos simples.',
        'Carga de hasta tres páginas informativas con textos proporcionados.',
        'Revisión visual en celular y computadora.',
        'Comprobación de una compra con la configuración existente.',
        'Dos rondas de ajustes y capacitación de una hora.',
      ],
      conditions: [
        'La suscripción a Shopify, dominio, temas de pago, aplicaciones y comisiones los paga el cliente directamente.',
        'El hosting está incluido en la suscripción que el cliente paga a Shopify.',
        'No incluye migraciones ni programación especial.',
      ],
      payments: [
        { label: 'Pago inicial', amount: 4450, when: 'Al inicio, junto con los accesos a la tienda.' },
        { label: 'Pago final', amount: 4450, when: 'Al entregar la tienda personalizada.' },
      ],
      fromScratch: {
        id: 'shopify-setup',
        name: 'Shopify desde cero',
        price: 12900,
        description: 'Si todavía no tienes tienda configurada, incluye todo lo anterior más:',
        adds: [
          'Carga de diez productos simples.',
          'Configuración de una pasarela de pago.',
          'Hasta dos reglas sencillas de envío.',
        ],
        note: 'Sin migraciones ni programación especial.',
      },
      officialPricingUrl: 'https://www.shopify.com/mx/precios',
    },
    woocommerce: {
      id: 'woocommerce-store',
      name: 'WooCommerce · Tienda inicial',
      price: 29900,
      billing: 'por proyecto',
      includedHostingMonths: 12,
      audience: 'Para negocios que quieren una tienda propia en WordPress, diseñada y configurada por AcuarelaSoft y administrada por su equipo.',
      includes: [
        'Instalación de WordPress y WooCommerce.',
        'Personalización sobre un tema estándar.',
        'Inicio de hasta seis secciones, catálogo, ficha de producto, carrito y pago.',
        'Hasta tres páginas informativas con textos proporcionados.',
        'Carga de veinte productos simples y cinco categorías.',
        'Una pasarela de pago y hasta dos reglas sencillas de envío.',
        'Configuración básica para buscadores.',
        'Pruebas de compra, correos de pedido y visualización móvil.',
        'Dos rondas de ajustes y capacitación de dos horas.',
        'Hosting, certificado de seguridad y respaldos durante 12 meses desde la publicación.',
        'Garantía de corrección de defectos de la entrega durante 30 días.',
      ],
      excludes: [
        'Variantes complejas.',
        'Facturación automática.',
        'Integración con ERP.',
        'Suscripciones o marketplace.',
        'Migración de pedidos.',
        'Desarrollo especial.',
      ],
      payments: [
        { label: 'Primer pago', amount: 9967, when: 'Al inicio, junto con materiales y accesos.' },
        { label: 'Segundo pago', amount: 9967, when: 'Al aprobar el diseño de la tienda.' },
        { label: 'Pago final', amount: 9966, when: 'Al publicar la tienda.' },
      ],
      maintenanceNotice:
        'El hosting incluido no equivale a un año de mantenimiento. Las actualizaciones y comprobaciones de plugins deben tener un responsable desde la publicación: AcuarelaSoft mediante un plan de cuidado técnico, tu equipo u otro proveedor.',
    },
    care: [
      {
        id: 'store-hosting',
        name: 'Hosting administrado',
        price: 790,
        when: 'Desde el mes 13',
        optional: false,
        description: 'Alojamiento, certificado de seguridad, respaldos y gestión de incidencias del alojamiento.',
      },
      {
        id: 'store-care',
        name: 'Cuidado técnico durante el primer año',
        price: 1700,
        when: 'Meses 1 a 12',
        optional: true,
        description: 'Actualizaciones, comprobación básica de compra y hasta 30 minutos de cambios al mes.',
      },
      {
        id: 'store-hosting-care',
        name: 'Hosting y cuidado técnico',
        price: 2490,
        when: 'Desde el mes 13',
        optional: true,
        description: 'Sustituye los dos conceptos anteriores; no se cobra además del hosting administrado de $790.',
      },
    ],
    careNote:
      'Tarifas para una tienda pequeña, con atención por agenda y sin disponibilidad permanente. El crecimiento de recursos, licencias y reparaciones extensas se cotizan aparte.',
    extras: [
      { id: 'product', name: 'Producto simple adicional', price: 150, description: 'Con datos e imágenes completos; sin redacción ni retoque.' },
      { id: 'section', name: 'Sección adicional', price: 1200, description: 'Bloque sencillo con componentes del tema.' },
      { id: 'page', name: 'Página informativa adicional', price: 1800, description: 'Basada en el diseño aprobado.' },
      { id: 'photography', name: 'Fotografía de producto', price: 6500, description: 'Diez productos simples, dos fotografías por producto.' },
      { id: 'hour', name: 'Trabajo adicional', price: 850, unit: 'por hora', description: 'Con estimación y aprobación previas.' },
      { id: 'custom', name: 'Variantes, integraciones o migraciones', price: null, description: 'Se cotizan según su complejidad.' },
    ] as { id: string; name: string; price: number | null; unit?: string; description: string }[],
  },
  wordpressCare: {
    id: 'wordpress-care',
    service: 'wordpress-care',
    name: 'Cuidado WordPress',
    price: 1500,
    billing: 'al mes',
    audience: 'Para un sitio institucional WordPress sano, sujeto a revisión y admisión.',
    includes: [
      'Actualizaciones programadas, respaldos diarios automatizados y monitoreo automático.',
      'Hasta 30 minutos al mes de cambios simples y atención humana programada.',
    ],
    conditions: [
      'No incluye atención humana 24/7, WooCommerce, hosting, licencias ni reparación de problemas anteriores.',
      'Un sitio externo requiere diagnóstico e incorporación desde $2,900 MXN + IVA antes de admitirlo.',
    ],
  },
};

const numberFormatter = new Intl.NumberFormat('es-MX', {
  maximumFractionDigits: 2,
});

export const formatPrice = (amount: number, suffix: '' | '+' = ''): string =>
  `$${numberFormatter.format(amount)}${suffix} ${pricing.currency}`;
