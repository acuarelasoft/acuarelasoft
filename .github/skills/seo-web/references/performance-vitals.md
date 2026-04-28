# Performance, Core Web Vitals & Responsive Design

## Table of Contents

- [1. Image Optimization](#1-image-optimization)
- [2. Lazy Loading](#2-lazy-loading)
- [3. Modern Image Formats](#3-modern-image-formats)
- [4. Critical CSS and Render Path](#4-critical-css-and-render-path)
- [5. Code Splitting and Bundle Optimization](#5-code-splitting-and-bundle-optimization)
- [6. Resource Minification](#6-resource-minification)
- [7. Caching Strategy](#7-caching-strategy)
- [8. CDN and Preconnect](#8-cdn-and-preconnect)
- [9. Largest Contentful Paint (LCP)](#9-largest-contentful-paint-lcp)
- [10. Interaction to Next Paint (INP)](#10-interaction-to-next-paint-inp)
- [11. Cumulative Layout Shift (CLS)](#11-cumulative-layout-shift-cls)
- [12. Mobile-First Responsive Design](#12-mobile-first-responsive-design)

---

### 1. Image Optimization

**Purpose**: Reduce image payload — images are typically the largest assets on a page and the primary cause of slow LCP.

**Priority**: High | **Effort**: 3h

**Implementation**:

```html
<!-- Responsive images with srcset and sizes -->
<img src="hero-800.webp"
     srcset="hero-400.webp 400w,
             hero-800.webp 800w,
             hero-1200.webp 1200w,
             hero-1600.webp 1600w"
     sizes="(max-width: 600px) 100vw,
            (max-width: 1200px) 50vw,
            800px"
     alt="Hero image description"
     width="800" height="450"
     loading="eager"
     fetchpriority="high"
     decoding="async">
```

**Recommended settings**:
- **Max width**: Serve images no wider than 2x the CSS display size.
- **Quality**: WebP at 75-85%, AVIF at 60-70% (perceptual quality is higher at lower settings).
- **Format priority**: AVIF > WebP > optimized JPEG/PNG.
- **Always set `width` and `height`** attributes to prevent CLS.

**Risks**:
- Serving 4000px images for 400px containers — massive waste of bandwidth
- Missing `width`/`height` — causes layout shift as images load
- Not providing fallback formats for older browsers
- Using `loading="lazy"` on hero/above-the-fold images — delays LCP

---

### 2. Lazy Loading

**Purpose**: Defer loading of off-screen images and iframes to reduce initial page weight and speed up LCP.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<!-- Native lazy loading for images below the fold -->
<img src="article-image.webp"
     alt="Description"
     width="600" height="400"
     loading="lazy"
     decoding="async">

<!-- Lazy load iframes (YouTube, maps, etc.) -->
<iframe src="https://www.youtube.com/embed/VIDEO_ID"
        title="Video title for accessibility"
        width="560" height="315"
        loading="lazy"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope"
        allowfullscreen>
</iframe>

<!-- Facade pattern for heavy embeds -->
<div class="youtube-facade" data-video-id="VIDEO_ID" onclick="loadVideo(this)">
  <img src="thumbnail.webp" alt="Video title" width="560" height="315">
  <button aria-label="Play video">▶</button>
</div>
```

**Rules**:
- **Never lazy-load the LCP element** (hero image, above-the-fold content).
- **Use `loading="lazy"` on all below-the-fold images and iframes**.
- **Use facade pattern for heavy third-party embeds** (YouTube, Google Maps) — load only on interaction.
- **Add `decoding="async"`** to prevent image decoding from blocking the main thread.

**Risks**:
- Lazy-loading hero images — delays LCP, use `loading="eager"` + `fetchpriority="high"` instead
- Lazy-loading all images including above-the-fold — the first viewport should load eagerly
- Not providing dimensions for lazy-loaded images — causes CLS when they appear

---

### 3. Modern Image Formats

**Purpose**: Use next-gen formats (WebP, AVIF) for significantly smaller file sizes at equivalent visual quality.

**Priority**: High | **Effort**: 2h

**Implementation**:

```html
<!-- Progressive format fallback with <picture> -->
<picture>
  <source srcset="photo.avif" type="image/avif">
  <source srcset="photo.webp" type="image/webp">
  <img src="photo.jpg" alt="Description" width="800" height="600" loading="lazy">
</picture>

<!-- For CSS backgrounds via media queries -->
<style>
.hero {
  background-image: url('hero.jpg');
}
@supports (background-image: url('hero.avif')) {
  .hero {
    background-image: url('hero.avif');
  }
}
</style>
```

**Format comparison**:

| Format | Compression | Browser Support | Best For |
|--------|------------|-----------------|----------|
| AVIF | ~50% smaller than JPEG | Chrome, Firefox, Safari 16.4+ | Photos, complex images |
| WebP | ~30% smaller than JPEG | All modern browsers | Universal fallback |
| JPEG | Baseline | Universal | Fallback only |
| PNG | Lossless | Universal | Transparency, icons |
| SVG | Vector | Universal | Icons, logos, illustrations |

**Risks**:
- Not providing JPEG/PNG fallback — older browsers show broken images
- Using PNG for photos — vastly larger file sizes than WebP/AVIF
- Over-compressing AVIF — artifacts at very low quality settings
- Not automating format conversion in the build pipeline

---

### 4. Critical CSS and Render Path

**Purpose**: Inline above-the-fold CSS to eliminate render-blocking stylesheets and accelerate First Contentful Paint.

**Priority**: High | **Effort**: 3h

**Implementation**:

```html
<head>
  <!-- Inline critical CSS for above-the-fold content -->
  <style>
    /* Only styles needed for initial viewport */
    *,*::before,*::after{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,sans-serif;line-height:1.6}
    .header{background:#1a1a2e;color:#fff;padding:1rem}
    .hero{min-height:60vh;display:flex;align-items:center}
    .hero img{width:100%;height:auto;aspect-ratio:16/9}
  </style>

  <!-- Defer non-critical CSS -->
  <link rel="preload" href="/css/main.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="/css/main.css"></noscript>

  <!-- Preload LCP image -->
  <link rel="preload" as="image" href="/images/hero.webp"
        imagesrcset="hero-400.webp 400w, hero-800.webp 800w, hero-1200.webp 1200w"
        imagesizes="100vw"
        fetchpriority="high">

  <!-- Defer non-critical JavaScript -->
  <script src="/js/app.js" defer></script>
</head>
```

**Rules**:
- **Inline critical CSS** — only styles for above-the-fold content, keep under 14KB.
- **Preload the LCP resource** — hero image, web font, or key background.
- **Defer all non-critical CSS** with `preload` + `onload` swap.
- **Use `defer` or `async` on all scripts** — never block rendering with synchronous JS.
- **Move third-party scripts to bottom of `<body>`** or load with `defer`.

**Risks**:
- Inlining too much CSS — bloats HTML, negates the benefit
- Forgetting `<noscript>` fallback — CSS never loads if JS is disabled
- Not preloading the LCP image — browser discovers it late
- Render-blocking fonts — use `font-display: swap` or `font-display: optional`

---

### 5. Code Splitting and Bundle Optimization

**Purpose**: Reduce initial JavaScript payload by splitting code into smaller chunks loaded on demand.

**Priority**: Medium | **Effort**: 4h

**Implementation**:

```javascript
// Route-based code splitting (React example)
import { lazy, Suspense } from 'react';

const ProductPage = lazy(() => import('./pages/ProductPage'));
const CheckoutPage = lazy(() => import('./pages/CheckoutPage'));

function App() {
  return (
    <Suspense fallback={<div>Loading...</div>}>
      <Routes>
        <Route path="/product/:id" element={<ProductPage />} />
        <Route path="/checkout" element={<CheckoutPage />} />
      </Routes>
    </Suspense>
  );
}

// Dynamic import for non-critical features
button.addEventListener('click', async () => {
  const { openModal } = await import('./modal.js');
  openModal();
});
```

```html
<!-- Module/nomodule pattern for modern/legacy split -->
<script type="module" src="/js/app.modern.js"></script>
<script nomodule src="/js/app.legacy.js"></script>
```

**Rules**:
- **Split by route** — each page loads only its own code.
- **Lazy-load non-critical features** — modals, carousels, analytics.
- **Keep initial bundle under 150KB** (gzipped) for good TTI.
- **Use `type="module"`** for modern browsers, `nomodule` for legacy fallback.
- **Tree-shake unused code** — ensure bundler eliminates dead code.

**Risks**:
- Too many small chunks — excessive HTTP requests and overhead
- Loading all code upfront — slow initial load, poor TTI
- Not code-splitting vendor libraries — bundle includes entire library for small usage
- Missing loading states for lazy components — users see blank areas

---

### 6. Resource Minification

**Purpose**: Remove whitespace, comments, and unnecessary characters from HTML, CSS, and JS to reduce transfer size.

**Priority**: Medium | **Effort**: 1h

**Implementation**:

```json
// Example: Vite/Rollup configuration
{
  "build": {
    "minify": "terser",
    "cssMinify": true,
    "rollupOptions": {
      "output": {
        "manualChunks": {
          "vendor": ["react", "react-dom"]
        }
      }
    }
  }
}
```

```nginx
# Nginx gzip configuration
gzip on;
gzip_types text/plain text/css application/json application/javascript text/xml image/svg+xml;
gzip_min_length 256;
gzip_comp_level 6;
gzip_vary on;

# Brotli (preferred over gzip — ~15-20% smaller)
brotli on;
brotli_types text/plain text/css application/json application/javascript text/xml image/svg+xml;
brotli_comp_level 6;
```

**Rules**:
- **Minify HTML, CSS, and JS** in production builds.
- **Enable Brotli compression** — preferred over gzip, ~15-20% smaller.
- **Enable gzip as fallback** for older clients.
- **Minimum 256 bytes** — do not compress tiny files, the overhead is not worth it.

**Risks**:
- Serving unminified assets in production — unnecessary bandwidth waste
- Compressing already-compressed formats (JPEG, PNG, WOFF2) — wastes CPU, no size benefit
- Over-aggressive minification breaking code (rare with modern tools but test)

---

### 7. Caching Strategy

**Purpose**: Reduce repeat visits load time and server load by leveraging browser and CDN cache effectively.

**Priority**: High | **Effort**: 2h

**Implementation**:

```nginx
# Static assets with content hash (immutable)
location ~* \.(js|css|woff2|avif|webp|jpg|png|svg)$ {
    add_header Cache-Control "public, max-age=31536000, immutable";
}

# HTML pages — revalidate every time
location ~* \.html$ {
    add_header Cache-Control "no-cache, must-revalidate";
    add_header ETag "";
}

# API responses — short cache
location /api/ {
    add_header Cache-Control "private, max-age=60, stale-while-revalidate=300";
}

# Service Worker — never cache
location /sw.js {
    add_header Cache-Control "no-store";
}
```

**Recommended cache durations**:

| Resource Type | Cache-Control | Reason |
|--------------|--------------|--------|
| Hashed assets (JS, CSS) | `max-age=31536000, immutable` | Hash changes on content change |
| Images | `max-age=31536000, immutable` | Use versioned URLs |
| HTML pages | `no-cache` | Must revalidate for fresh content |
| API responses | `max-age=60, stale-while-revalidate=300` | Short-lived, stale OK briefly |
| Fonts (WOFF2) | `max-age=31536000, immutable` | Rarely change |

**Risks**:
- Long cache on HTML pages — users see stale content
- Missing `immutable` on hashed assets — unnecessary revalidation requests
- No `stale-while-revalidate` — users wait for revalidation on cache expiry
- Not using content hashes in filenames — cache invalidation becomes impossible

---

### 8. CDN and Preconnect

**Purpose**: Reduce latency by serving assets from edge locations close to users and establishing early connections.

**Priority**: Medium | **Effort**: 1h

**Implementation**:

```html
<head>
  <!-- Preconnect to critical third-party origins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdn.example.com" crossorigin>

  <!-- DNS prefetch for less critical origins -->
  <link rel="dns-prefetch" href="https://analytics.example.com">
  <link rel="dns-prefetch" href="https://pixel.example.com">

  <!-- Prefetch next likely page -->
  <link rel="prefetch" href="/products" as="document">
</head>
```

**Rules**:
- **Preconnect to known third-party origins** — saves 100-300ms per origin (DNS + TCP + TLS).
- **Limit to 2-4 preconnects** — too many compete for bandwidth on connection-limited devices.
- **Use `dns-prefetch` for less critical origins** — lighter than preconnect.
- **Use `prefetch` for likely next navigation** — loads in idle time.
- **Always add `crossorigin` for CORS resources** (fonts, API calls).

**Risks**:
- Too many preconnects — saturates connection pool, hurts rather than helps
- Preconnecting to origins not used on the page — wasted connection
- Missing `crossorigin` attribute — results in double connections for CORS requests
- Not using a CDN for static assets — users far from origin server experience high latency

---

### 9. Largest Contentful Paint (LCP)

**Purpose**: Measure and optimize the render time of the largest visible element. Target: **≤ 2.5 seconds**.

**Priority**: High | **Effort**: 4h

**Implementation**:

```html
<!-- Identify and optimize the LCP element -->
<!-- Common LCP elements: hero image, headline text, video poster -->

<!-- 1. Preload the LCP image -->
<link rel="preload" as="image" href="/images/hero.webp" fetchpriority="high">

<!-- 2. Mark LCP image as high priority -->
<img src="/images/hero.webp"
     alt="Hero"
     width="1200" height="630"
     loading="eager"
     fetchpriority="high"
     decoding="async">

<!-- 3. Optimize LCP for text-based elements -->
<style>
  /* Prevent font-swap delay on LCP text */
  @font-face {
    font-family: 'Heading';
    src: url('/fonts/heading.woff2') format('woff2');
    font-display: optional; /* or swap */
  }
</style>
<link rel="preload" as="font" href="/fonts/heading.woff2" type="font/woff2" crossorigin>
```

**LCP optimization checklist**:
1. Identify the LCP element (use DevTools → Performance → LCP).
2. Preload it from `<head>` — do not rely on CSS or JS to discover it.
3. Use `fetchpriority="high"` on the LCP image.
4. Inline critical CSS to prevent render-blocking.
5. Avoid lazy-loading the LCP element.
6. Serve optimized formats (WebP/AVIF) at appropriate dimensions.
7. Use `font-display: optional` or `swap` for custom fonts.

**Risks**:
- LCP image discovered late (via CSS background-image or JS) — must preload from HTML
- Lazy-loading the LCP element — adds significant delay
- Render-blocking CSS/JS before LCP — defer everything non-critical
- Server response time (TTFB) too slow — optimize backend, use CDN

---

### 10. Interaction to Next Paint (INP)

**Purpose**: Measure and optimize responsiveness to user interactions. Target: **≤ 200 milliseconds**.

**Priority**: High | **Effort**: 4h

**Implementation**:

```javascript
// Break up long tasks with yielding
async function processItems(items) {
  for (const item of items) {
    processItem(item);

    // Yield to the main thread every 50ms
    if (performance.now() - lastYield > 50) {
      await scheduler.yield(); // Modern API
      // Fallback: await new Promise(r => setTimeout(r, 0));
      lastYield = performance.now();
    }
  }
}

// Use requestIdleCallback for non-urgent work
requestIdleCallback(() => {
  analytics.trackPageView();
  loadRecommendations();
});

// Debounce expensive handlers
function debounce(fn, delay = 150) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => fn(...args), delay);
  };
}

searchInput.addEventListener('input', debounce(handleSearch));

// Use CSS containment to limit layout recalculation scope
// .card { contain: layout style paint; }
```

**INP optimization checklist**:
1. **Break up long tasks** — no single task should block the main thread for >50ms.
2. **Use `scheduler.yield()`** to let the browser process pending interactions.
3. **Avoid layout thrashing** — batch DOM reads, then DOM writes.
4. **Debounce/throttle** expensive event handlers (scroll, input, resize).
5. **Use CSS `contain`** — limits the scope of layout/paint recalculation.
6. **Minimize third-party script impact** — load non-critical scripts after page interactive.
7. **Use `requestIdleCallback`** for non-urgent processing.

**Risks**:
- Long-running event handlers blocking the main thread — interactions feel frozen
- Third-party scripts (analytics, ads, chat widgets) degrading INP
- Layout thrashing — reading and writing DOM in alternating loops
- Not measuring INP in production — synthetic tests may not capture real-user patterns

---

### 11. Cumulative Layout Shift (CLS)

**Purpose**: Prevent unexpected visual movement of page elements. Target: **≤ 0.1**.

**Priority**: High | **Effort**: 2h

**Implementation**:

```html
<!-- 1. Always set explicit dimensions on media -->
<img src="photo.webp" alt="Description" width="800" height="600">
<video width="640" height="360" poster="thumb.webp">...</video>
<iframe width="560" height="315" title="Video">...</iframe>

<!-- 2. Use aspect-ratio for responsive media -->
<style>
.video-container {
  aspect-ratio: 16 / 9;
  width: 100%;
  background: #e0e0e0; /* Placeholder color */
}

.ad-slot {
  min-height: 250px; /* Reserve space for ad */
  background: #f5f5f5;
}
</style>

<!-- 3. Prevent font swap shift -->
<style>
@font-face {
  font-family: 'Body';
  src: url('/fonts/body.woff2') format('woff2');
  font-display: optional; /* Prevents layout shift from font swap */
  size-adjust: 100%;
  ascent-override: 90%;
  descent-override: 20%;
}
</style>

<!-- 4. Avoid injecting content above existing content -->
<!-- BAD: dynamically inserting a banner above the hero -->
<!-- GOOD: reserve space or use fixed/sticky positioning -->
```

**CLS optimization checklist**:
1. **Set `width` and `height` on all `<img>`, `<video>`, `<iframe>`** — browser reserves space.
2. **Use `aspect-ratio`** CSS for responsive containers.
3. **Reserve space for ads and embeds** — use `min-height` on ad slots.
4. **Use `font-display: optional`** — prevents FOUT-caused layout shifts.
5. **Never inject content above existing content** — pushes everything down.
6. **Use CSS `transform` for animations** — does not trigger layout, only compositing.
7. **Avoid `top`/`left` animations** — cause layout recalculations.

**Risks**:
- Images without dimensions — browser cannot reserve space until loaded
- Dynamic banners/notifications inserted at page top — major CLS source
- Web fonts causing FOUT — text reflows when custom font loads
- Ads loading late and expanding — push content down
- CSS animations using `width`/`height`/`margin` instead of `transform`

---

### 12. Mobile-First Responsive Design

**Purpose**: Build mobile layout first and progressively enhance for larger screens. Google uses mobile-first indexing.

**Priority**: High | **Effort**: 3h

**Implementation**:

```css
/* Base styles = mobile (no media query needed) */
.container {
  padding: 1rem;
  width: 100%;
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1rem;
}

/* Tablet and up */
@media (min-width: 768px) {
  .container {
    padding: 2rem;
    max-width: 720px;
    margin: 0 auto;
  }
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Desktop */
@media (min-width: 1024px) {
  .container {
    max-width: 960px;
  }
  .grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Large desktop */
@media (min-width: 1280px) {
  .container {
    max-width: 1200px;
  }
  .grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Touch-friendly interactive targets */
button, a, [role="button"] {
  min-height: 44px;   /* WCAG 2.5.8 minimum */
  min-width: 44px;
  padding: 12px 16px;
}

/* Responsive typography using clamp */
h1 { font-size: clamp(1.75rem, 4vw, 3rem); }
h2 { font-size: clamp(1.375rem, 3vw, 2.25rem); }
p  { font-size: clamp(1rem, 2vw, 1.125rem); }
```

**Breakpoint recommendations**:

| Breakpoint | Target | Min-width |
|-----------|--------|-----------|
| Base | Mobile phones | No query |
| sm | Large phones | 640px |
| md | Tablets | 768px |
| lg | Small desktop | 1024px |
| xl | Large desktop | 1280px |

**Rules**:
- **Start with mobile styles** — add `min-width` media queries for larger screens.
- **Use relative units** — `rem`, `em`, `%`, `vw` instead of `px` for text and spacing.
- **Use `clamp()` for fluid typography** — smooth scaling without breakpoints.
- **Minimum 44x44px touch targets** — WCAG 2.5.8 requirement.
- **Test on real devices** — emulators do not capture all touch/scroll behaviors.

**Risks**:
- Starting with desktop and scaling down — leads to overcomplicated mobile overrides
- Fixed-width layouts — break on different screen sizes
- Text too small on mobile — minimum 16px for body text
- Touch targets too small — users cannot tap accurately on mobile
- Not testing landscape orientation on mobile
