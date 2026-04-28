---
name: acuarelasoft-guidelines
description: Applies Acuarelasoft official brand identity — watercolor aesthetic, palette, typography, and UI patterns — to any web artifact. Use when Acuarelasoft brand colors, watercolor style guidelines, visual formatting, or company design standards apply. Keywords: branding, watercolor, acuarela, visual identity, styling, brand colors, typography, UI components, web design, UX, software agency.
---

# Acuarelasoft Brand Styling

**Tagline**: *"El arte de crear software"*

Acuarelasoft is a software and technology agency focused on usability and user experience. The visual identity evokes **watercolor art** — soft washes, organic edges, and paper-like warmth — combined with clean modern typography for professional credibility.

## Brand Guidelines

### Colors (Light Mode)

**Core Palette:**

| Role | Name | Hex | Usage |
|---|---|---|---|
| Principal | Azul acuarela suave | `#6FA8D8` | Hero washes, section backgrounds at 10–25% opacity |
| Secundario 1 | Rosa salmón lavado | `#F2B8B2` | Illustrations, icons, decorative highlights |
| Secundario 2 | Verde menta claro | `#BFE7D6` | Illustrations, icons, success states |
| Acento | Azul petróleo | `#2E6B78` | CTAs, links, interactive elements (high contrast) |
| Neutro / Fondo | Marfil cálido | `#FBF8F3` | Page background — simulates watercolor paper |
| Texto principal | Tinta oscura | `#21333A` | Headings, body text, UI labels |

**Extended Palette (Tailwind theme):**

- `--color-acuarela-50`: `#F0F7FC` — Lightest blue tint
- `--color-acuarela-100`: `#DCEEF9` — Very light wash
- `--color-acuarela-200`: `#B9DCF2` — Light wash
- `--color-acuarela-300`: `#96CBE8` — Soft blue
- `--color-acuarela-400`: `#6FA8D8` — **Primary**
- `--color-acuarela-500`: `#5590C2` — Medium
- `--color-acuarela-600`: `#3F74A3` — Dark
- `--color-acuarela-700`: `#2E5A82` — Darker
- `--color-acuarela-800`: `#1F4163` — Very dark
- `--color-acuarela-900`: `#132A44` — Deepest

**Semantic Tokens:**

- `--color-salmon`: `#F2B8B2`
- `--color-mint`: `#BFE7D6`
- `--color-petroleo`: `#2E6B78`
- `--color-paper`: `#FBF8F3`
- `--color-ink`: `#21333A`

### Color Usage Rules

- **Background**: Use `--color-paper` (`#FBF8F3`) as the primary page background to simulate watercolor paper texture.
- **Hero / Large sections**: Apply the principal blue as soft radial gradients or wash overlays at **10–25% opacity**. Never use saturated flat color fills.
- **CTAs and links**: Use `--color-petroleo` (`#2E6B78`) for buttons, links, and interactive elements — provides strong contrast and accessibility.
- **Decorative accents**: Reserve salmon (`#F2B8B2`) and mint (`#BFE7D6`) for illustrations, icons, card borders, and visual highlights. Never use for body text.
- **Texture overlays**: Apply watercolor effects with CSS pseudo-elements using `mix-blend-mode: multiply` or `overlay` at **8–25% opacity**. See [watercolor-effects.md](references/watercolor-effects.md).
- **Accessibility**: Text `#21333A` on background `#FBF8F3` yields a contrast ratio of ~12.5:1 (WCAG AAA). Always verify minimum **4.5:1** ratio for normal text, **3:1** for large text. When placing text over watercolor washes, add a semi-transparent backdrop (`background: rgba(251,248,243,0.85)`) to maintain legibility.

### Typography

**Font Stack:**

| Role | Font | Weight | Fallback |
|---|---|---|---|
| Headings | Playfair Display | 600–700 | Georgia, serif |
| Body | Inter | 400 (emphasis: 500) | system-ui, sans-serif |
| Decorative/Accent | Pacifico | 400 | cursive |

**Font Loading** — Bunny Fonts (GDPR-friendly):

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=playfair-display:600,700|inter:400,500,600|pacifico:400" rel="stylesheet">
```

**Type Hierarchy:**

| Level | Size | Weight | Font | Line-height |
|---|---|---|---|---|
| H1 | 48–56px (3–3.5rem) | 700 | Playfair Display | 1.1 |
| H2 | 32–36px (2–2.25rem) | 700 | Playfair Display | 1.2 |
| H3 | 20–24px (1.25–1.5rem) | 600 | Playfair Display | 1.3 |
| Body | 16px (1rem) | 400 | Inter | 1.5 |
| Small / Caption | 14px (0.875rem) | 400 | Inter | 1.4 |
| Accent / Signature | 20–28px | 400 | Pacifico | 1.3 |

**Typography Rules:**

- **Pacifico** is strictly decorative: use only for taglines, signatures, short accent phrases, and decorative labels. **Never** use for buttons, navigation, form labels, or body paragraphs.
- Headings use Playfair Display with `color: var(--color-ink)`.
- Body text uses Inter with `color: var(--color-ink)`.
- Over watercolor washes, place text on a semi-transparent backdrop or ensure sufficient contrast before omitting it.
- Line-height for body: 1.5. Increase to 1.6 in content sections with background textures to prevent visual clutter.

### Visual Identity

**Aesthetic Direction:** Organic watercolor warmth meets clean modern usability. Every visual element should feel *hand-crafted* yet *professional* — like a designer's sketchbook brought to digital life.

**Borders and Shapes:**

- Use `border-radius: 8px` as default (range: 6–12px). Avoid sharp corners.
- **No hard box-shadows.** Instead, use soft, diffused borders or subtle color tints:
  ```css
  border: 1px solid rgba(111, 168, 216, 0.2);
  ```
- For elevation, prefer transparent color layering over `box-shadow`.

**Navigation:**

- Sticky header with **glassmorphism**: `backdrop-filter: blur(12px)` + semi-transparent paper background.
  ```css
  .nav {
    position: sticky;
    top: 0;
    background: rgba(251, 248, 243, 0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(111, 168, 216, 0.15);
  }
  ```

**Iconography:**

- Use **Lucide** icons (linear, rounded stroke endings).
- Icon stroke width: 1.5–2px. Color: `--color-petroleo` for interactive, `--color-ink` for informational.
- Avoid filled/solid icons — they conflict with the light, airy watercolor feel.

**Animations and Micro-interactions:**

- **Section entrance**: Fade-in with subtle blur dissolve (200–350ms, `ease-out`):
  ```css
  .reveal {
    opacity: 0;
    filter: blur(4px);
    transition: opacity 350ms ease-out, filter 350ms ease-out;
  }
  .reveal.visible {
    opacity: 1;
    filter: blur(0);
  }
  ```
- **Hover states**: Increase saturation slightly + gentle translate (`transform: translateY(-2px)`). Duration: 200ms.
- **CTAs on hover**: Darken petróleo to `#245A65` + subtle scale (`transform: scale(1.02)`).
- Avoid aggressive animations. Every transition should feel like *paint bleeding softly into paper*.

**Watercolor Textures:** For CSS/SVG techniques to create watercolor washes, paper-grain, brush-stroke separators, and organic edge effects, see [watercolor-effects.md](references/watercolor-effects.md).

### Brand Assets

- **Logo**: Not yet defined. When created, place in `public/assets/logo.svg` and `public/assets/logo.png`.
- **Favicon**: Not yet defined. Place in `public/assets/favicon.svg`.
- **App Icons**: Place in `public/assets/icons/icon-{size}.png` (72 to 512px).

### Tailwind Theme Configuration

Add this `@theme` block to your main CSS file:

```css
@theme {
  /* Colors — Acuarela blue scale */
  --color-acuarela-50: #F0F7FC;
  --color-acuarela-100: #DCEEF9;
  --color-acuarela-200: #B9DCF2;
  --color-acuarela-300: #96CBE8;
  --color-acuarela-400: #6FA8D8;
  --color-acuarela-500: #5590C2;
  --color-acuarela-600: #3F74A3;
  --color-acuarela-700: #2E5A82;
  --color-acuarela-800: #1F4163;
  --color-acuarela-900: #132A44;

  /* Colors — Semantic */
  --color-salmon: #F2B8B2;
  --color-mint: #BFE7D6;
  --color-petroleo: #2E6B78;
  --color-paper: #FBF8F3;
  --color-ink: #21333A;

  /* Typography */
  --font-heading: 'Playfair Display', Georgia, serif;
  --font-sans: 'Inter', system-ui, sans-serif;
  --font-accent: 'Pacifico', cursive;

  /* Border radius */
  --radius-soft: 8px;
  --radius-pill: 9999px;
}
```

Use Tailwind utilities: `bg-acuarela-400`, `text-petroleo`, `font-heading`, `rounded-soft`, etc.

### Bilingual Support

The site supports **Spanish and English**. No visual changes between languages — the same palette, typography, and layout rules apply. Ensure:

- Text containers accommodate varying string lengths (Spanish text tends to be ~15–20% longer than English).
- Use `lang="es"` or `lang="en"` on `<html>` for proper hyphenation and screen reader behavior.

## References

- **UI Component Patterns** — Buttons, cards, hero, nav, footer, forms, services, testimonials, pricing. Read [components.md](references/components.md) when building any UI component.
- **Watercolor CSS/SVG Effects** — Paper-grain textures, wash gradients, SVG displacement filters, brush-stroke separators. Read [watercolor-effects.md](references/watercolor-effects.md) when implementing visual textures or organic effects.
- **Dark Mode** — Adapted palette, surface colors, texture adjustments, and Tailwind `dark:` variants. Read [dark-mode.md](references/dark-mode.md) when implementing or configuring dark theme.
