import { formatPrice, pricing } from './pricing';

export const faqs = [
  {
    q: '¿Qué opción necesita mi negocio?',
    a: 'Presencia Digital Esencial es la base para una página de presentación y contacto. Si necesitas más, puedes agregar secciones, páginas o fotografía comercial. Cuidado WordPress es para un sitio institucional sano, sujeto a revisión. Si tienes otra necesidad, cuéntanos para definir el alcance.',
  },
  {
    q: '¿Cuánto cuesta y qué incluye?',
    a: `Presencia Digital Esencial parte de $8,900 MXN + IVA por un sitio de una página con hasta seis secciones e incluye 12 meses de hosting. A partir del mes 13, el hosting administrado cuesta $350 MXN + IVA al mes. Los extras se cotizan aparte: sección adicional $1,200, página adicional desde $1,800 y fotografía de establecimiento ${formatPrice(pricing.photography.establishmentSessionPrice)}, todos + IVA.`,
  },
  {
    q: '¿Dominio y hosting están incluidos?',
    a: 'El hosting y el certificado de seguridad están incluidos durante 12 meses desde la publicación; después continúan por $350 MXN + IVA al mes con el hosting administrado por AcuarelaSoft. Si prefieres no continuar, te entregamos los archivos del proyecto o te ayudamos a migrar a otra plataforma de hosting. El dominio, el correo corporativo y las licencias se cotizan por separado.',
  },
  {
    q: '¿Qué materiales debo entregar?',
    a: 'Para los proyectos web, comparte textos, logotipo e imágenes con autorización de uso. Esencial incluye la carga de textos e imágenes proporcionados, no redacción completa. Si contratas fotografía, coordinamos la sesión.',
  },
  {
    q: '¿Cuánto tarda un proyecto?',
    a: 'Como referencia, Esencial toma de dos a tres semanas desde que se reciben el anticipo, los materiales y accesos completos. Las secciones, páginas o fotografía adicionales pueden ampliar el plazo. El calendario se confirma en la propuesta.',
  },
  {
    q: '¿Puedo contratar solo fotografía o mantenimiento?',
    a: `Sí. La fotografía comercial puede cotizarse por separado; una sesión de establecimiento parte de ${formatPrice(pricing.photography.establishmentSessionPrice)} + IVA e incluye hasta ${pricing.photography.sessionMinutes} minutos en una ubicación y ${pricing.photography.editedPhotos} fotografías editadas. Cuidado WordPress se contrata por separado, sujeto a revisión y admisión.`,
  },
  {
    q: '¿Puedo actualizar el sitio por mi cuenta?',
    a: 'Depende de la plataforma y el alcance. Esencial se desarrolla en Astro y no incluye CMS ni edición autogestionable. Un blog autoadministrable u otra forma de edición requiere otro presupuesto.',
  },
  {
    q: '¿Qué diferencia hay entre catálogo y tienda?',
    a: `Un catálogo informativo muestra productos o servicios sin compra en línea. Una tienda incluye carrito, pagos y gestión de pedidos, y es un servicio aparte: personalización de tu tienda Shopify desde ${formatPrice(pricing.onlineStores.shopify.price)} + IVA o tienda WooCommerce desde ${formatPrice(pricing.onlineStores.woocommerce.price)} + IVA con un año de hosting.`,
  },
  {
    q: '¿Qué ocurre después de publicar?',
    a: 'Publicamos tu sitio en el hosting administrado por AcuarelaSoft y tienes 30 días de garantía para corregir defectos técnicos de la entrega. Los cambios posteriores no están incluidos en el hosting y se cotizan antes de realizarse.',
  },
  {
    q: '¿El servicio incluye posicionamiento continuo o publicidad?',
    a: 'La configuración técnica inicial para buscadores no es SEO mensual. Seguimiento SEO, gestión de anuncios y producción de contenido son alcances distintos. El presupuesto de publicidad se paga aparte.',
  },
] as const;
