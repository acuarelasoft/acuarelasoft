# Tutorial: conectar GitHub con Cloudflare Workers

Esta guía configura **Workers Builds** para construir y desplegar el sitio automáticamente cuando haya cambios en la rama `main`. Workers es el flujo recomendado actualmente por Cloudflare para proyectos nuevos. Aunque el nombre histórico del archivo menciona Pages, este tutorial configura un Worker con assets estáticos de Astro y una ruta para el formulario de contacto.

## Requisitos

- El proyecto debe estar en un repositorio de GitHub al que tengas acceso para autorizar la aplicación de Cloudflare.
- Debes tener una cuenta de Cloudflare.
- Este proyecto requiere Node.js `22.12.0` o posterior, según `package.json`.
- Antes de conectar el repositorio, instala Wrangler como dependencia de desarrollo y confirma los archivos de manifiesto actualizados:

  ```sh
  npm install --save-dev wrangler
  ```

- Los archivos `worker.ts` y `wrangler.jsonc` de este repositorio configuran el Worker y sus assets. No los elimines ni los muevas sin actualizar la configuración.

Workers Builds conecta GitHub y despliega el Worker en cada push. No hace falta crear un workflow de GitHub Actions.

## 1. Crear un Worker conectado a GitHub

1. Inicia sesión en el [panel de Cloudflare](https://dash.cloudflare.com/).
2. Abre **Workers & Pages** y selecciona **Create application** → **Continue with GitHub**.
3. Si se solicita, autoriza o instala la aplicación **Cloudflare Workers & Pages** en GitHub.
4. Selecciona el repositorio que contiene este proyecto. Si no aparece, revisa los permisos de la aplicación en GitHub y concede acceso a ese repositorio.
5. Configura los siguientes valores:

   | Campo | Valor |
   | --- | --- |
   | Nombre del Worker | `acuarelasoft` (debe coincidir con `name` en `wrangler.jsonc`) |
   | Rama de producción | `main` |
   | Directorio raíz | `/` (raíz del repositorio) |
   | Comando de build | `npm run build` |
   | Comando de deploy | `npx wrangler deploy` |
   | Comando de preview | `npx wrangler preview` |

   El comando de build genera el sitio en `dist/`. Wrangler lee `wrangler.jsonc`, que especifica tanto esa carpeta como el Worker que atiende el formulario. El comando de preview puede dejarse con su valor predeterminado si el panel ya muestra `npx wrangler preview`.

6. Guarda y despliega. Cloudflare creará el Worker y mostrará una URL `workers.dev`.

Cloudflare documenta este proceso en [Workers Builds](https://developers.cloudflare.com/workers/ci-cd/builds/) y su [integración con GitHub](https://developers.cloudflare.com/workers/ci-cd/builds/git-integration/github-integration/).

## 2. Configurar variables de build y del Worker

En el Worker, abre **Settings** → **Build** y agrega estas variables de build:

| Nombre | Valor | Uso |
| --- | --- | --- |
| `NODE_VERSION` | `22.12.0` | Versión de Node.js para compilar el proyecto. |
| `PUBLIC_TURNSTILE_SITEKEY` | Sitekey pública de Turnstile | Se incorpora al sitio durante el build. |

En **Settings** → **Variables and Secrets**, configura las siguientes variables y secretos de tiempo de ejecución para **Production**:

| Nombre | Tipo | Uso |
| --- | --- | --- |
| `RESEND_API_KEY` | Secreto | API key de Resend. |
| `RESEND_FROM` | Variable | Remitente verificado en Resend, por ejemplo `AcuarelaSoft <contacto@acuarelasoft.com>`. |
| `TURNSTILE_SECRET_KEY` | Secreto | Clave secreta del widget Turnstile. |
| `CONTACT_ALLOWED_ORIGINS` | Variable | Origen u orígenes autorizados, separados por comas y sin ruta ni `/` final. |
| `CONTACT_TO` | Variable opcional | Destinatario del formulario; si se omite, se usa `contacto@acuarelasoft.com`. |

Por ejemplo, cuando el dominio propio ya esté configurado:

```text
CONTACT_ALLOWED_ORIGINS=https://acuarelasoft.com
```

Si también se servirá el sitio desde `www`, incluye ambos orígenes:

```text
CONTACT_ALLOWED_ORIGINS=https://acuarelasoft.com,https://www.acuarelasoft.com
```

No incluyas claves secretas en el repositorio ni en variables con prefijo `PUBLIC_`. Las previews de Workers tienen su propia configuración y no heredan automáticamente las variables, secretos ni bindings de producción; configúrales los valores y hostnames de prueba en **Preview settings** si vas a probar el formulario desde ramas.

## 3. Desplegar cambios y probar

1. Revisa que el primer despliegue termine correctamente en **Deployments**.
2. Abre la URL `workers.dev` y verifica que cargue el sitio.
3. Envía un formulario de contacto de prueba y confirma que llegue el correo.
4. Haz commit y push a `main` para publicar cambios en producción. Cloudflare ejecutará `npm run build` y después `npx wrangler deploy`.
5. Los cambios en otras ramas usan el comando de preview y crean una Preview para probar antes de integrar a `main`.
6. Si falla un build, abre el registro de **Builds** del Worker para ver el error.

## 4. Conectar el dominio propio

Después del primer despliegue:

1. En el Worker, abre **Settings** → **Domains & Routes** y agrega `acuarelasoft.com` como dominio personalizado.
2. Sigue las instrucciones de Cloudflare para configurar o verificar el DNS.
3. Si también usarás `www.acuarelasoft.com`, agrégalo como otro dominio y asegúrate de incluir su origen en `CONTACT_ALLOWED_ORIGINS`.

Consulta la documentación de [dominios personalizados para Workers](https://developers.cloudflare.com/workers/configuration/routing/custom-domains/).

## 5. Documentación oficial

- [Workers Builds](https://developers.cloudflare.com/workers/ci-cd/builds/)
- [Configuración de Workers Builds](https://developers.cloudflare.com/workers/ci-cd/builds/configuration/)
- [Integración de GitHub](https://developers.cloudflare.com/workers/ci-cd/builds/git-integration/github-integration/)
- [Assets estáticos de Workers](https://developers.cloudflare.com/workers/static-assets/binding/)
- [Variables de entorno de Workers](https://developers.cloudflare.com/workers/configuration/environment-variables/)
- [Previews de Workers](https://developers.cloudflare.com/workers/previews/)
- [Dominios personalizados para Workers](https://developers.cloudflare.com/workers/configuration/routing/custom-domains/)
