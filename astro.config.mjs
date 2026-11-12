// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

// https://astro.build/config
// Sitio estático para Cloudflare Pages; las Pages Functions viven en /functions.
export default defineConfig({
  site: 'https://acuarelasoft.com',
  trailingSlash: 'always',
  vite: {
    plugins: [tailwindcss()]
  },
});
