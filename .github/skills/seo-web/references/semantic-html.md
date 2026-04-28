# Semantic HTML, Headings, Meta Tags & Accessibility

## Table of Contents

- [1. Semantic HTML Document Structure](#1-semantic-html-document-structure)
- [2. Heading Hierarchy (h1–h6)](#2-heading-hierarchy-h1h6)
- [3. Title Tag](#3-title-tag)
- [4. Meta Description](#4-meta-description)
- [5. Viewport Meta Tag](#5-viewport-meta-tag)
- [6. Robots Meta Tag](#6-robots-meta-tag)
- [7. Image Alt Attributes](#7-image-alt-attributes)
- [8. ARIA Landmarks and Roles](#8-aria-landmarks-and-roles)
- [9. Keyboard Navigation](#9-keyboard-navigation)
- [10. Language and Direction Attributes](#10-language-and-direction-attributes)

---

### 1. Semantic HTML Document Structure

**Purpose**: Use semantic elements so search engines and assistive technologies understand page regions.

**Priority**: High | **Effort**: 2h

**Implementation**:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Title — Site Name</title>
  <meta name="description" content="Concise 150-160 char description of this page.">
</head>
<body>
  <header>
    <nav aria-label="Main navigation">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <article>
      <h1>Primary Page Topic</h1>
      <section>
        <h2>Subtopic</h2>
        <p>Content...</p>
      </section>
    </article>

    <aside aria-label="Related content">
      <h2>Related Articles</h2>
    </aside>
  </main>

  <footer>
    <nav aria-label="Footer navigation">
      <ul>
        <li><a href="/privacy">Privacy Policy</a></li>
        <li><a href="/terms">Terms</a></li>
      </ul>
    </nav>
    <p>&copy; 2026 Site Name</p>
  </footer>
</body>
</html>
```

**Element usage rules**:

| Element | When to use | SEO impact |
|---------|------------|------------|
| `<header>` | Site-wide or section header with logo/nav | Identifies navigation region |
| `<nav>` | Primary, secondary, footer navigation | Helps crawlers discover link structure |
| `<main>` | One per page — primary content area | Signals main indexable content |
| `<article>` | Self-contained content (blog post, product, news) | Indicates standalone, shareable content |
| `<section>` | Thematic grouping within an article or page | Groups related content with heading |
| `<aside>` | Tangentially related content (sidebar, callout) | Distinguishes supplementary from core content |
| `<footer>` | Site-wide or section footer | Contains legal, copyright, secondary nav |

**Risks**:
- Wrapping everything in `<div>` — search engines cannot infer page structure
- Using `<section>` without a heading — every `<section>` should have an `<h2>`–`<h6>`
- Multiple `<main>` elements — only one `<main>` per page
- Nesting `<article>` inside `<section>` when the section has no distinct topic

---

### 2. Heading Hierarchy (h1–h6)

**Purpose**: Establish a logical content outline that search engines use to understand topic structure.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<h1>Complete Guide to Container Gardening</h1>          <!-- One per page, primary topic -->
  <h2>Choosing the Right Containers</h2>                 <!-- Major subtopic -->
    <h3>Material Comparison</h3>                          <!-- Detail under subtopic -->
    <h3>Size Recommendations</h3>
  <h2>Soil and Fertilizer</h2>
    <h3>Organic Options</h3>
      <h4>Composting Basics</h4>                          <!-- Further nesting -->
  <h2>Watering Strategies</h2>
```

**Rules**:
- **One `<h1>` per page** — represents the primary topic. Multiple `<h1>`s are valid HTML5 but dilute SEO signal.
- **Do not skip levels** — go h1 → h2 → h3, never h1 → h3.
- **Keep `<h1>` under 60 characters** for SERP display.
- **Include primary keyword** in the `<h1>`, secondary keywords in `<h2>`s.

**When multiple `<h1>` is acceptable**:
- Each `<article>` within a page listing (e.g., a blog index) may have its own `<h1>`.
- Use this only when each article is truly self-contained.

**Risks**:
- Using headings for visual styling instead of structure — use CSS for font size
- Empty headings or headings with only images
- Keyword stuffing in headings — keep them natural and descriptive

---

### 3. Title Tag

**Purpose**: Defines the page title shown in SERPs and browser tabs. The single most important on-page SEO element.

**Priority**: High | **Effort**: 0.5h

**Implementation**:

```html
<!-- Format: Primary Keyword — Secondary Keyword | Brand Name -->
<title>Container Gardening Guide — Best Pots & Soil Tips | GreenThumb</title>
```

**Rules**:
- **50-60 characters** maximum (Google truncates at ~60).
- **Unique per page** — no two pages should share the same title.
- **Primary keyword near the beginning** of the title.
- **Brand at the end** separated by `|` or `—`.
- **No keyword stuffing** — write for humans first.

**Risks**:
- Titles over 60 characters get truncated with "..."
- Duplicate titles across pages — Google may choose its own title
- Empty or generic titles like "Home" or "Untitled"
- All-caps titles — perceived as spammy

---

### 4. Meta Description

**Purpose**: Provides a page summary for SERPs. Does not directly affect ranking but impacts click-through rate (CTR).

**Priority**: High | **Effort**: 0.5h

**Implementation**:

```html
<meta name="description" content="Learn container gardening basics: choosing pots, soil types, watering schedules, and fertilizer tips. Start growing vegetables and herbs in small spaces today.">
```

**Rules**:
- **150-160 characters** — Google truncates at ~160.
- **Unique per page** — duplicate descriptions are ignored.
- **Include primary keyword** naturally — Google bolds matching terms.
- **Include a call to action** ("Learn", "Discover", "Get started").
- **Accurately describe page content** — misleading descriptions increase bounce rate.

**Risks**:
- Missing meta description — Google auto-generates one (often poorly)
- Character count over 160 — truncation mid-sentence
- Duplicate descriptions across pages
- Keyword stuffing — reads unnaturally, reduces CTR

---

### 5. Viewport Meta Tag

**Purpose**: Enable responsive rendering on mobile devices. Required for mobile-first indexing.

**Priority**: High | **Effort**: 0.25h

**Implementation**:

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

**Rules**:
- **Always include on every page** — required for mobile-first indexing.
- **Never set `maximum-scale=1`** or `user-scalable=no` — blocks pinch-to-zoom, violates WCAG 2.1.
- **Avoid fixed-width viewports** like `width=1024`.

**Risks**:
- Missing viewport tag — page renders at desktop width on mobile, Google penalizes
- `user-scalable=no` — accessibility violation, users cannot zoom
- `initial-scale` values other than 1.0 without clear justification

---

### 6. Robots Meta Tag

**Purpose**: Control whether search engines index a page and follow its links.

**Priority**: Medium | **Effort**: 0.5h

**Implementation**:

```html
<!-- Default behavior (index and follow) — no tag needed -->

<!-- Prevent indexing but follow links -->
<meta name="robots" content="noindex, follow">

<!-- Prevent indexing and do not follow links -->
<meta name="robots" content="noindex, nofollow">

<!-- Prevent caching of the page -->
<meta name="robots" content="noindex, noarchive">

<!-- Control snippet length and image preview -->
<meta name="robots" content="max-snippet:160, max-image-preview:large">

<!-- Google-specific: control AI overview snippets -->
<meta name="googlebot" content="noai, noimageai">
```

**Common directive values**:

| Directive | Effect |
|-----------|--------|
| `index` | Allow indexing (default) |
| `noindex` | Prevent indexing |
| `follow` | Follow links on this page (default) |
| `nofollow` | Do not follow any links |
| `noarchive` | Do not show cached copy |
| `nosnippet` | Do not show text snippet |
| `max-snippet:N` | Limit snippet to N characters |
| `max-image-preview:large` | Allow large image previews |
| `noimageindex` | Do not index images on page |

**Risks**:
- Accidentally adding `noindex` to important pages — blocks all organic traffic
- Using robots meta when `robots.txt` already blocks the page — both are not needed, but they serve different purposes
- Forgetting that `noindex` tags must be crawlable to be read — do not block the page in `robots.txt` AND add `noindex`

---

### 7. Image Alt Attributes

**Purpose**: Provide text descriptions for images for accessibility and image search ranking.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<!-- Informative image — describe content and function -->
<img src="garden-layout.jpg"
     alt="Raised bed garden layout with tomatoes, herbs, and peppers in a 4x8 foot space"
     width="800" height="600"
     loading="lazy">

<!-- Decorative image — empty alt to skip in screen readers -->
<img src="divider-line.svg" alt="" role="presentation">

<!-- Linked image — alt describes the destination -->
<a href="/products/red-pot">
  <img src="red-pot.jpg" alt="Shop 12-inch red ceramic flower pot">
</a>

<!-- Image with <figure> and <figcaption> -->
<figure>
  <img src="growth-chart.png" alt="Bar chart showing plant growth rate over 6 months">
  <figcaption>Figure 1: Monthly growth comparison of indoor vs. outdoor plants</figcaption>
</figure>
```

**Rules**:
- **Every `<img>` must have an `alt` attribute** — empty string for decorative images.
- **Be specific and concise** — under 125 characters.
- **Include relevant keywords naturally** — do not keyword stuff.
- **Do not start with "Image of" or "Picture of"** — screen readers already announce it is an image.
- **Always include `width` and `height`** — prevents CLS (layout shift).

**Risks**:
- Missing alt attributes — accessibility violation (WCAG 1.1.1) and lost image SEO
- Alt text that just says "image" or "photo" — provides no value
- Very long alt text (>125 chars) — becomes distracting for screen reader users
- Not setting explicit width/height — causes cumulative layout shift

---

### 8. ARIA Landmarks and Roles

**Purpose**: Enhance navigation for assistive technologies when semantic HTML alone is insufficient.

**Priority**: Medium | **Effort**: 1h

**Implementation**:

```html
<!-- Prefer semantic HTML over ARIA — these are equivalent: -->
<header>       <!-- = role="banner" -->
<nav>          <!-- = role="navigation" -->
<main>         <!-- = role="main" -->
<aside>        <!-- = role="complementary" -->
<footer>       <!-- = role="contentinfo" -->

<!-- Use ARIA only when semantic HTML is insufficient: -->
<div role="search" aria-label="Site search">
  <form action="/search">
    <label for="search-input">Search</label>
    <input id="search-input" type="search" name="q" aria-describedby="search-hint">
    <span id="search-hint" class="sr-only">Search articles, products, and help pages</span>
    <button type="submit">Search</button>
  </form>
</div>

<!-- Multiple navs need distinct labels -->
<nav aria-label="Main navigation">...</nav>
<nav aria-label="Breadcrumb" aria-describedby="breadcrumb-desc">
  <span id="breadcrumb-desc" class="sr-only">You are here</span>
  <ol>
    <li><a href="/">Home</a></li>
    <li><a href="/garden">Garden</a></li>
    <li aria-current="page">Containers</li>
  </ol>
</nav>

<!-- Live announcements for dynamic content -->
<div aria-live="polite" aria-atomic="true" class="sr-only">
  3 search results found
</div>
```

**Rules**:
- **First rule of ARIA: do not use ARIA if semantic HTML works** — `<nav>` is better than `<div role="navigation">`.
- **Label duplicate landmarks** — multiple `<nav>` elements need distinct `aria-label`.
- **Use `aria-current="page"`** on the active navigation link.
- **Use `aria-live` regions** for dynamic content updates (search results, notifications).

**Risks**:
- Redundant ARIA on semantic elements — `<nav role="navigation">` is redundant
- Missing labels on duplicate landmarks — screen readers cannot distinguish them
- Overusing `aria-hidden="true"` — hides content from assistive tech users
- Not testing with actual screen readers — ARIA bugs are invisible to sighted users

---

### 9. Keyboard Navigation

**Purpose**: Ensure all interactive elements are reachable and operable via keyboard for accessibility compliance.

**Priority**: Medium | **Effort**: 2h

**Implementation**:

```html
<!-- Skip link for keyboard users -->
<body>
  <a href="#main-content" class="skip-link">Skip to main content</a>
  <header>...</header>
  <main id="main-content" tabindex="-1">
    <!-- Main content -->
  </main>
</body>

<style>
.skip-link {
  position: absolute;
  top: -40px;
  left: 0;
  padding: 8px 16px;
  background: #000;
  color: #fff;
  z-index: 100;
  transition: top 0.2s;
}
.skip-link:focus {
  top: 0;
}
</style>

<!-- Custom interactive element with keyboard support -->
<div role="button"
     tabindex="0"
     onclick="handleClick()"
     onkeydown="if(event.key==='Enter'||event.key===' ') handleClick()">
  Custom Button
</div>

<!-- Focus visible styles -->
<style>
:focus-visible {
  outline: 2px solid #4A90D9;
  outline-offset: 2px;
}
/* Remove focus ring for mouse users */
:focus:not(:focus-visible) {
  outline: none;
}
</style>
```

**Rules**:
- **Add a skip-to-content link** as the first focusable element.
- **Use native interactive elements** (`<button>`, `<a>`, `<input>`) — they have built-in keyboard support.
- **Custom interactive elements need `tabindex="0"`** and keyboard event handlers for Enter and Space.
- **Maintain visible focus indicators** — never hide all focus outlines.
- **Logical tab order** — follows the DOM order, use `tabindex` only when necessary.

**Risks**:
- `outline: none` without replacement — keyboard users cannot see where focus is
- Positive `tabindex` values (1, 2, 3) — create unexpected tab order, use only `0` or `-1`
- Interactive content inside non-interactive elements without keyboard handlers
- Modals that do not trap focus — keyboard users tab behind the modal

---

### 10. Language and Direction Attributes

**Purpose**: Declare document language for search engines and screen readers. Affects indexing in correct locale.

**Priority**: Medium | **Effort**: 0.25h

**Implementation**:

```html
<!-- Global language declaration -->
<html lang="en">

<!-- Mixed-language content -->
<p>The French term <span lang="fr">mise en place</span> means everything in its place.</p>

<!-- Right-to-left content -->
<html lang="ar" dir="rtl">

<!-- Bidirectional text -->
<p>The Arabic word <bdo dir="rtl" lang="ar">مرحبا</bdo> means hello.</p>
```

**Rules**:
- **Always set `lang` on `<html>`** — required by WCAG 3.1.1.
- **Use ISO 639-1 language codes** — `en`, `es`, `fr`, `de`, `ja`, `zh`.
- **Mark inline language changes** with `lang` attribute on the containing element.
- **Set `dir="rtl"` for right-to-left languages** — Arabic, Hebrew, Farsi.

**Risks**:
- Missing `lang` attribute — screen readers use wrong pronunciation rules
- Wrong language code — affects search engine locale targeting
- Not marking inline language switches — screen readers mispronounce foreign words
