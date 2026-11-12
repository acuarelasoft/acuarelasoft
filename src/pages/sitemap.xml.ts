import { serviceOptions } from '../data/services';
import { site } from '../data/landing';

interface SitemapEntry {
  path: string;
  changefreq: 'daily' | 'weekly' | 'monthly' | 'yearly';
  priority: string;
}

export function GET(): Response {
  const today = new Date().toISOString().split('T')[0];

  const entries: SitemapEntry[] = [
    { path: '/', changefreq: 'weekly', priority: '1.0' },
    { path: '/servicios/', changefreq: 'monthly', priority: '0.9' },
    ...serviceOptions.map((service) => ({
      path: service.path,
      changefreq: 'monthly' as const,
      priority: '0.8',
    })),
    { path: '/contacto/', changefreq: 'monthly', priority: '0.6' },
    { path: '/nosotros/', changefreq: 'monthly', priority: '0.6' },
    { path: '/preguntas-frecuentes/', changefreq: 'monthly', priority: '0.6' },
    { path: '/aviso-privacidad/', changefreq: 'yearly', priority: '0.3' },
    { path: '/mapa-sitio/', changefreq: 'monthly', priority: '0.3' },
  ];

  const body =
    `<?xml version="1.0" encoding="UTF-8"?>\n` +
    `<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n` +
    entries
      .map(
        (entry) =>
          `  <url>\n    <loc>${site.url}${entry.path}</loc>\n    <lastmod>${today}</lastmod>\n    <changefreq>${entry.changefreq}</changefreq>\n    <priority>${entry.priority}</priority>\n  </url>`,
      )
      .join('\n') +
    `\n</urlset>\n`;

  return new Response(body, {
    headers: { 'Content-Type': 'application/xml; charset=UTF-8' },
  });
}
