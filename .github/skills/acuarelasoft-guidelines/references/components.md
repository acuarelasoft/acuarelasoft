# UI Component Patterns

Component patterns following the Acuarelasoft watercolor brand. Each component specifies palette, typography, and interaction rules. All examples use Tailwind CSS utilities with the Acuarelasoft `@theme` tokens.

## Table of Contents

- [Buttons](#buttons)
- [Cards](#cards)
- [Hero Sections](#hero-sections)
- [Navigation / Header](#navigation--header)
- [Footer](#footer)
- [Forms / Inputs](#forms--inputs)
- [Services Sections](#services-sections)
- [Testimonials](#testimonials)
- [Pricing](#pricing)

---

## Buttons

Three variants, all with organic border-radius and soft transitions.

**Primary** — Azul petróleo, high contrast for main CTAs:

```html
<button class="bg-petroleo text-paper font-sans font-medium
  px-6 py-3 rounded-soft
  transition-all duration-200 ease-out
  hover:bg-[#245A65] hover:scale-[1.02]
  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo">
  Comenzar proyecto
</button>
```

**Secondary** — Outlined with salmon accent:

```html
<button class="bg-transparent text-petroleo font-sans font-medium
  px-6 py-3 rounded-soft
  border border-salmon
  transition-all duration-200 ease-out
  hover:bg-salmon/10 hover:border-salmon/80
  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-salmon">
  Ver portafolio
</button>
```

**Ghost** — Minimal, text-only with hover reveal:

```html
<button class="bg-transparent text-petroleo font-sans font-medium
  px-4 py-2 rounded-soft
  transition-all duration-200 ease-out
  hover:bg-acuarela-400/10
  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-acuarela-400">
  Saber más →
</button>
```

**Rules:**
- Never use Pacifico on buttons — always Inter (`font-sans`).
- Minimum touch target: 44×44px.
- Hover darkens primary, tints secondary/ghost background.
- Use `rounded-soft` (8px) — not pill shape — for standard buttons. Pill (`rounded-pill`) is acceptable for tags/badges.

## Cards

Organic containers with soft borders and no hard shadows.

```html
<div class="bg-paper rounded-soft p-6
  border border-acuarela-400/15
  transition-all duration-250 ease-out
  hover:border-acuarela-400/30 hover:-translate-y-0.5">
  <h3 class="font-heading text-xl font-semibold text-ink mb-2">Título</h3>
  <p class="font-sans text-ink/80 text-base leading-relaxed">Contenido de la card...</p>
</div>
```

**Rules:**
- Background: `bg-paper` — cards sit on the paper background, not white.
- Border: use `border-acuarela-400/15` (translucent blue) — never solid gray borders.
- No `box-shadow`. Elevation is communicated through border opacity change and subtle translate on hover.
- Hover: increase border opacity + `translateY(-2px)` for gentle lift.
- For featured/highlighted cards, add a watercolor wash gradient background using the techniques in [watercolor-effects.md](watercolor-effects.md).

## Hero Sections

The hero is the primary watercolor showcase — layered wash gradients with bold Playfair typography.

```html
<section class="relative min-h-[70vh] flex items-center overflow-hidden">
  <!-- Watercolor wash background -->
  <div class="absolute inset-0 -z-10"
    style="background:
      radial-gradient(ellipse 70% 50% at 15% 25%, rgba(111,168,216,0.20) 0%, transparent 70%),
      radial-gradient(ellipse 50% 60% at 80% 60%, rgba(242,184,178,0.15) 0%, transparent 65%),
      radial-gradient(ellipse 40% 40% at 50% 85%, rgba(191,231,214,0.12) 0%, transparent 60%);">
  </div>

  <div class="max-w-4xl mx-auto px-6 text-center">
    <p class="font-accent text-acuarela-400 text-xl mb-4">El arte de crear software</p>
    <h1 class="font-heading text-ink text-5xl md:text-6xl font-bold leading-tight mb-6">
      Software que inspira experiencias
    </h1>
    <p class="font-sans text-ink/75 text-lg max-w-2xl mx-auto mb-8">
      Creamos soluciones digitales con la delicadeza de la acuarela y la solidez de la tecnología.
    </p>
    <div class="flex gap-4 justify-center">
      <button class="bg-petroleo text-paper font-sans font-medium px-8 py-3 rounded-soft
        transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02]">
        Iniciar proyecto
      </button>
      <button class="bg-transparent text-petroleo font-sans font-medium px-8 py-3 rounded-soft
        border border-salmon transition-all duration-200 hover:bg-salmon/10">
        Nuestro trabajo
      </button>
    </div>
  </div>
</section>
```

**Rules:**
- Tagline uses `font-accent` (Pacifico) — this is one of the few approved uses.
- H1: Playfair Display, bold, 48–56px. The hero heading is the visual anchor.
- Wash gradients: 2–4 layers, 10–25% opacity, asymmetric placement.
- Include at least one CTA in petróleo.
- Use `overflow-hidden` on the section to contain gradient bleed.
- Add paper-grain overlay (see [watercolor-effects.md](watercolor-effects.md)) for extra texture.

## Navigation / Header

Sticky, glassmorphism-style navigation with transparent paper background.

```html
<header class="sticky top-0 z-50
  bg-paper/85 backdrop-blur-[12px]
  border-b border-acuarela-400/15
  transition-colors duration-300">
  <nav class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
    <!-- Logo placeholder -->
    <a href="/" class="font-heading text-xl font-bold text-ink">
      Acuarelasoft
    </a>

    <!-- Navigation links -->
    <ul class="hidden md:flex gap-8 font-sans text-sm font-medium text-ink/70">
      <li><a href="#servicios" class="hover:text-petroleo transition-colors duration-200">Servicios</a></li>
      <li><a href="#portafolio" class="hover:text-petroleo transition-colors duration-200">Portafolio</a></li>
      <li><a href="#equipo" class="hover:text-petroleo transition-colors duration-200">Equipo</a></li>
      <li><a href="#contacto" class="hover:text-petroleo transition-colors duration-200">Contacto</a></li>
    </ul>

    <!-- CTA -->
    <a href="#contacto" class="bg-petroleo text-paper font-sans text-sm font-medium
      px-5 py-2.5 rounded-soft transition-all duration-200
      hover:bg-[#245A65] hover:scale-[1.02]">
      Hablemos
    </a>
  </nav>
</header>
```

**Rules:**
- `bg-paper/85` + `backdrop-blur-[12px]` creates the glassmorphism effect.
- Border bottom: translucent acuarela blue, never solid lines.
- Nav links: Inter, medium weight, muted ink color. Hover transitions to petróleo.
- Logo text: Playfair Display until a logo asset is available.
- Mobile: use a hamburger menu that opens as a slide-down panel with wash background (not a sidebar).
- The nav should feel like frosted watercolor paper.

## Footer

Grounded section with subtle wash background and the tagline in Pacifico.

```html
<footer class="relative bg-acuarela-900 text-paper/80 overflow-hidden">
  <!-- Subtle wash overlay -->
  <div class="absolute inset-0 -z-0"
    style="background: radial-gradient(ellipse 80% 60% at 50% 100%, rgba(111,168,216,0.08) 0%, transparent 70%);">
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 py-16">
    <div class="grid md:grid-cols-3 gap-12 mb-12">
      <div>
        <p class="font-heading text-paper text-xl font-bold mb-2">Acuarelasoft</p>
        <p class="font-accent text-acuarela-300 text-lg">El arte de crear software</p>
      </div>
      <div>
        <h4 class="font-sans text-paper font-semibold text-sm uppercase tracking-wider mb-4">Enlaces</h4>
        <ul class="font-sans text-sm space-y-2">
          <li><a href="#" class="hover:text-acuarela-300 transition-colors duration-200">Servicios</a></li>
          <li><a href="#" class="hover:text-acuarela-300 transition-colors duration-200">Portafolio</a></li>
          <li><a href="#" class="hover:text-acuarela-300 transition-colors duration-200">Contacto</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-sans text-paper font-semibold text-sm uppercase tracking-wider mb-4">Contacto</h4>
        <p class="font-sans text-sm">hola@acuarelasoft.com</p>
      </div>
    </div>

    <div class="border-t border-paper/10 pt-6 text-center">
      <p class="font-sans text-xs text-paper/50">&copy; 2026 Acuarelasoft. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>
```

**Rules:**
- Footer uses the darkest acuarela tone (`acuarela-900`) for contrast with the light page.
- Tagline in Pacifico — approved decorative usage.
- Links hover to `acuarela-300` (soft blue) for visibility on dark background.
- Include a very subtle wash radial gradient anchored to the bottom.
- Keep typography clean: Inter for all text except logo (Playfair) and tagline (Pacifico).

## Forms / Inputs

Soft, organic form elements with watercolor-inspired focus states.

```html
<div class="space-y-4">
  <div>
    <label class="block font-sans text-sm font-medium text-ink mb-1.5">Nombre</label>
    <input type="text"
      class="w-full px-4 py-3 rounded-soft
        bg-paper border border-acuarela-400/20
        font-sans text-ink text-base
        transition-all duration-200
        focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15
        placeholder:text-ink/30"
      placeholder="Tu nombre completo">
  </div>

  <div>
    <label class="block font-sans text-sm font-medium text-ink mb-1.5">Email</label>
    <input type="email"
      class="w-full px-4 py-3 rounded-soft
        bg-paper border border-acuarela-400/20
        font-sans text-ink text-base
        transition-all duration-200
        focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15
        placeholder:text-ink/30"
      placeholder="tu@email.com">
  </div>

  <div>
    <label class="block font-sans text-sm font-medium text-ink mb-1.5">Mensaje</label>
    <textarea rows="4"
      class="w-full px-4 py-3 rounded-soft
        bg-paper border border-acuarela-400/20
        font-sans text-ink text-base
        transition-all duration-200 resize-y
        focus:outline-none focus:border-acuarela-400/50 focus:ring-2 focus:ring-acuarela-400/15
        placeholder:text-ink/30"
      placeholder="Cuéntanos sobre tu proyecto..."></textarea>
  </div>
</div>
```

**Rules:**
- Labels: Inter, medium (500), ink color.
- Inputs: paper background, soft acuarela border at 20% opacity.
- Focus: border intensifies to 50% + subtle ring glow (`ring-acuarela-400/15`) — no harsh outlines.
- Placeholders: ink at 30% opacity.
- Use `rounded-soft` consistently. No sharp corners on any form element.
- Error states: swap border color to `border-salmon` and add error text in salmon.
- Never use Pacifico on form elements.

## Services Sections

Grid layout showcasing services with cards, Lucide icons, and Playfair headings.

```html
<section class="py-20 px-6">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h2 class="font-heading text-ink text-3xl md:text-4xl font-bold mb-4">Nuestros Servicios</h2>
      <p class="font-sans text-ink/60 text-lg max-w-xl mx-auto">
        Soluciones digitales diseñadas con atención al detalle
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
      <!-- Service card -->
      <div class="bg-paper rounded-soft p-8
        border border-acuarela-400/15
        transition-all duration-250
        hover:border-acuarela-400/30 hover:-translate-y-0.5">
        <!-- Lucide icon (linear, 1.5-2px stroke) -->
        <div class="w-12 h-12 mb-5 text-petroleo">
          <!-- Insert Lucide icon SVG here -->
        </div>
        <h3 class="font-heading text-ink text-xl font-semibold mb-3">Desarrollo Web</h3>
        <p class="font-sans text-ink/70 text-base leading-relaxed">
          Sitios web y aplicaciones con enfoque en usabilidad y experiencia de usuario.
        </p>
      </div>
      <!-- Repeat for each service -->
    </div>
  </div>
</section>
```

**Rules:**
- Section heading: Playfair Display, centered, with a muted subtitle in Inter.
- Cards follow the standard card pattern (see [Cards](#cards)).
- Icons: Lucide, petróleo color, 1.5–2px stroke, 48×48px container.
- Grid: 3 columns on desktop, 1 on mobile. Gap of 32px.
- Optionally add a subtle watercolor wash background behind the entire section.

## Testimonials

Quote cards with decorative Pacifico quotation marks and salmon accents.

```html
<div class="bg-paper rounded-soft p-8 border border-salmon/20
  transition-all duration-250
  hover:border-salmon/35">
  <!-- Decorative quote mark -->
  <span class="font-accent text-salmon/40 text-5xl leading-none block mb-2" aria-hidden="true">"</span>

  <blockquote class="font-sans text-ink/80 text-base leading-relaxed mb-6">
    Acuarelasoft transformó nuestra visión en una experiencia digital que nuestros usuarios aman.
    El proceso fue transparente y el resultado superó nuestras expectativas.
  </blockquote>

  <div class="flex items-center gap-3">
    <div class="w-10 h-10 rounded-full bg-acuarela-400/15 flex items-center justify-center">
      <span class="font-sans text-petroleo font-semibold text-sm">MR</span>
    </div>
    <div>
      <p class="font-sans text-ink font-medium text-sm">María Rodríguez</p>
      <p class="font-sans text-ink/50 text-xs">CEO, TechVida</p>
    </div>
  </div>
</div>
```

**Rules:**
- Opening quote mark: Pacifico, salmon at 40% opacity — purely decorative (`aria-hidden`).
- Quote text: Inter, regular weight, muted ink.
- Border: salmon at 20% opacity — differentiates from standard cards.
- Avatar placeholder: acuarela circle with initials in petróleo. Replace with actual image when available.
- Use a carousel or grid layout (2 columns) for multiple testimonials.

## Pricing

Tiered pricing cards with differentiated wash headers.

```html
<div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
  <!-- Standard tier -->
  <div class="bg-paper rounded-soft border border-acuarela-400/15 overflow-hidden
    transition-all duration-250 hover:border-acuarela-400/30">
    <div class="p-6" style="background: radial-gradient(ellipse at 50% 0%, rgba(191,231,214,0.25) 0%, transparent 80%);">
      <h3 class="font-heading text-ink text-xl font-semibold">Esencial</h3>
      <p class="font-sans text-ink/50 text-sm mt-1">Para proyectos iniciales</p>
    </div>
    <div class="p-6">
      <p class="font-heading text-ink text-4xl font-bold mb-1">$2,500 <span class="text-lg font-normal text-ink/50">USD</span></p>
      <ul class="font-sans text-ink/70 text-sm space-y-3 mt-6 mb-8">
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Landing page responsiva
        </li>
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Diseño UI/UX personalizado
        </li>
      </ul>
      <button class="w-full bg-transparent text-petroleo font-sans font-medium py-3 rounded-soft
        border border-petroleo/30 transition-all duration-200 hover:bg-petroleo hover:text-paper">
        Seleccionar
      </button>
    </div>
  </div>

  <!-- Featured tier -->
  <div class="bg-paper rounded-soft border-2 border-petroleo overflow-hidden
    transition-all duration-250 hover:-translate-y-1 scale-[1.02]">
    <div class="p-6 bg-petroleo text-paper">
      <div class="flex items-center justify-between">
        <h3 class="font-heading text-xl font-semibold">Profesional</h3>
        <span class="font-sans text-xs font-medium bg-paper/20 px-2 py-1 rounded-soft">Popular</span>
      </div>
      <p class="font-sans text-paper/70 text-sm mt-1">Para empresas en crecimiento</p>
    </div>
    <div class="p-6">
      <p class="font-heading text-ink text-4xl font-bold mb-1">$6,000 <span class="text-lg font-normal text-ink/50">USD</span></p>
      <ul class="font-sans text-ink/70 text-sm space-y-3 mt-6 mb-8">
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Aplicación web completa
        </li>
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Sistema de diseño personalizado
        </li>
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> 3 meses de soporte
        </li>
      </ul>
      <button class="w-full bg-petroleo text-paper font-sans font-medium py-3 rounded-soft
        transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02]">
        Seleccionar
      </button>
    </div>
  </div>

  <!-- Enterprise tier -->
  <div class="bg-paper rounded-soft border border-acuarela-400/15 overflow-hidden
    transition-all duration-250 hover:border-acuarela-400/30">
    <div class="p-6" style="background: radial-gradient(ellipse at 50% 0%, rgba(111,168,216,0.20) 0%, transparent 80%);">
      <h3 class="font-heading text-ink text-xl font-semibold">Enterprise</h3>
      <p class="font-sans text-ink/50 text-sm mt-1">Para grandes organizaciones</p>
    </div>
    <div class="p-6">
      <p class="font-heading text-ink text-4xl font-bold mb-1">Custom</p>
      <ul class="font-sans text-ink/70 text-sm space-y-3 mt-6 mb-8">
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Solución a medida
        </li>
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Equipo dedicado
        </li>
        <li class="flex items-center gap-2">
          <span class="text-mint">✓</span> Soporte prioritario 24/7
        </li>
      </ul>
      <button class="w-full bg-transparent text-petroleo font-sans font-medium py-3 rounded-soft
        border border-petroleo/30 transition-all duration-200 hover:bg-petroleo hover:text-paper">
        Contactar
      </button>
    </div>
  </div>
</div>
```

**Rules:**
- Each tier has a distinct wash-color header: mint (Esencial), petróleo solid (Profesional/featured), blue (Enterprise).
- Featured tier: `scale-[1.02]` + solid petróleo header + thicker border to stand out.
- Prices: Playfair Display, bold. Currency unit is smaller and muted.
- Check marks: mint color for positive visual feedback.
- CTA: featured tier uses filled petróleo button, others use outline.
- Grid: 3 columns on desktop, stacked on mobile. Featured card can span wider or elevate.
