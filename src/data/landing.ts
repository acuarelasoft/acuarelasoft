// Textos compartidos de la portada y del formulario de contacto.
import { formatPrice, pricing } from './pricing';

export const landing = {
  meta_title: 'AcuarelaSoft | Sitios web y soluciones digitales en CDMX',
  meta_description:
    'Sitios web, tiendas en línea y fotografía comercial para negocios y profesionales en CDMX. Soluciones digitales con alcance y cotización claros.',

  nav_services: 'Servicios',
  nav_services_all: 'Explorar servicios',
  nav_process: 'Cómo trabajamos',
  nav_why_us: 'Nosotros',
  nav_faq: 'Preguntas frecuentes',
  nav_contact: 'Contacto',
  nav_cta: 'Solicitar cotización',

  hero_badge: 'Soluciones digitales para negocios en CDMX',
  hero_headline_top: 'Sitios web y fotografía',
  hero_headline_gradient: 'para negocios en CDMX',
  hero_subheadline:
    'Creamos sitios web, tiendas en línea y fotografía comercial para negocios y profesionales en CDMX. Te ayudamos a mostrar lo que ofreces, facilitar el contacto y mantener tu presencia digital.',
  hero_cta_primary: 'Solicitar cotización',
  hero_cta_secondary: 'Explorar servicios',
  hero_trust_experience: 'Fotografía original según alcance',
  hero_trust_stack: 'Diseño adaptable',
  hero_trust_ux: 'Alcance definido antes de iniciar',

  slider_title: 'Servicios de diseño web, fotografía y marketing digital',
  slider_subtitle: 'Desde presentar lo que haces hasta mantener tu sitio y medir su actividad.',
  slider_cards: [
    {
      value: 'websites',
      label: 'Sitios web',
      title: 'Presenta tus servicios y facilita el contacto',
      description:
        'Sitios corporativos, landing pages y catálogos informativos, definidos según el alcance.',
      image: '/assets/solutions/websites.jpeg',
    },
    {
      value: 'online-stores',
      label: 'Tiendas en línea',
      title: 'Muestra productos, recibe pedidos y acepta pagos',
      description:
        `Personalización Shopify desde ${formatPrice(pricing.onlineStores.shopify.price)} + IVA o tienda WooCommerce desde ${formatPrice(pricing.onlineStores.woocommerce.price)} + IVA con un año de hosting.`,
      image: '/assets/solutions/web-apps.jpeg',
    },
    {
      value: 'commercial-photography',
      label: 'Fotografía comercial',
      title: 'Muestra productos, espacios, servicios y equipo',
      description:
        'Imágenes originales para web y publicidad. Puede contratarse por separado o en un paquete que la incluya.',
      image: '/assets/solutions/fotografia-comercial.svg',
    },
    {
      value: 'seo-analytics',
      label: 'SEO y analítica',
      title: 'Mejora tu información en buscadores y mide visitas',
      description:
        'La configuración inicial y el seguimiento recurrente son alcances distintos.',
      image: '/assets/solutions/web-api.jpeg',
    },
    {
      value: 'content-campaigns',
      label: 'Contenido y campañas',
      title: 'Comunica tu oferta con contenidos y anuncios',
      description:
        'Contenido asistido por IA con revisión humana. Producción, gestión de anuncios y pauta se evalúan y cotizan por separado.',
      image: '/assets/solutions/mobile-apps.jpeg',
    },
    {
      value: 'wordpress-care',
      label: 'Mantenimiento WordPress',
      title: 'Cuida y actualiza tu sitio',
      description:
        'Prevención, respaldos y cambios acordados, sujetos a revisión y admisión del sitio.',
      image: '/assets/solutions/maintenance.jpeg',
    },
  ],

  process_title: 'Cómo desarrollamos tu proyecto digital',
  process_subtitle: 'Definimos qué necesitas, qué incluye la propuesta y cómo avanzar.',
  process_steps: [
    { name: 'Nos cuentas tu necesidad', desc: 'Comparte qué hace tu negocio y qué te gustaría resolver.' },
    { name: 'Definimos la propuesta', desc: 'Acordamos alcance, materiales, precio y calendario antes de iniciar.' },
    { name: 'Producimos y revisamos', desc: 'Realizamos lo contratado y revisamos los ajustes incluidos.' },
    { name: 'Publicamos y damos continuidad', desc: 'Publicamos tu sitio, administramos el hosting y definimos cualquier servicio posterior que necesites.' },
  ],
  process_note: 'El trabajo comienza con anticipo, materiales y accesos completos.',

  why_title: 'Por qué elegir AcuarelaSoft para tu proyecto digital',
  why_subtitle: 'Cada propuesta indica qué se entrega, en qué plazo y qué servicios son opcionales.',
  why_cards: [
    {
      title: 'Presentación profesional',
      desc: 'Organizamos la información del negocio y sumamos fotografías originales cuando forman parte del alcance.',
    },
    {
      title: 'Contacto sencillo',
      desc: 'Integramos WhatsApp y formularios según las necesidades del proyecto.',
    },
    {
      title: 'Medición definida',
      desc: 'Configuramos herramientas y eventos cuando están incluidos en el alcance aprobado.',
    },
    {
      title: 'Continuidad acordada',
      desc: 'El mantenimiento se contrata por separado y se admite después de revisar el sitio.',
    },
    {
      title: 'Claridad comercial',
      desc: 'Recibes una propuesta con entregables, plazos, costos y servicios externos identificados.',
    },
  ],

  offer_badge: 'Soluciones digitales para tu negocio',
  offer_title: 'Cuéntanos qué necesita tu negocio',
  offer_desc:
    'Revisaremos tu solicitud para definir el alcance y preparar una propuesta acorde con lo que necesitas.',
  offer_benefits: [
    'Cuéntanos qué quieres presentar, mejorar o mantener.',
    'Elige una línea de servicio o pide orientación.',
    'Definimos contigo entregables, precio y calendario.',
  ],
  offer_note: 'Cuéntanos qué necesitas; definimos contigo el alcance y la propuesta.',

  contact_title: 'Solicitar cotización',
  contact_subtitle: 'Comparte una forma de contacto y una descripción breve de lo que buscas.',
  contact_name: 'Nombre',
  contact_email: 'Correo electrónico',
  contact_company: 'Nombre del negocio (opcional)',
  contact_phone: 'WhatsApp (opcional)',
  contact_topic: '¿Qué necesita tu negocio?',
  contact_message: 'Cuéntanos brevemente qué necesitas',
  contact_message_hint: 'Ejemplo: Quiero presentar mis servicios, renovar mi sitio o mostrar mis productos. Máximo 500 caracteres.',
  contact_submit: 'Solicitar cotización',
  contact_note: 'Revisaremos tu solicitud para definir el alcance y la propuesta.',
  contact_privacy: 'Consulta nuestro aviso de privacidad.',
  contact_select_placeholder: 'Selecciona',
  contact_status_sending: 'Enviando…',
  contact_status_success: 'Recibimos tu solicitud. Revisaremos lo que necesitas para definir el alcance y la propuesta.',
  contact_status_validation: 'Revisa los campos marcados e intenta de nuevo.',
  contact_status_captcha: 'No se pudo completar la verificación. Intenta de nuevo.',
  contact_status_error: 'No se pudo enviar la solicitud. Intenta de nuevo o contáctanos por correo o WhatsApp.',
  contact_status_network: 'Error de red. Intenta de nuevo o contáctanos por WhatsApp.',
  contact_status_missing_config: 'El formulario no está disponible. Mientras tanto, escríbenos por correo o WhatsApp.',

  footer_tagline: 'Creatividad y tecnología para hacerte visible',
  footer_tagline_description:
    'Sitios web, fotografía comercial y soluciones digitales para crear, mejorar y mantener tu presencia en internet.',
  footer_services_heading: 'Servicios',
  footer_company_heading: 'Compañía',
  footer_company_about: 'Nosotros',
  footer_get_in_touch_heading: 'Contacto',
  footer_social_heading: 'Redes',
  footer_location: 'Ciudad de México, México',
  footer_copyright: '© {year} AcuarelaSoft. Todos los derechos reservados.',
};

export const site = {
  name: 'AcuarelaSoft',
  url: 'https://acuarelasoft.com',
  email: 'contacto@acuarelasoft.com',
  phoneCdmx: '+52 56 4944 0190',
  whatsappCdmx: 'https://wa.me/525649440190',
  whatsappFloat:
    'https://wa.me/525649440190?text=Hola%2C%20quiero%20consultar%20sobre%20una%20soluci%C3%B3n%20digital%20para%20mi%20negocio.',
  linkedin: 'https://www.linkedin.com/in/rodrigo-sanvicente/',
  github: 'https://github.com/acuarelasoft/',
  languageTag: 'es-MX',
  ogLocale: 'es_MX',
};
