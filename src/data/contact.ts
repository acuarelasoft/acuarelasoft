// El endpoint es una Pages Function del mismo dominio.
// Las variables PUBLIC_* se incrustan en el build (import.meta.env).

export const contactConfig = {
  endpointUrl: '/api/contact',
  turnstileSiteKey: import.meta.env.PUBLIC_TURNSTILE_SITEKEY || '0x4AAAAAADGwTkvfIOO4j6s1',
};
