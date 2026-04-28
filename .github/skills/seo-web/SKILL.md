---
name: seo-web
description: >
  Comprehensive SEO code optimization rules for modern websites. Practical implementation
  guidelines with code examples for semantic HTML, structured data (JSON-LD/schema.org), meta tags,
  Core Web Vitals, accessibility, performance, indexation, social metadata, security headers, and
  SEO testing. Includes a structured data catalog with 120+ schema.org types — use `fetch_webpage`
  on catalog URLs to get full property specs before implementing.
  USE WHEN: writing HTML structure or semantic markup; adding JSON-LD structured data; optimizing
  Core Web Vitals (LCP, INP, CLS); configuring meta tags, canonical URLs, hreflang, sitemaps,
  robots.txt; implementing Open Graph or Twitter Cards; adding ARIA, alt text, keyboard nav;
  optimizing images or lazy-loading; configuring security headers; building breadcrumbs or internal
  linking; handling duplicate content or pagination; targeting featured snippets or rich results;
  setting up Lighthouse CI or SEO tests.
---

# SEO Web

Practical rules for writing SEO-optimized code on modern websites. Each rule includes a title, purpose, implementation with code examples and recommended values, common risks, priority (High/Medium/Low), and effort estimate.

## Rule Categories

| Category | Reference | Rules | Focus |
|----------|-----------|-------|-------|
| Semantic HTML & Accessibility | [references/semantic-html.md](references/semantic-html.md) | 10 | Document structure, headings, meta tags, ARIA, keyboard nav |
| Performance & Core Web Vitals | [references/performance-vitals.md](references/performance-vitals.md) | 12 | Images, lazy-loading, critical CSS, LCP/INP/CLS, responsive |
| Indexation, URLs & Links | [references/indexation-urls.md](references/indexation-urls.md) | 11 | Canonical, robots, sitemap, hreflang, internal linking, pagination |
| Social, Security & Snippets | [references/social-security-snippets.md](references/social-security-snippets.md) | 10 | OG, Twitter Cards, HTTPS, security headers, featured snippets, testing |
| Structured Data Catalog | [references/structured-data-catalog.md](references/structured-data-catalog.md) | 120+ types | Schema.org types with URLs for on-demand fetching |

Load only the reference file relevant to the current task.

## Structured Data Workflow

When adding structured data (JSON-LD) to a page:

1. **Identify the schema type** — Look up the matching type in [references/structured-data-catalog.md](references/structured-data-catalog.md).
2. **Fetch the full property spec** — Use `fetch_webpage` with the Schema.org URL from the catalog to get the complete list of properties, required fields, and expected value types.
3. **Fetch Google implementation guide** (if available) — Use `fetch_webpage` with the Google Docs URL for Google-specific requirements and rich result eligibility.
4. **Implement JSON-LD** — Build a `<script type="application/ld+json">` block with required + recommended properties.
5. **Validate** — Test with Google Rich Results Test or Schema.org Validator.

**Always use JSON-LD format** — Google, Bing, and other search engines prefer it over Microdata or RDFa.

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Article Title",
  "image": "https://example.com/image.jpg",
  "datePublished": "2026-04-01T08:00:00Z",
  "dateModified": "2026-04-05T10:00:00Z",
  "author": {
    "@type": "Person",
    "name": "Author Name",
    "url": "https://example.com/authors/name"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Publisher Name",
    "logo": {
      "@type": "ImageObject",
      "url": "https://example.com/logo.png"
    }
  }
}
</script>
```

## Quick Start — Essential SEO Checklist

Minimum SEO requirements for any page:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Primary Keyword — Secondary | Brand</title>                     <!-- 50-60 chars -->
  <meta name="description" content="Page description with keyword.">     <!-- 150-160 chars -->
  <link rel="canonical" href="https://example.com/current-page">         <!-- Absolute URL -->

  <!-- Open Graph -->
  <meta property="og:title" content="Page Title">
  <meta property="og:description" content="Description for social sharing.">
  <meta property="og:image" content="https://example.com/og-image.jpg">  <!-- 1200x630 -->
  <meta property="og:url" content="https://example.com/current-page">
  <meta property="og:type" content="website">

  <!-- Preload LCP resource -->
  <link rel="preload" as="image" href="/images/hero.webp" fetchpriority="high">
  <!-- Critical CSS inline, defer the rest -->
  <style>/* critical above-fold CSS */</style>
  <link rel="preload" href="/css/main.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="/css/main.css"></noscript>
  <script src="/js/app.js" defer></script>
</head>
<body>
  <a href="#main" class="skip-link">Skip to main content</a>
  <header>
    <nav aria-label="Main navigation">...</nav>
  </header>
  <main id="main">
    <article>
      <h1>Single H1 with Primary Keyword</h1>
      <img src="hero.webp" alt="Descriptive alt" width="800" height="450"
           loading="eager" fetchpriority="high" decoding="async">
      <section>
        <h2>Subtopic</h2>
        <p>Content with <a href="/related-page">contextual internal links</a>.</p>
      </section>
    </article>
  </main>
  <footer>...</footer>

  <!-- Structured data -->
  <script type="application/ld+json">
  { "@context": "https://schema.org", "@type": "WebPage", "name": "Page Title" }
  </script>
</body>
</html>
```

## Core Web Vitals Targets

| Metric | Good | Needs Improvement | Poor |
|--------|------|-------------------|------|
| LCP (Largest Contentful Paint) | ≤ 2.5s | 2.5s – 4.0s | > 4.0s |
| INP (Interaction to Next Paint) | ≤ 200ms | 200ms – 500ms | > 500ms |
| CLS (Cumulative Layout Shift) | ≤ 0.1 | 0.1 – 0.25 | > 0.25 |

For implementation details, see [references/performance-vitals.md](references/performance-vitals.md).

## Priority Map

High-priority rules to implement first:

| # | Rule | Category | Impact |
|---|------|----------|--------|
| 1 | Semantic HTML structure | Semantic HTML | Foundation for all SEO |
| 2 | Title and meta description | Semantic HTML | Direct SERP impact |
| 3 | Heading hierarchy (h1–h6) | Semantic HTML | Content structure signal |
| 4 | Image optimization + alt text | Performance / Accessibility | LCP + image search + a11y |
| 5 | Canonical URLs | Indexation | Prevents duplicate content |
| 6 | Sitemap.xml + robots.txt | Indexation | Crawl discovery |
| 7 | Core Web Vitals (LCP, CLS) | Performance | Ranking signal |
| 8 | HTTPS + security headers | Security | Ranking signal + trust |
| 9 | Open Graph tags | Social | Social sharing CTR |
| 10 | Structured data (JSON-LD) | Structured Data | Rich results eligibility |

Medium-priority rules:

| # | Rule | Category | Impact |
|---|------|----------|--------|
| 11 | Internal linking strategy | Indexation | PageRank distribution |
| 12 | Breadcrumbs with schema | Indexation / Structured Data | Navigation + rich result |
| 13 | Mobile-first responsive | Performance | Mobile-first indexing |
| 14 | Clean URL structure | Indexation | Keyword signal + UX |
| 15 | ARIA landmarks + keyboard nav | Accessibility | a11y compliance |
| 16 | Featured snippet optimization | Snippets | Position zero |
| 17 | FAQ schema | Structured Data | Expandable rich result |
| 18 | Twitter Cards | Social | Social sharing |
| 19 | Hreflang (multilingual) | Indexation | Locale targeting |

Low-priority rules:

| # | Rule | Category | Impact |
|---|------|----------|--------|
| 20 | Crawler log monitoring | Testing | Crawl budget analysis |
| 21 | Speakable schema | Structured Data | Voice search |
| 22 | Math solver schema | Structured Data | Niche rich result |
