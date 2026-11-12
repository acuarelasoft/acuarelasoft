// Registro de la oferta vigente y textos compartidos de las páginas de servicio.
import { formatPrice, pricing } from './pricing';
import { site } from './landing';

export const SERVICES_PATH = '/servicios/';
export const SERVICES_LABEL = 'Servicios';

// Ruta de navegación Inicio › Servicios › página actual (y niveles adicionales opcionales).
export const serviceBreadcrumb = (...trail: { name: string; path: string }[]) => ({
  '@context': 'https://schema.org',
  '@type': 'BreadcrumbList',
  itemListElement: [
    { name: 'Inicio', path: '/' },
    { name: SERVICES_LABEL, path: SERVICES_PATH },
    ...trail,
  ].map((item, index) => ({
    '@type': 'ListItem',
    position: index + 1,
    name: item.name,
    item: `${site.url}${item.path}`,
  })),
});

export interface ServiceDefinition {
  slug: string;
  path: string;
  keyword: string;
  badge: string;
  title: string;
  tagline: string;
  label: string;
  audience: string;
  icon_bg: string;
  icon_path: string;
  techs?: string[];
}

export const WEB_DESIGN_PATH = '/diseno-paginas-web-mexico/';

export const serviceDefinitions: ServiceDefinition[] = [
  {
    slug: 'diseno-paginas-web-mexico',
    path: WEB_DESIGN_PATH,
    keyword: 'diseño de páginas web en CDMX',
    badge: 'Sitios web para negocios',
    title: 'Un sitio web claro y profesional para tu negocio',
    tagline: 'Creamos sitios web para presentar servicios, productos y facilitar el contacto.',
    label: 'Diseño de sitios web',
    audience: 'Para profesionales, despachos, consultorios y negocios locales.',
    icon_bg: 'bg-acuarela-400/10',
    icon_path:
      'M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42',
  },
];

export const serviceOptions = [
  { value: 'websites', path: WEB_DESIGN_PATH, label: 'Sitios web' },
  { value: 'online-stores', path: '/servicios/tiendas-en-linea/', label: 'Tiendas en línea' },
  {
    value: 'commercial-photography',
    path: '/servicios/fotografia-comercial/',
    label: 'Fotografía comercial',
  },
  { value: 'seo-analytics', path: '/servicios/seo-analitica/', label: 'SEO y analítica' },
  { value: 'content-campaigns', path: '/servicios/contenido-campanas/', label: 'Contenido y campañas' },
  { value: 'wordpress-care', path: '/servicios/mantenimiento-wordpress/', label: 'Mantenimiento WordPress' },
];

export interface ServiceText {
  meta_title: string;
  meta_description: string;
  badge: string;
  title: string;
  tagline: string;
  description: string;
  features: { title: string; desc: string }[];
  process: string[];
  cta_title: string;
}

export const serviceShared = {
  cta_contact: 'Solicitar cotización',
  features_title: 'Un sitio pensado para tu negocio',
  process_title: '¿Cómo trabajamos? Así de simple',
  cta_section_subtitle: 'Cuéntanos qué necesitas; definimos contigo el alcance y la propuesta.',
  cta_badge: 'Soluciones digitales para negocios',
};

export const webDesignOffering = {
  title: '¿Qué incluye tu proyecto?',
  subtitle:
    'Creamos tu sitio web y, si lo necesitas, puedes sumar fotografías para presentarlo mejor.',
  design_badge: 'Sitio web',
  design_title: 'Tu negocio, claro y profesional online',
  design_desc:
    'Presencia Digital Esencial incluye un sitio de una página con hasta seis secciones, adaptado a móviles, con WhatsApp, formulario sencillo y 12 meses de hosting. Secciones, páginas y fotografía se contratan aparte.',
  design_price: `Desde ${formatPrice(pricing.webDesign.startingPrice)} + IVA por proyecto`,
  photo_badge: 'Opcional · Sujeto a confirmar ubicación en CDMX',
  photo_title: 'Fotografías para tu sitio',
  photo_desc: `Una sesión de establecimiento de hasta ${pricing.photography.sessionMinutes} minutos en una ubicación y ${pricing.photography.editedPhotos} fotografías editadas.`,
  photo_price: `Desde ${formatPrice(pricing.photography.establishmentSessionPrice)} + IVA por sesión`,
  pricing_disclaimer: `Precios base sujetos al alcance descrito. Hosting incluido 12 meses; después ${formatPrice(pricing.webDesign.hostingMonthly)} + IVA al mes. Dominio, correo corporativo y licencias se cotizan por separado.`,
};
