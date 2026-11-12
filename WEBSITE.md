# Astro Starter Kit: Basics

```sh
npm create astro@latest -- --template basics
```

> 🧑‍🚀 **Seasoned astronaut?** Delete this file. Have fun!

## 🚀 Project Structure

Inside of your Astro project, you'll see the following folders and files:

```text
/
├── public/
│   └── favicon.svg
├── src
│   ├── assets
│   │   └── astro.svg
│   ├── components
│   │   └── Welcome.astro
│   ├── layouts
│   │   └── Layout.astro
│   └── pages
│       └── index.astro
└── package.json
```

To learn more about the folder structure of an Astro project, refer to [our guide on project structure](https://docs.astro.build/en/basics/project-structure/).

## 🧞 Commands

All commands are run from the root of the project, from a terminal:

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |
| `npm run astro ...`       | Run CLI commands like `astro add`, `astro check` |
| `npm run astro -- --help` | Get help using the Astro CLI                     |

## Editar costos de servicios

Los costos publicados se configuran en [src/data/pricing.ts](src/data/pricing.ts):

- `pricing.currency`: código de moneda.
- `pricing.webDesign.startingPrice`: precio base del sitio web.
- `pricing.webDesign.includedHostingMonths`: meses de hosting incluidos en el precio base.
- `pricing.webDesign.hostingMonthly`: mensualidad de hosting administrado al terminar ese periodo.
- `pricing.photography.establishmentSessionPrice`: precio base de una sesión de establecimiento; otras sesiones se cotizan según su alcance.
- `pricing.extras`: extras publicados (fotografía, sección y página adicionales).
- `pricing.packages`: paquetes que se muestran en las tarjetas de precios.
- `pricing.wordpressCare`: precio y alcance de Cuidado WordPress.

Edita los importes como números sin separadores de miles. `formatPrice` aplica
el formato compartido a páginas, preguntas frecuentes y metadatos; los datos
estructurados SEO usan la misma configuración. El formato visible conserva el
símbolo `$` seguido del importe y el código de moneda.

Después de editar, ejecuta `npm run build` y despliega nuevamente para publicar
los cambios. Dominio, correo corporativo, renovaciones, mantenimiento y otros extras sin
tarifa publicada siguen sujetos a cotización independiente.

## Páginas independientes de servicios

La página intermedia `/servicios/` ([index.astro](src/pages/servicios/index.astro))
reúne todos los servicios y forma el segundo nivel de la ruta de navegación:
`Inicio / Servicios / <servicio>`. El esquema `BreadcrumbList` de cada página de
servicio se genera con `serviceBreadcrumb()` de [services.ts](src/data/services.ts).

Cada servicio tiene una URL pública y un archivo Astro propio:

| Servicio | URL | Archivo |
| --- | --- | --- |
| Sitios web | `/diseno-paginas-web-mexico/` | [index.astro](src/pages/diseno-paginas-web-mexico/index.astro) |
| Tiendas en línea | `/servicios/tiendas-en-linea/` | [tiendas-en-linea.astro](src/pages/servicios/tiendas-en-linea.astro) |
| Fotografía comercial | `/servicios/fotografia-comercial/` | [fotografia-comercial.astro](src/pages/servicios/fotografia-comercial.astro) |
| SEO y analítica | `/servicios/seo-analitica/` | [seo-analitica.astro](src/pages/servicios/seo-analitica.astro) |
| Contenido y campañas | `/servicios/contenido-campanas/` | [contenido-campanas.astro](src/pages/servicios/contenido-campanas.astro) |
| Mantenimiento WordPress | `/servicios/mantenimiento-wordpress/` | [mantenimiento-wordpress.astro](src/pages/servicios/mantenimiento-wordpress.astro) |

Edita el contenido, la estructura, los metadatos y el bloque `<style>` del
archivo de cada servicio. Los estilos de las nuevas páginas son locales; no
hay una plantilla universal ni una ruta dinámica que imponga el mismo formato.
Todas reutilizan [Layout.astro](src/layouts/Layout.astro) para los elementos
comunes del sitio y los tokens de identidad visual.

Las URLs de navegación se registran en `serviceOptions` en
[services.ts](src/data/services.ts); las tarjetas de inicio, el pie y ambos
mapas del sitio utilizan ese registro. Conserva los valores `value`, pues
identifican el servicio en contacto y en los paquetes. Las páginas de sitios
web, tiendas y fotografía integran el formulario de cotización con su servicio
identificado. Los enlaces a `/contacto/?service=<value>#contacto` siguen siendo
compatibles y preseleccionan el servicio en el formulario general.

Los importes y condiciones de fotografía y mantenimiento proceden de
[pricing.ts](src/data/pricing.ts). Sitios web conserva su URL original,
`/diseno-paginas-web-mexico/`.

Ejecuta `npm run build` después de editar y revisa las páginas en móvil y
escritorio, sus enlaces de cotización y el sitemap antes de desplegar.

## Tipografía y navegación

Las fuentes compartidas se cargan desde Bunny Fonts en
[Layout.astro](src/layouts/Layout.astro) y se configuran en
[global.css](src/styles/global.css): Instrument Serif para títulos (peso 400,
normal y cursiva) y DM Sans para texto y controles. La clase `font-heading`
evita negritas sintéticas. El logotipo utiliza las imágenes oficiales, sin
reconstruir el nombre con fuentes adicionales.

La escala de tamaños y alturas de línea se comparte mediante los tokens de
Tailwind en [global.css](src/styles/global.css). Con el tamaño predeterminado
del navegador, el texto base es de 18 px y el texto secundario usa al menos
16 px. Los tamaños se expresan en `rem` para respetar la configuración del
navegador.

## Identidad visual

Los logos oficiales están en [public/logos/](public/logos/) y los iconos en
[public/iconos/](public/iconos/).
[BrandLogo.astro](src/components/BrandLogo.astro) comparte la marca de cabecera
(200 px) y pie (hasta 240 px), con variantes WebP y alternativa PNG para
distintas densidades de pantalla. Conserva la proporción y transparencia de los
archivos originales.

La paleta se configura en [global.css](src/styles/global.css): escala azul
`acuarela`, azul marino `ink`, turquesa oscuro `petroleo` para acciones y su
variante `petroleo-dark` para hover, y acentos `mint` y `salmon`. Para texto
coral se utiliza `coral-ink`, más oscuro para mantener el contraste.
Los degradados y estados interactivos reutilizan estos tokens.

La imagen de bocetos de la página de sitios web
([diseno-web-acuarela.webp](public/assets/solutions/diseno-web-acuarela.webp))
es una versión optimizada de la [fotografía de Hal Gatewood](https://unsplash.com/photos/watercolor-wireframe-sketches-of-website-layouts-tZc3vjPCk-Q),
publicada bajo la [licencia de Unsplash](https://unsplash.com/license), que permite
su uso comercial.

La ilustración original de fotografía comercial
([fotografia-comercial.svg](public/assets/solutions/fotografia-comercial.svg))
se usa en la página del servicio y en sus tarjetas; es una gráfica decorativa,
no una muestra de trabajos fotográficos.

[Layout.astro](src/layouts/Layout.astro) referencia los favicon ICO/PNG y el
icono Apple de 180 px de la nueva carpeta, y usa el logo PNG de 600 px como
imagen predeterminada al compartir enlaces. Se puede personalizar por página
con `ogImage` y `ogImageAlt`. El mismo logo identifica a la organización en los
datos estructurados de inicio. Los recursos antiguos de la raíz se conservan
por compatibilidad, pero el sitio ya no los referencia.

## Navegación

Los enlaces y el comportamiento del menú están en
[Header.astro](src/components/Header.astro); sus textos proceden de
[landing.ts](src/data/landing.ts). La navegación completa aparece desde 1280 px;
en pantallas menores se usa un desplegable (el botón «Cuéntanos tu proyecto»
sigue visible en la barra desde 640 px) con cierre mediante Escape,
selección de enlace o clic fuera. El menú se reinicia al navegar con ClientRouter.

El pie, definido en [Footer.astro](src/components/Footer.astro), enlaza al
[mapa del sitio](src/pages/mapa-sitio/index.astro) en «Compañía». Las solicitudes
GET y HEAD a rutas sin página o archivo existente devuelven 404.

## 👀 Want to learn more?

Feel free to check [our documentation](https://docs.astro.build) or jump into our [Discord server](https://astro.build/chat).
