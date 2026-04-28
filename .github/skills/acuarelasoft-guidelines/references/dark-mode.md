# Dark Mode

Adapted palette and rules for Acuarelasoft's dark theme. The watercolor aesthetic translates to dark mode as muted, pastel-toned washes over a cool slate surface — like painting on dark paper.

## Dark Palette

| Role | Light Value | Dark Value | Notes |
|---|---|---|---|
| Background | `#FBF8F3` (paper) | `#2D2D3A` (slate) | Cool-toned dark surface |
| Surface (elevated) | — | `#3A3A4A` | Cards, nav, modals |
| Surface (hover) | — | `#44445A` | Hovered cards, active states |
| Text primary | `#21333A` (ink) | `#E8E4DF` (warm ivory) | Inverted warmth |
| Text secondary | `#21333A` @ 60% | `#E8E4DF` @ 60% | Muted content |
| Principal blue | `#6FA8D8` | `#8FC0E8` | Lightened for contrast on dark bg |
| Salmon | `#F2B8B2` | `#F5CCC8` | Slightly lighter/desaturated |
| Mint | `#BFE7D6` | `#D4F0E4` | Slightly lighter |
| Petróleo (CTA) | `#2E6B78` | `#4FAFC0` | Significantly lighter for contrast |
| Petróleo (hover) | `#245A65` | `#3D9AAB` | Darker variant of dark-petróleo |
| Borders | `rgba(111,168,216,0.15)` | `rgba(143,192,232,0.12)` | Lighter blue, lower opacity |

## Tailwind Dark Theme Tokens

Add `dark:` variants alongside the light theme. Use the `class` dark mode strategy in Tailwind config.

```css
@theme {
  /* Dark mode colors */
  --color-dark-bg: #2D2D3A;
  --color-dark-surface: #3A3A4A;
  --color-dark-surface-hover: #44445A;
  --color-dark-text: #E8E4DF;
  --color-dark-acuarela: #8FC0E8;
  --color-dark-salmon: #F5CCC8;
  --color-dark-mint: #D4F0E4;
  --color-dark-petroleo: #4FAFC0;
  --color-dark-petroleo-hover: #3D9AAB;
}
```

**Usage in markup:**

```html
<body class="bg-paper dark:bg-dark-bg text-ink dark:text-dark-text">
  <div class="bg-paper dark:bg-dark-surface border-acuarela-400/15 dark:border-dark-acuarela/12">
    <button class="bg-petroleo dark:bg-dark-petroleo hover:bg-[#245A65] dark:hover:bg-dark-petroleo-hover">
      CTA
    </button>
  </div>
</body>
```

## Watercolor Effects in Dark Mode

Watercolor washes and textures require adjustments for dark backgrounds:

**Opacity reduction:**
- Wash gradients: reduce from 10–25% to **5–15%** opacity.
- Paper-grain noise: reduce from 3% to **1.5–2.5%** opacity.
- Blend modes: switch from `multiply` to **`screen`** or **`soft-light`** (multiply darkens further on dark backgrounds).

**Wash gradient adaptation:**

```css
/* Light mode */
.wash-hero {
  background:
    radial-gradient(ellipse 70% 50% at 15% 25%, rgba(111,168,216,0.20) 0%, transparent 70%),
    var(--color-paper);
}

/* Dark mode — lighter blue, lower opacity, screen blend */
.dark .wash-hero {
  background:
    radial-gradient(ellipse 70% 50% at 15% 25%, rgba(143,192,232,0.10) 0%, transparent 70%),
    var(--color-dark-bg);
}
```

**Paper-grain in dark mode:**

```css
.dark .paper-bg::after {
  opacity: 0.02;
  mix-blend-mode: soft-light;
}
```

**Blob shapes:**

```css
.dark .blob {
  background: radial-gradient(ellipse at 40% 40%, rgba(143,192,232,0.15), rgba(143,192,232,0.03));
}
```

## Component Adaptations

**Navigation:**

```css
.dark .nav {
  background: rgba(45, 45, 58, 0.85);
  backdrop-filter: blur(12px);
  border-bottom-color: rgba(143, 192, 232, 0.10);
}
```

**Cards:**
- Background: `dark:bg-dark-surface`
- Border: `dark:border-dark-acuarela/12`
- Hover: `dark:hover:bg-dark-surface-hover`

**Buttons:**
- Primary: `dark:bg-dark-petroleo dark:hover:bg-dark-petroleo-hover`
- Secondary border: `dark:border-dark-salmon`
- Ghost hover: `dark:hover:bg-dark-acuarela/10`

**Forms:**
- Input background: `dark:bg-dark-surface`
- Input border: `dark:border-dark-acuarela/20`
- Focus ring: `dark:focus:ring-dark-acuarela/15`
- Placeholder: `dark:placeholder:text-dark-text/25`

**Footer:**
- In dark mode the footer uses `dark:bg-acuarela-900` (same as light — it's already dark).
- Adjust link hover to `dark:hover:text-dark-acuarela`.

## Accessibility in Dark Mode

- Text `#E8E4DF` on background `#2D2D3A` yields a contrast ratio of ~10.2:1 (WCAG AAA).
- CTA `#4FAFC0` on `#2D2D3A` yields ~5.8:1 (WCAG AA for normal text).
- CTA `#4FAFC0` on `#3A3A4A` (surface) yields ~4.8:1 (WCAG AA for normal text).
- Salmon `#F5CCC8` on `#2D2D3A` yields ~8.5:1 — safe for decorative text but prefer `--color-dark-text` for body.
- Always test contrast when overlaying text on watercolor washes in dark mode — add `background: rgba(45,45,58,0.85)` backdrop if ratio drops below 4.5:1.

## Theme Toggle

The site should respect system preference by default and allow manual override:

```html
<html class="dark"><!-- Toggled via JS -->
```

Store the user's preference in `localStorage` and apply before page render to prevent flash:

```js
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
}
```
