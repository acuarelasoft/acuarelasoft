# Despliegue en Cloudflare Workers y formulario de contacto

El sitio se genera como contenido estático con Astro. Cloudflare Workers sirve `dist/` como assets estáticos; `worker.ts` envía `POST /api/contact` al manejador de `functions/api/contact.ts`. En el flujo nuevo de Workers, esa carpeta no se detecta automáticamente como Pages Function.

La opción `assets.not_found_handling: "404-page"` en `wrangler.jsonc` sirve la página `404.html` generada por Astro con estado HTTP 404 para las rutas inexistentes, sin redirigir al inicio.

Para conectar el proyecto con GitHub y configurar los despliegues automáticos, consulta la [guía de Workers Builds](./CLOUDFLARE_PAGES_GIT_SETUP.md).

## 1. Crear el Worker

1. En Cloudflare, abre **Workers & Pages → Create application → Continue with GitHub** y conecta el repositorio.
2. Configura el directorio raíz como `/`, el comando de build como `npm run build`, el comando de deploy como `npx wrangler deploy` y el comando de preview como `npx wrangler preview`.
3. El nombre del Worker debe coincidir con `name` en `wrangler.jsonc`. La configuración de ese archivo apunta a `worker.ts` y publica `dist/`.
4. Instala Wrangler como dependencia de desarrollo con `npm install --save-dev wrangler` y confirma los cambios de `package.json` y `package-lock.json` en el repositorio.
5. Selecciona `main` como rama de producción. Para usar el dominio propio, asígnalo al Worker después del primer despliegue.

## 2. Configurar Turnstile

1. Usa el widget existente con sitekey `0x4AAAAAADGwTkvfIOO4j6s1`. Sus hostnames permitidos deben incluir los que sirven el formulario, como `acuarelasoft.com`; agrega `localhost` y `127.0.0.1` solo si también probarás el widget localmente.
2. El formulario envía la acción `contact` y el manejador `POST /api/contact` verifica esa acción mediante Siteverify antes de procesar el mensaje.
3. Configura la sitekey como variable de build `PUBLIC_TURNSTILE_SITEKEY` si deseas reemplazar el valor predeterminado del proyecto.
4. Configura la secret key del mismo widget como el binding secreto `TURNSTILE_SECRET_KEY`. No la pongas en `PUBLIC_*`, `.env.example`, el frontend ni el repositorio.

El Worker compara el hostname devuelto por Siteverify con el hostname del `Origin`, y solo acepta orígenes enumerados en `CONTACT_ALLOWED_ORIGINS`. En producción, mantén esa variable limitada a los orígenes de producción; no agregues `localhost` ni `127.0.0.1`. Si se habilitan previews, agrega los hostnames al widget y configura únicamente los orígenes de preview correspondientes en el entorno Preview.

## 3. Configurar Resend y variables del Worker

Verifica en Resend el dominio remitente que vas a usar y crea una API key con permiso para enviar correo. En **Workers & Pages → tu Worker → Settings → Variables and Secrets**, configura las variables de runtime para **Production**. Configura valores de prueba separados en **Preview settings** si usarás previews:

| Nombre | Tipo | Valor |
| --- | --- | --- |
| `PUBLIC_TURNSTILE_SITEKEY` | Variable de build | Sitekey pública opcional; si se omite, el proyecto usa la sitekey del widget existente. |
| `RESEND_API_KEY` | Secret | API key de Resend. |
| `RESEND_FROM` | Variable | Remitente verificado en Resend, por ejemplo `AcuarelaSoft <contacto@acuarelasoft.com>`. |
| `TURNSTILE_SECRET_KEY` | Secret | Secret key del widget de Turnstile del mismo entorno. |
| `CONTACT_ALLOWED_ORIGINS` | Variable | Orígenes exactos separados por coma, sin rutas ni `/` final; por ejemplo `https://acuarelasoft.com`. |
| `CONTACT_TO` | Variable opcional | Destinatario de los mensajes. Si se omite, se usa `contacto@acuarelasoft.com`. |

Configura `PUBLIC_TURNSTILE_SITEKEY` en las variables de build de Workers Builds, no como variable de runtime. La sitekey queda incorporada al HTML durante el build; vuelve a desplegar después de cambiarla. Los secrets de Resend y Turnstile se leen desde el Worker en tiempo de ejecución. No uses una API key de Resend como remitente: `RESEND_FROM` debe ser una dirección o identidad de un dominio verificado.

Para un dominio con y sin `www`, agrega ambos orígenes explícitamente si los dos sirven el sitio, por ejemplo `https://acuarelasoft.com,https://www.acuarelasoft.com`. La Function compara el encabezado `Origin` con esta lista.

## 4. Desarrollar y probar localmente

1. Copia `.env.example` como `.env` y coloca una sitekey de prueba de Turnstile en `PUBLIC_TURNSTILE_SITEKEY`.
2. Crea `.dev.vars` en la raíz del proyecto para que Wrangler pase los valores a la Function (este archivo está excluido de Git):

   ```dotenv
   RESEND_API_KEY=tu_api_key_de_resend
   RESEND_FROM="AcuarelaSoft <remitente@tu-dominio-verificado.com>"
   CONTACT_TO=tu-correo-de-prueba@example.com
   TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA
   CONTACT_ALLOWED_ORIGINS=http://localhost:8788
   ```

   La secret key de prueba indicada corresponde a la sitekey de prueba `1x00000000000000000000AA`; ambas siempre pasan la verificación. No configures la key de prueba en producción. Con las secret keys de prueba, Cloudflare responde `hostname: "example.com"`; la función omite la comparación de hostname solo en ese caso (secret de prueba y `metadata.result_with_testing_key`).
3. Genera el sitio y sírvelo junto con el Worker local:

   ```sh
   npm run build
   npx wrangler dev --port 8788
   ```

4. Abre `http://localhost:8788/contacto/` y envía un mensaje. La llamada debe ir a `http://localhost:8788/api/contact`; revisa la respuesta y los logs de Wrangler si hay un error.

El servidor `npm run dev` de Astro por sí solo no ejecuta el Worker; usa Wrangler para probar el endpoint. En local se envía correo real si `RESEND_API_KEY` y `RESEND_FROM` son credenciales reales, así que se recomienda usar `CONTACT_TO` con una dirección de prueba.

## 5. Desplegar y comprobar

Haz push a la rama `main` conectada; Workers Builds compilará y desplegará el Worker. En producción, verifica:

- La página carga y muestra el widget Turnstile.
- `POST https://acuarelasoft.com/api/contact` responde JSON y envía el correo al destinatario configurado.
- Un token Turnstile inválido o un origen no permitido no envía correo.
- Los logs del Worker no exponen los valores secretos.

## Manejador del formulario

El archivo [`functions/api/contact.ts`](./functions/api/contact.ts) valida y procesa los envíos. [`worker.ts`](./worker.ts) lo invoca para `POST /api/contact` y dirige las demás solicitudes al binding de assets estáticos. No copies el manejador a otra ruta ni lo muevas dentro de `dist/`.

```ts
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
  availability: string;
  message: string;
  website: string;
  'cf-turnstile-response': string;
}

const MAX_BODY_BYTES = 16_384;
const PROJECT_TYPES = new Set(['new', 'modernization', 'consulting', 'other']);
const AVAILABILITIES = new Set(['', 'morning', 'afternoon', 'evening', 'flexible']);
const DEFAULT_CONTACT_TO = 'contacto@acuarelasoft.com';

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
  const availability = readString(body.availability);
  const message = readString(body.message);
  const website = readString(body.website);
  const turnstileToken = readString(body['cf-turnstile-response']);

  if (
    name === null ||
    email === null ||
    company === null ||
    phone === null ||
    projectType === null ||
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
    !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) ||
    company.length > 255 ||
    phone.length > 50 ||
    !PROJECT_TYPES.has(projectType) ||
    !AVAILABILITIES.has(availability) ||
    message.length === 0 ||
    message.length > 500 ||
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
    !('hostname' in turnstileResult) ||
    turnstileResult.success !== true ||
    typeof turnstileResult.hostname !== 'string' ||
    turnstileResult.hostname.toLowerCase() !== requestHostname.toLowerCase()
  ) {
    return jsonResponse({ ok: false, error: 'captcha_failed' }, 400);
  }

  const fields = [
    ['Nombre', payload.name],
    ['Email', payload.email],
    ['Empresa', payload.company || 'No especificada'],
    ['Teléfono', payload.phone || 'No especificado'],
    ['Tipo de proyecto', payload.project_type],
    ['Disponibilidad', payload.availability || 'Flexible'],
    ['Mensaje', payload.message],
  ] as const;
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
        reply_to: payload.email,
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
```
