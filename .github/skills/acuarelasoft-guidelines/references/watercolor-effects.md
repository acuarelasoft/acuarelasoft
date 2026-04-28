# Watercolor CSS/SVG Effects

Techniques for creating watercolor visual effects using only CSS and inline SVG — no external PNG textures required.

## Table of Contents

- [Paper-Grain Background](#paper-grain-background)
- [Watercolor Wash Gradients](#watercolor-wash-gradients)
- [SVG Displacement Filter (Organic Edges)](#svg-displacement-filter)
- [Brush-Stroke Section Separators](#brush-stroke-section-separators)
- [Watercolor Overlay with Pseudo-elements](#watercolor-overlay)
- [Noise Texture with SVG](#noise-texture)
- [Watercolor Blob Shapes](#watercolor-blob-shapes)

---

## Paper-Grain Background

Simulates the texture of watercolor paper using an SVG noise filter at very low opacity.

```css
.paper-bg {
  background-color: var(--color-paper);
  position: relative;
}

.paper-bg::after {
  content: '';
  position: absolute;
  inset: 0;
  opacity: 0.03;
  pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='grain'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23grain)'/%3E%3C/svg%3E");
  background-repeat: repeat;
}
```

Adjust `opacity: 0.03` (range 0.02–0.04) for subtlety. In dark mode, reduce to `0.015–0.025`.

## Watercolor Wash Gradients

Multi-layer radial gradients that simulate soft watercolor washes. Use on hero sections and large background areas.

**Single-color wash (principal blue):**

```css
.wash-blue {
  background:
    radial-gradient(ellipse 80% 60% at 20% 30%, rgba(111, 168, 216, 0.18) 0%, transparent 70%),
    radial-gradient(ellipse 60% 80% at 75% 70%, rgba(111, 168, 216, 0.12) 0%, transparent 65%),
    var(--color-paper);
}
```

**Multi-color wash (hero section):**

```css
.wash-hero {
  background:
    radial-gradient(ellipse 70% 50% at 15% 25%, rgba(111, 168, 216, 0.20) 0%, transparent 70%),
    radial-gradient(ellipse 50% 60% at 80% 60%, rgba(242, 184, 178, 0.15) 0%, transparent 65%),
    radial-gradient(ellipse 40% 40% at 50% 85%, rgba(191, 231, 214, 0.12) 0%, transparent 60%),
    var(--color-paper);
}
```

**Rules:**
- Keep each gradient layer at **10–25% opacity** per the brand guidelines.
- Use asymmetric ellipse shapes — avoid perfect circles.
- Position centers off-grid (not at 50% 50%) for an organic feel.
- Layer 2–4 gradients maximum per section. More creates visual noise.

## SVG Displacement Filter

Use `feTurbulence` + `feDisplacementMap` to distort edges of elements, giving them a hand-painted watercolor border.

**Inline SVG filter definition** (place once in the page):

```html
<svg width="0" height="0" style="position: absolute;">
  <defs>
    <filter id="watercolor-edge">
      <feTurbulence type="turbulence" baseFrequency="0.03" numOctaves="3" result="turbulence" seed="2"/>
      <feDisplacementMap in="SourceGraphic" in2="turbulence" scale="6" xChannelSelector="R" yChannelSelector="G"/>
    </filter>
    <filter id="watercolor-edge-strong">
      <feTurbulence type="turbulence" baseFrequency="0.02" numOctaves="4" result="turbulence" seed="5"/>
      <feDisplacementMap in="SourceGraphic" in2="turbulence" scale="12" xChannelSelector="R" yChannelSelector="G"/>
    </filter>
  </defs>
</svg>
```

**Apply to elements via CSS:**

```css
.watercolor-border {
  filter: url(#watercolor-edge);
}

.watercolor-border-strong {
  filter: url(#watercolor-edge-strong);
}
```

**Parameters:**
- `baseFrequency`: 0.02–0.05. Lower = larger, smoother distortion. Higher = more jagged.
- `scale`: 4–15. Controls distortion intensity. 6 is subtle, 12 is pronounced.
- `seed`: Change for variation between elements.

**Caveat**: SVG filters can impact rendering performance. Apply only to decorative elements (images, section backgrounds, dividers) — never to text or interactive elements.

## Brush-Stroke Section Separators

Replace hard `<hr>` or border separators with organic brush-stroke shapes using CSS `clip-path` or inline SVG.

**CSS clip-path approach:**

```css
.section-separator {
  width: 100%;
  height: 24px;
  background: linear-gradient(90deg, transparent 5%, rgba(111, 168, 216, 0.25) 20%, rgba(242, 184, 178, 0.20) 50%, rgba(191, 231, 214, 0.18) 80%, transparent 95%);
  clip-path: polygon(
    0% 60%, 5% 45%, 12% 55%, 20% 40%, 30% 50%, 40% 35%,
    50% 48%, 60% 38%, 70% 52%, 80% 42%, 88% 55%, 95% 45%, 100% 55%,
    100% 70%, 95% 60%, 88% 68%, 80% 58%, 70% 65%, 60% 55%,
    50% 62%, 40% 52%, 30% 60%, 20% 55%, 12% 65%, 5% 58%, 0% 65%
  );
}
```

**Inline SVG approach** (more control):

```html
<svg viewBox="0 0 1200 30" preserveAspectRatio="none" class="w-full h-6" aria-hidden="true">
  <path d="M0,15 Q100,5 200,14 T400,12 T600,16 T800,11 T1000,15 T1200,13"
        stroke="rgba(111,168,216,0.3)" stroke-width="3" fill="none"
        stroke-linecap="round"/>
</svg>
```

## Watercolor Overlay

Apply a watercolor wash effect over any section using pseudo-elements with blend modes.

```css
.watercolor-section {
  position: relative;
  isolation: isolate;
}

.watercolor-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 90% 70% at 30% 40%, rgba(111, 168, 216, 0.15) 0%, transparent 60%),
    radial-gradient(ellipse 60% 50% at 70% 65%, rgba(242, 184, 178, 0.10) 0%, transparent 55%);
  mix-blend-mode: multiply;
  pointer-events: none;
  z-index: -1;
}
```

**Rules:**
- Always set `isolation: isolate` on the parent to contain the blend mode.
- `mix-blend-mode: multiply` darkens subtly — ideal for light backgrounds.
- `mix-blend-mode: overlay` creates more contrast — use sparingly on sections with text.
- Keep opacity in the 8–25% range within the gradients.
- Add `pointer-events: none` so the overlay doesn't block interaction.

## Noise Texture

Standalone SVG noise for use as a background texture or overlay. More configurable than the paper-grain.

```css
.noise-overlay {
  position: relative;
}

.noise-overlay::after {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  opacity: 0.04;
  background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  background-size: 256px 256px;
}
```

**Variants:**
- `baseFrequency: 0.5` — coarser grain (watercolor paper feel)
- `baseFrequency: 0.8` — fine grain (smooth paper)
- `baseFrequency: 1.2` — very fine (almost invisible, digital noise)

## Watercolor Blob Shapes

Organic blob shapes for decorative backgrounds, card accents, or floating elements.

```css
.blob {
  width: 300px;
  height: 300px;
  border-radius: 42% 58% 62% 38% / 45% 55% 45% 55%;
  background: radial-gradient(ellipse at 40% 40%, rgba(111, 168, 216, 0.25), rgba(111, 168, 216, 0.05));
  filter: url(#watercolor-edge);
  animation: blob-morph 12s ease-in-out infinite alternate;
}

@keyframes blob-morph {
  0%   { border-radius: 42% 58% 62% 38% / 45% 55% 45% 55%; }
  33%  { border-radius: 55% 45% 38% 62% / 58% 42% 55% 45%; }
  66%  { border-radius: 38% 62% 55% 45% / 42% 58% 62% 38%; }
  100% { border-radius: 48% 52% 45% 55% / 55% 45% 48% 52%; }
}
```

**Usage:**
- Place blobs as `position: absolute` decorative elements behind content.
- Use `z-index: -1` and `pointer-events: none`.
- Vary colors: swap the blue rgba for salmon or mint to create variety.
- Animation is optional — static blobs work well for simpler designs.
- Apply the SVG displacement filter for extra organic distortion.

## Combining Techniques

A typical Acuarelasoft page section combines:

1. **Paper-grain** on `<body>` for global texture
2. **Wash gradient** on the hero section
3. **Blob shapes** as floating decorative accents
4. **Brush-stroke separator** between sections
5. **Displacement filter** on decorative images

Keep total visual layers manageable — 2–3 effects per viewport. More creates visual fatigue and hurts performance.
