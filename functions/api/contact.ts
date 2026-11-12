interface ContactEnv {
  RESEND_API_KEY?: string;
  RESEND_FROM?: string;
  CONTACT_TO?: string;
  TURNSTILE_SECRET_KEY?: string;
  CONTACT_ALLOWED_ORIGINS?: string;
}

interface ContactPayload {
  name: string;
  email: string;
  company: string;
  phone: string;
  project_type: string;
  package: string;
  site_type: string;
  availability: string;
  message: string;
  website: string;
  'cf-turnstile-response': string;
}

const MAX_BODY_BYTES = 16_384;
const PROJECT_TYPES = new Set([
  'website',
  'websites',
  'online-stores',
  'commercial-photography',
  'seo-analytics',
  'content-campaigns',
  'wordpress-care',
  'not-sure',
]);
const PACKAGES = new Set([
  '',
  'essential',
  'wordpress-care',
  'shopify-customization',
  'shopify-setup',
  'woocommerce-store',
]);
const SITE_TYPES = new Set([
  '',
  'corporate',
  'local-business',
  'professional',
  'landing-page',
  'informational-catalog',
  'not-sure',
]);
const AVAILABILITIES = new Set(['', 'morning', 'afternoon', 'evening', 'flexible']);
const DEFAULT_CONTACT_TO = 'contacto@acuarelasoft.com';
// Cloudflare's dummy secret keys report hostname "example.com" instead of the real one.
const TURNSTILE_TEST_SECRET = /^[123]x0{31}AA$/;
const PROJECT_TYPE_LABELS: Record<string, string> = {
  website: 'Diseño de sitio web',
  websites: 'Sitios web',
  'online-stores': 'Tiendas en línea',
  'commercial-photography': 'Fotografía comercial',
  'seo-analytics': 'SEO y analítica',
  'content-campaigns': 'Contenido y campañas',
  'wordpress-care': 'Mantenimiento WordPress',
  'not-sure': 'No está seguro; necesita orientación',
};
const PACKAGE_LABELS: Record<string, string> = {
  essential: 'Presencia Digital Esencial',
  'wordpress-care': 'Cuidado WordPress',
  'shopify-customization': 'Shopify · Personalización',
  'shopify-setup': 'Shopify desde cero',
  'woocommerce-store': 'WooCommerce · Tienda inicial',
};
const SITE_TYPE_LABELS: Record<string, string> = {
  corporate: 'Sitio web corporativo',
  'local-business': 'Página para negocio local',
  professional: 'Sitio para profesional',
  'landing-page': 'Landing page para campaña',
  'informational-catalog': 'Catálogo informativo sin compra en línea',
  'not-sure': 'No está seguro todavía',
};

function jsonResponse(body: Record<string, boolean | string>, status = 200): Response {
  return new Response(JSON.stringify(body), {
    status,
    headers: {
      'Content-Type': 'application/json; charset=utf-8',
      'Cache-Control': 'no-store',
    },
  });
}

function readString(value: unknown): string | null {
  return typeof value === 'string' ? value.trim() : null;
}

function escapeHtml(value: string): string {
  return value.replace(/[&<>"']/g, (character) => {
    const entities: Record<string, string> = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;',
    };
    return entities[character];
  });
}

function parsePayload(value: unknown): ContactPayload | null {
  if (!value || typeof value !== 'object' || Array.isArray(value)) return null;

  const body = value as Record<string, unknown>;
  const name = readString(body.name);
  const email = readString(body.email);
  const company = readString(body.company);
  const phone = readString(body.phone);
  const projectType = readString(body.project_type);
  const packageId = body.package === undefined ? '' : readString(body.package);
  const siteType = body.site_type === undefined ? '' : readString(body.site_type);
  const availability = body.availability === undefined ? '' : readString(body.availability);
  const message = readString(body.message);
  const website = readString(body.website);
  const turnstileToken = readString(body['cf-turnstile-response']);

  if (
    name === null ||
    email === null ||
    company === null ||
    phone === null ||
    projectType === null ||
    packageId === null ||
    siteType === null ||
    availability === null ||
    message === null ||
    website === null ||
    turnstileToken === null
  ) {
    return null;
  }

  if (
    name.length === 0 ||
    name.length > 255 ||
    email.length > 255 ||
    (email.length > 0 && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) ||
    company.length > 255 ||
    phone.length > 50 ||
    (email.length === 0 && phone.length === 0) ||
    !PROJECT_TYPES.has(projectType) ||
    !PACKAGES.has(packageId) ||
    !SITE_TYPES.has(siteType) ||
    !AVAILABILITIES.has(availability) ||
    message.length === 0 ||
    message.length > 500 ||
    turnstileToken.length === 0 ||
    turnstileToken.length > 2048
  ) {
    return null;
  }

  return {
    name,
    email,
    company,
    phone,
    project_type: projectType,
    package: packageId,
    site_type: siteType,
    availability,
    message,
    website,
    'cf-turnstile-response': turnstileToken,
  };
}

export async function onRequestPost({
  request,
  env,
}: {
  request: Request;
  env: ContactEnv;
}): Promise<Response> {
  const origin = request.headers.get('Origin');
  const allowedOrigins = (env.CONTACT_ALLOWED_ORIGINS ?? '')
    .split(',')
    .map((allowedOrigin) => allowedOrigin.trim())
    .filter(Boolean);

  if (!allowedOrigins.length || !origin || !allowedOrigins.includes(origin)) {
    return jsonResponse({ ok: false, error: 'origin_not_allowed' }, 403);
  }

  let requestHostname: string;
  try {
    requestHostname = new URL(origin).hostname;
  } catch {
    return jsonResponse({ ok: false, error: 'origin_not_allowed' }, 403);
  }

  if (!env.RESEND_API_KEY || !env.RESEND_FROM || !env.TURNSTILE_SECRET_KEY) {
    console.error('Contact form is missing required Worker secrets or variables.');
    return jsonResponse({ ok: false, error: 'service_unavailable' }, 503);
  }

  if (!request.headers.get('Content-Type')?.toLowerCase().includes('application/json')) {
    return jsonResponse({ ok: false, error: 'invalid_content_type' }, 415);
  }

  const rawBody = await request.text();
  if (new TextEncoder().encode(rawBody).byteLength > MAX_BODY_BYTES) {
    return jsonResponse({ ok: false, error: 'payload_too_large' }, 413);
  }

  let input: unknown;
  try {
    input = JSON.parse(rawBody);
  } catch {
    return jsonResponse({ ok: false, error: 'validation_failed' }, 400);
  }

  const payload = parsePayload(input);
  if (!payload) {
    return jsonResponse({ ok: false, error: 'validation_failed' }, 400);
  }

  if (payload.website) {
    return jsonResponse({ ok: false, error: 'validation_failed' }, 400);
  }

  const turnstileBody = new URLSearchParams({
    secret: env.TURNSTILE_SECRET_KEY,
    response: payload['cf-turnstile-response'],
  });
  const clientIp = request.headers.get('CF-Connecting-IP');
  if (clientIp) turnstileBody.set('remoteip', clientIp);

  let turnstileResult: unknown;
  try {
    const turnstileResponse = await fetch('https://challenges.cloudflare.com/turnstile/v0/siteverify', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      signal: AbortSignal.timeout(10_000),
      body: turnstileBody,
    });
    if (!turnstileResponse.ok) {
      console.error('Turnstile verification returned HTTP', turnstileResponse.status);
      return jsonResponse({ ok: false, error: 'captcha_unavailable' }, 502);
    }
    turnstileResult = await turnstileResponse.json();
  } catch (error) {
    console.error('Turnstile verification request failed:', error);
    return jsonResponse({ ok: false, error: 'captcha_unavailable' }, 502);
  }

  if (
    !turnstileResult ||
    typeof turnstileResult !== 'object' ||
    !('success' in turnstileResult) ||
    !('action' in turnstileResult) ||
    !('hostname' in turnstileResult) ||
    turnstileResult.success !== true ||
    turnstileResult.action !== 'contact' ||
    typeof turnstileResult.hostname !== 'string'
  ) {
    return jsonResponse({ ok: false, error: 'captcha_failed' }, 400);
  }

  const isTestingResult =
    TURNSTILE_TEST_SECRET.test(env.TURNSTILE_SECRET_KEY) &&
    'metadata' in turnstileResult &&
    typeof turnstileResult.metadata === 'object' &&
    turnstileResult.metadata !== null &&
    'result_with_testing_key' in turnstileResult.metadata &&
    turnstileResult.metadata.result_with_testing_key === true;

  if (!isTestingResult && turnstileResult.hostname.toLowerCase() !== requestHostname.toLowerCase()) {
    return jsonResponse({ ok: false, error: 'captcha_failed' }, 400);
  }

  const fields: [string, string][] = [
    ['Nombre', payload.name],
    ['Correo electrónico', payload.email || 'No proporcionado'],
    ['Nombre del negocio', payload.company || 'No proporcionado'],
    ['WhatsApp', payload.phone || 'No proporcionado'],
    ['Tipo de proyecto', PROJECT_TYPE_LABELS[payload.project_type]],
    ['Mensaje', payload.message],
  ];
  if (payload.package) fields.splice(5, 0, ['Paquete consultado', PACKAGE_LABELS[payload.package]]);
  if (payload.site_type) fields.splice(5, 0, ['Tipo de sitio', SITE_TYPE_LABELS[payload.site_type]]);
  const text = fields.map(([label, value]) => `${label}: ${value}`).join('\n\n');
  const html = fields
    .map(([label, value]) => `<p><strong>${label}:</strong><br>${escapeHtml(value)}</p>`)
    .join('');

  let resendResponse: Response;
  try {
    resendResponse = await fetch('https://api.resend.com/emails', {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${env.RESEND_API_KEY}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        from: env.RESEND_FROM,
        to: [env.CONTACT_TO?.trim() || DEFAULT_CONTACT_TO],
        ...(payload.email ? { reply_to: payload.email } : {}),
        subject: 'Nuevo mensaje desde el formulario de AcuarelaSoft',
        text,
        html,
      }),
    });
  } catch (error) {
    console.error('Resend request failed:', error);
    return jsonResponse({ ok: false, error: 'email_unavailable' }, 502);
  }

  if (!resendResponse.ok) {
    console.error('Resend returned HTTP', resendResponse.status);
    return jsonResponse({ ok: false, error: 'email_failed' }, 502);
  }

  return jsonResponse({ ok: true });
}
