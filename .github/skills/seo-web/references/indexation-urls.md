# Indexation, URLs, Links & Pagination

## Table of Contents

- [1. Canonical URLs](#1-canonical-urls)
- [2. Noindex and Nofollow Directives](#2-noindex-and-nofollow-directives)
- [3. Hreflang for Multilingual Sites](#3-hreflang-for-multilingual-sites)
- [4. Sitemap.xml](#4-sitemapxml)
- [5. Robots.txt](#5-robotstxt)
- [6. Clean URL Structure](#6-clean-url-structure)
- [7. Internal Linking Strategy](#7-internal-linking-strategy)
- [8. Breadcrumb Navigation](#8-breadcrumb-navigation)
- [9. Link Rel Attributes (nofollow, ugc, sponsored)](#9-link-rel-attributes-nofollow-ugc-sponsored)
- [10. Duplicate Content Management](#10-duplicate-content-management)
- [11. Pagination](#11-pagination)

---

### 1. Canonical URLs

**Purpose**: Tell search engines which URL is the authoritative version when the same content is accessible via multiple URLs.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<head>
  <!-- Self-referencing canonical (every page should have one) -->
  <link rel="canonical" href="https://example.com/products/blue-widget">

  <!-- Cross-domain canonical (syndicated content) -->
  <link rel="canonical" href="https://original-site.com/article/seo-guide">
</head>
```

```
# HTTP header alternative (for non-HTML resources like PDFs)
Link: <https://example.com/report.pdf>; rel="canonical"
```

**Rules**:
- **Every page must have a self-referencing canonical tag** — even if there are no duplicates.
- **Use absolute URLs** — never relative paths.
- **Include protocol and preferred domain** — `https://www.` or `https://` — be consistent.
- **Canonical must point to a 200 status page** — never to a 404, redirect, or noindex page.
- **One canonical per page** — multiple canonicals are all ignored.
- **Canonical should match the URL in sitemap.xml**.

**Risks**:
- Missing canonicals — search engines guess, may pick the wrong URL
- Canonical pointing to a different page — Google treats it as a soft redirect, original page is deindexed
- Canonical with query parameters like `?utm_source=...` — strip tracking params
- Conflicting signals — canonical says URL A, but internal links and sitemap say URL B

---

### 2. Noindex and Nofollow Directives

**Purpose**: Control which pages are indexed and which links pass PageRank.

**Priority**: Medium | **Effort**: 1h

**Implementation**:

```html
<!-- Meta robots tag -->
<meta name="robots" content="noindex, follow">

<!-- X-Robots-Tag HTTP header (for non-HTML or site-wide rules) -->
<!-- In Nginx: -->
<!-- add_header X-Robots-Tag "noindex, nofollow"; -->
```

**When to use noindex**:
- Internal search result pages
- Admin/login/dashboard pages
- Thank-you and confirmation pages
- Paginated filter/sort URLs with no unique content
- Staging/preview environments
- Thin content pages (tag archives with <3 posts)

**When NOT to use noindex**:
- Pages with valuable content — even thin pages can rank for long-tail queries
- Pages that receive backlinks — preserving link equity matters

**Rules**:
- **Do not block noindexed pages in `robots.txt`** — the crawler must access the page to read the noindex tag.
- **Use `noindex, follow`** when the page should not rank but its outbound links should still be crawled.
- **Use `X-Robots-Tag` header** for non-HTML resources (PDFs, images) or for site-wide rules.

**Risks**:
- Noindex accidentally applied to important pages — silently drops organic traffic
- Blocking crawl access AND using noindex — crawler cannot read the tag, so it may index anyway
- Not auditing noindex tags periodically — pages may stay noindexed long after they should be indexed

---

### 3. Hreflang for Multilingual Sites

**Purpose**: Tell search engines which language/regional version of a page to serve to users based on their locale.

**Priority**: Medium | **Effort**: 3h

**Implementation**:

```html
<head>
  <!-- Bidirectional hreflang declarations (every variant must reference every other variant) -->
  <link rel="alternate" hreflang="en" href="https://example.com/products/widget">
  <link rel="alternate" hreflang="es" href="https://example.com/es/productos/widget">
  <link rel="alternate" hreflang="fr" href="https://example.com/fr/produits/widget">
  <link rel="alternate" hreflang="de" href="https://example.com/de/produkte/widget">
  <link rel="alternate" hreflang="x-default" href="https://example.com/products/widget">
</head>
```

```xml
<!-- Alternative: in sitemap.xml -->
<url>
  <loc>https://example.com/products/widget</loc>
  <xhtml:link rel="alternate" hreflang="en" href="https://example.com/products/widget"/>
  <xhtml:link rel="alternate" hreflang="es" href="https://example.com/es/productos/widget"/>
  <xhtml:link rel="alternate" hreflang="fr" href="https://example.com/fr/produits/widget"/>
  <xhtml:link rel="alternate" hreflang="x-default" href="https://example.com/products/widget"/>
</url>
```

**Rules**:
- **Hreflang is bidirectional** — page A must reference page B AND page B must reference page A.
- **Include `x-default`** — fallback for users whose locale does not match any variant.
- **Use ISO 639-1 language codes** — `en`, `es`, `fr`, `de`.
- **Use ISO 3166-1 Alpha 2 for regions** — `en-US`, `en-GB`, `es-MX`.
- **All hreflang URLs must be canonical** and return 200 status.
- **Each page must reference itself** in the hreflang set.

**Risks**:
- Non-bidirectional hreflang — Google ignores one-directional declarations
- Missing `x-default` — no fallback for unmatched locales
- Hreflang pointing to non-canonical URLs — invalidates the annotation
- Using wrong language codes — `uk` is Ukrainian, not United Kingdom (use `en-GB`)
- Not including self-reference — each page must link to itself

---

### 4. Sitemap.xml

**Purpose**: Provide search engines with a complete list of crawlable URLs, their priority, and change frequency.

**Priority**: High | **Effort**: 1h

**Implementation**:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

  <url>
    <loc>https://example.com/</loc>
    <lastmod>2026-04-01</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

  <url>
    <loc>https://example.com/products/blue-widget</loc>
    <lastmod>2026-03-28</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
    <image:image>
      <image:loc>https://example.com/images/blue-widget.webp</image:loc>
      <image:title>Blue Widget Product Photo</image:title>
    </image:image>
  </url>
</urlset>
```

```xml
<!-- Sitemap index for large sites (>50,000 URLs) -->
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>https://example.com/sitemaps/pages.xml</loc>
    <lastmod>2026-04-01</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://example.com/sitemaps/products.xml</loc>
    <lastmod>2026-04-01</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://example.com/sitemaps/blog.xml</loc>
    <lastmod>2026-04-01</lastmod>
  </sitemap>
</sitemapindex>
```

**Rules**:
- **Maximum 50,000 URLs per sitemap** — use a sitemap index for larger sites.
- **Maximum 50MB uncompressed** per sitemap file.
- **Only include canonical, indexable URLs** — no noindex, redirect, or 404 pages.
- **Set accurate `lastmod` dates** — do not auto-update to current date on every build.
- **Reference in `robots.txt`**: `Sitemap: https://example.com/sitemap.xml`
- **Submit to Google Search Console** for monitoring.
- **Auto-generate from CMS or build pipeline** — manual maintenance is unsustainable.

**Risks**:
- Including noindex or redirected URLs — wastes crawl budget
- Stale `lastmod` dates — Google may deprioritize the sitemap
- Not referencing sitemap in robots.txt — crawler may not find it
- Exceeding size limits — sitemap is partially ignored

---

### 5. Robots.txt

**Purpose**: Control which areas of the site search engine crawlers can access. Manages crawl budget.

**Priority**: High | **Effort**: 0.5h

**Implementation**:

```
# /robots.txt
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /api/
Disallow: /cart/
Disallow: /checkout/
Disallow: /search?
Disallow: /tmp/
Disallow: /*?sort=
Disallow: /*?filter=

# Block specific crawlers from AI training
User-agent: GPTBot
Disallow: /

User-agent: CCBot
Disallow: /

# Sitemap reference
Sitemap: https://example.com/sitemap.xml
```

**Rules**:
- **Place at site root** — `https://example.com/robots.txt`.
- **`robots.txt` is advisory** — it prevents crawling, not indexing. If a page is linked externally, it can still appear in search results (without a snippet).
- **Use `Disallow` for pages that waste crawl budget** — admin, API, search results, duplicate parameter URLs.
- **Never block CSS/JS resources** — Google needs them to render pages.
- **Do not use `robots.txt` to hide sensitive content** — use authentication or server-side access control.

**Risks**:
- Blocking CSS/JS — Google cannot render the page, may derank it
- Using `robots.txt` to prevent indexing — does not work, use `noindex` meta tag instead
- Blocking the entire site accidentally with `Disallow: /` for all user-agents
- Not including `Sitemap:` directive — missed discovery opportunity

---

### 6. Clean URL Structure

**Purpose**: Use human-readable, keyword-rich URLs that search engines and users can understand.

**Priority**: High | **Effort**: 2h

**Implementation**:

```
# GOOD — clean, descriptive, hierarchical
https://example.com/products/outdoor-furniture/teak-garden-bench
https://example.com/blog/2026/container-gardening-guide
https://example.com/docs/api/authentication

# BAD — unreadable, parameter-heavy
https://example.com/index.php?cat=12&id=847&ref=nav
https://example.com/products?category=outdoor+furniture&item=teak+garden+bench
https://example.com/p/847
```

**Rules**:
- **Use hyphens as word separators** — not underscores, spaces, or camelCase.
- **Lowercase only** — avoid mixed case, redirect if needed.
- **3-5 words maximum** in the path slug.
- **Include primary keyword** in the URL.
- **Flat hierarchy when possible** — `/category/item` is better than `/a/b/c/d/item`.
- **Trailing slash consistency** — pick one pattern, redirect the other with 301.
- **No file extensions** in URLs — `/about` not `/about.html`.
- **Handle query parameters** — use canonical tags to consolidate `?sort=`, `?filter=`, `?page=` variations.

**URL parameter handling**:

```html
<!-- Consolidate parameter variations with canonical -->
<!-- On: /products?sort=price&color=red -->
<link rel="canonical" href="https://example.com/products">

<!-- Or configure in Google Search Console URL Parameters tool -->
```

**Risks**:
- Changing URLs without 301 redirects — loses all accumulated link equity and rankings
- Extremely long URLs (>100 chars) — harder to share, may be truncated
- Session IDs or tracking params in URLs — creates infinite duplicates
- Using numeric IDs without descriptive slugs — `/p/847` gives no SEO signal

---

### 7. Internal Linking Strategy

**Purpose**: Distribute PageRank across the site and help search engines discover and understand page relationships.

**Priority**: High | **Effort**: 3h

**Implementation**:

```html
<!-- Contextual links in content -->
<p>
  For proper soil preparation, see our
  <a href="/guides/soil-preparation">complete soil preparation guide</a>.
  If you're working with raised beds, our
  <a href="/products/raised-bed-kits">raised bed kits</a> include everything you need.
</p>

<!-- Related articles section -->
<aside>
  <h2>Related Articles</h2>
  <ul>
    <li><a href="/blog/container-watering-schedule">Container Watering Schedule</a></li>
    <li><a href="/blog/best-fertilizers-2026">Best Fertilizers for 2026</a></li>
    <li><a href="/blog/pest-control-organic">Organic Pest Control Methods</a></li>
  </ul>
</aside>

<!-- Footer link structure -->
<footer>
  <nav aria-label="Footer navigation">
    <div>
      <h3>Products</h3>
      <ul>
        <li><a href="/products/containers">Containers</a></li>
        <li><a href="/products/soil">Soil & Compost</a></li>
        <li><a href="/products/tools">Tools</a></li>
      </ul>
    </div>
  </nav>
</footer>
```

**Rules**:
- **Use descriptive anchor text** — "soil preparation guide" not "click here" or "read more".
- **Link deep** — prioritize links to inner pages, not just the homepage.
- **Every important page should be reachable within 3 clicks** from the homepage.
- **Add contextual links in body content** — these carry more weight than navigation links.
- **Include related articles/products sections** on every content page.
- **Fix orphan pages** — every indexable page must have at least one internal link.
- **Create hub/pillar pages** that link to all content in a topic cluster.

**Risks**:
- Orphan pages — no internal links pointing to them, search engines may never discover them
- "Click here" anchor text — provides no context to search engines
- Excessive links per page (>100) — dilutes PageRank distribution
- Broken internal links — 404s waste crawl budget and harm UX

---

### 8. Breadcrumb Navigation

**Purpose**: Show page hierarchy, improve navigation, and enable breadcrumb rich results in SERPs.

**Priority**: Medium | **Effort**: 1.5h

**Implementation**:

```html
<!-- HTML breadcrumb with structured data -->
<nav aria-label="Breadcrumb">
  <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="/">
        <span itemprop="name">Home</span>
      </a>
      <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="/products">
        <span itemprop="name">Products</span>
      </a>
      <meta itemprop="position" content="2">
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <span itemprop="name">Teak Garden Bench</span>
      <meta itemprop="position" content="3">
    </li>
  </ol>
</nav>
```

```html
<!-- Or with JSON-LD (preferred) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://example.com/" },
    { "@type": "ListItem", "position": 2, "name": "Products", "item": "https://example.com/products" },
    { "@type": "ListItem", "position": 3, "name": "Teak Garden Bench" }
  ]
}
</script>
```

**Rules**:
- **Start with Home** as the first breadcrumb item.
- **Last item is the current page** — no link on the current page.
- **Use `aria-label="Breadcrumb"`** on the `<nav>` element.
- **Include BreadcrumbList structured data** — use JSON-LD for simplicity.
- **Match URL hierarchy** — breadcrumbs should reflect the URL path.

**Risks**:
- Breadcrumbs not matching actual URL structure — confuses users and crawlers
- Missing structured data — breadcrumbs do not appear in SERPs
- Linking the current page — last breadcrumb item should be text, not a link

---

### 9. Link Rel Attributes (nofollow, ugc, sponsored)

**Purpose**: Inform search engines about the nature of outbound links to prevent passing PageRank inappropriately.

**Priority**: Medium | **Effort**: 0.5h

**Implementation**:

```html
<!-- Standard followed link (default — no rel needed) -->
<a href="https://trusted-source.com/article">Trusted Source</a>

<!-- Nofollow — generic signal to not pass PageRank -->
<a href="https://example.com" rel="nofollow">Example</a>

<!-- UGC — user-generated content (comments, forum posts) -->
<a href="https://user-blog.com" rel="ugc">User's Blog</a>

<!-- Sponsored — paid or affiliate link -->
<a href="https://affiliate.com/product" rel="sponsored">Buy Now (Affiliate)</a>

<!-- Combined attributes -->
<a href="https://untrusted.com" rel="nofollow ugc">User Comment Link</a>

<!-- External links should open safely -->
<a href="https://external.com" target="_blank" rel="noopener noreferrer">External Site</a>
```

**When to use each**:

| Attribute | When to Use | Example |
|-----------|------------|---------|
| (none) | Trusted editorial links | Links to sources, references |
| `nofollow` | Links you do not endorse | Untrusted sites, login links |
| `ugc` | User-submitted content | Blog comments, forum posts |
| `sponsored` | Paid placements | Affiliate links, ads, sponsorships |
| `noopener` | All `target="_blank"` links | Security: prevents `window.opener` access |

**Rules**:
- **Always use `rel="noopener"` on `target="_blank"` links** — security requirement.
- **Use `rel="sponsored"` on paid/affiliate links** — Google requires disclosure.
- **Use `rel="ugc"` on user-generated content** — protects against link spam.
- **Do not nofollow internal links** — wastes your own PageRank.
- **Nofollow is a hint, not a directive** — Google may choose to follow or count it anyway.

**Risks**:
- Not marking sponsored links — violates Google guidelines, potential manual action
- Nofollowing internal links — wastes crawl budget and link equity
- Missing `noopener` on external target="_blank" — security vulnerability (tabnabbing)
- Nofollowing all outbound links — unnatural link profile, may flag the site

---

### 10. Duplicate Content Management

**Purpose**: Prevent multiple URLs from competing for the same keyword and diluting ranking signals.

**Priority**: High | **Effort**: 2h

**Implementation**:

```
# 1. Redirect duplicates with 301
# HTTP → HTTPS
server {
    listen 80;
    server_name example.com www.example.com;
    return 301 https://example.com$request_uri;
}

# www → non-www (or vice versa — pick one)
server {
    listen 443 ssl;
    server_name www.example.com;
    return 301 https://example.com$request_uri;
}

# Trailing slash consistency
location ~ ^(.+)/$ {
    return 301 $1;
}
```

```html
<!-- 2. Canonical tag for parameter variations -->
<!-- On: /products?sort=price&color=red -->
<link rel="canonical" href="https://example.com/products">

<!-- 3. Canonical for print/mobile/AMP versions -->
<!-- On: /article/seo-guide?format=print -->
<link rel="canonical" href="https://example.com/article/seo-guide">
```

**Common duplicate content sources**:

| Source | Solution |
|--------|----------|
| HTTP + HTTPS versions | 301 redirect HTTP → HTTPS |
| www + non-www | 301 redirect to preferred version |
| Trailing slash variations | 301 redirect to consistent format |
| Query parameter sorting/filtering | Canonical to base URL |
| Print/mobile versions | Canonical to main version |
| Paginated content | Self-referencing canonical per page |
| Syndicated content | Cross-domain canonical to original |
| Session IDs in URLs | Strip session IDs, use cookies |

**Risks**:
- Not choosing a preferred domain (www vs non-www) — splits authority between two domains
- Redirect chains (A → B → C) — each hop loses ~10% link equity, max 2 hops
- Soft 404s — pages that show "not found" content but return 200 status
- Not redirecting old URLs after URL structure changes — broken links, lost equity

---

### 11. Pagination

**Purpose**: Handle paginated content (blog listings, search results, product catalogs) without creating duplicate or thin content issues.

**Priority**: Medium | **Effort**: 1.5h

**Implementation**:

```html
<!-- Self-referencing canonical on each paginated page -->
<!-- On page 1: /blog -->
<link rel="canonical" href="https://example.com/blog">

<!-- On page 2: /blog?page=2 -->
<link rel="canonical" href="https://example.com/blog?page=2">

<!-- On page 3: /blog?page=3 -->
<link rel="canonical" href="https://example.com/blog?page=3">

<!-- Pagination navigation with accessible markup -->
<nav aria-label="Pagination">
  <ul>
    <li><a href="/blog" aria-label="Page 1">1</a></li>
    <li><a href="/blog?page=2" aria-current="page" aria-label="Page 2, current page">2</a></li>
    <li><a href="/blog?page=3" aria-label="Page 3">3</a></li>
    <li><a href="/blog?page=3" aria-label="Next page" rel="next">Next →</a></li>
  </ul>
</nav>
```

**Pagination strategies**:

| Strategy | When to use | SEO impact |
|----------|------------|------------|
| Self-referencing canonical per page | Default for paginated listings | Each page can rank independently |
| Load more / infinite scroll | User engagement priority | Must provide crawlable page links for Googlebot |
| View all page | Small collections (<100 items) | Canonical from pages to view-all; consolidates signals |

**Rules**:
- **Each paginated page gets its own self-referencing canonical** — do not canonical all pages to page 1.
- **`rel="prev"` and `rel="next"` are deprecated** by Google but still used by Bing — include them if easy.
- **Provide crawlable `<a>` links between pages** — infinite scroll must have fallback HTML links.
- **Do not noindex paginated pages** — they contain unique content (different items on each page).
- **Use consistent URL patterns** — `/blog?page=2` or `/blog/page/2`, not both.

**Risks**:
- Canonicalizing all paginated pages to page 1 — pages 2+ are deindexed, their content is invisible
- Infinite scroll without crawlable links — Googlebot cannot discover paginated content
- Noindexing paginated pages — content on those pages is never indexed
- Inconsistent pagination URLs — creates duplicate content
