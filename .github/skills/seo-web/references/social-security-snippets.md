# Social Metadata, Security, Snippets & Testing

## Table of Contents

- [1. Open Graph Meta Tags](#1-open-graph-meta-tags)
- [2. Twitter Cards](#2-twitter-cards)
- [3. HTTPS Enforcement](#3-https-enforcement)
- [4. Security Headers](#4-security-headers)
- [5. Featured Snippets Optimization](#5-featured-snippets-optimization)
- [6. FAQ Schema for Snippets](#6-faq-schema-for-snippets)
- [7. Google Search Console Setup](#7-google-search-console-setup)
- [8. Lighthouse and Performance Audits](#8-lighthouse-and-performance-audits)
- [9. Crawler Log Monitoring](#9-crawler-log-monitoring)
- [10. Automated SEO Testing](#10-automated-seo-testing)

---

### 1. Open Graph Meta Tags

**Purpose**: Control how pages appear when shared on Facebook, LinkedIn, WhatsApp, Slack, Discord, and other platforms using the Open Graph protocol.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<head>
  <!-- Required Open Graph tags -->
  <meta property="og:title" content="Complete Container Gardening Guide for Beginners">
  <meta property="og:description" content="Learn container gardening basics: choosing pots, soil types, watering, and fertilization for small spaces.">
  <meta property="og:image" content="https://example.com/images/garden-guide-og.jpg">
  <meta property="og:url" content="https://example.com/guides/container-gardening">
  <meta property="og:type" content="article">
  <meta property="og:site_name" content="GreenThumb">
  <meta property="og:locale" content="en_US">

  <!-- Article-specific tags -->
  <meta property="article:published_time" content="2026-03-15T08:00:00Z">
  <meta property="article:modified_time" content="2026-04-01T10:30:00Z">
  <meta property="article:author" content="https://example.com/authors/jane-smith">
  <meta property="article:section" content="Gardening">
  <meta property="article:tag" content="container gardening">

  <!-- Product-specific tags -->
  <meta property="og:type" content="product">
  <meta property="product:price:amount" content="29.99">
  <meta property="product:price:currency" content="USD">
</head>
```

**Image requirements**:
- **Minimum**: 1200 x 630 pixels (recommended), 600 x 315 minimum.
- **Aspect ratio**: 1.91:1 for large cards.
- **File size**: Under 8MB.
- **Format**: JPEG or PNG (not WebP — some platforms do not support it for OG images).
- **Use absolute URLs** — relative URLs are not supported.

**Common `og:type` values**:

| Type | When to use |
|------|------------|
| `website` | Homepage, general pages |
| `article` | Blog posts, news articles |
| `product` | Product pages |
| `profile` | Author/user pages |
| `video.other` | Video pages |
| `music.song` | Music tracks |

**Risks**:
- Missing `og:image` — platforms show a random image or blank placeholder
- Using WebP for OG images — Facebook and some platforms do not support it
- Relative URLs in OG tags — will not resolve correctly
- Not updating `og:image` when content changes — stale previews (use Facebook Sharing Debugger to flush cache)
- OG image too small — appears blurry or cropped

---

### 2. Twitter Cards

**Purpose**: Control how pages appear when shared on X (Twitter), using Twitter Card markup.

**Priority**: Medium | **Effort**: 0.5h

**Implementation**:

```html
<head>
  <!-- Summary card with large image (most common) -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@GreenThumbHQ">
  <meta name="twitter:creator" content="@janesmith">
  <meta name="twitter:title" content="Complete Container Gardening Guide">
  <meta name="twitter:description" content="Learn container gardening basics for small spaces.">
  <meta name="twitter:image" content="https://example.com/images/garden-guide-twitter.jpg">
  <meta name="twitter:image:alt" content="Photo of a container garden with herbs and vegetables">

  <!-- Player card (for video/audio) -->
  <meta name="twitter:card" content="player">
  <meta name="twitter:player" content="https://example.com/embed/video-id">
  <meta name="twitter:player:width" content="480">
  <meta name="twitter:player:height" content="270">
</head>
```

**Card types**:

| Card Type | Image | When to use |
|-----------|-------|------------|
| `summary` | 144x144 thumbnail | Default content pages |
| `summary_large_image` | Large banner | Articles, products, landing pages |
| `player` | Video embed | Video/audio content |
| `app` | App download | Mobile app pages |

**Rules**:
- **Twitter falls back to Open Graph tags** — if `twitter:*` tags are missing, OG tags are used.
- **Always include `twitter:image:alt`** — accessibility for image descriptions.
- **Validate with Twitter Card Validator** before launch.
- **Use `summary_large_image`** for most content — significantly higher engagement.

**Risks**:
- Missing both Twitter Card and OG tags — link preview shows raw URL only
- Card image too small for `summary_large_image` — falls back to tiny thumbnail
- Not setting `twitter:image:alt` — accessibility violation

---

### 3. HTTPS Enforcement

**Purpose**: Encrypt all traffic. HTTPS is a Google ranking signal and required for modern browser features (Service Workers, Geolocation, HTTP/2).

**Priority**: High | **Effort**: 1h

**Implementation**:

```nginx
# Redirect all HTTP to HTTPS
server {
    listen 80;
    server_name example.com www.example.com;
    return 301 https://example.com$request_uri;
}

server {
    listen 443 ssl http2;
    server_name example.com;

    ssl_certificate /etc/ssl/certs/example.com.pem;
    ssl_certificate_key /etc/ssl/private/example.com.key;

    # Modern TLS configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256;
    ssl_prefer_server_ciphers on;

    # HSTS (see Security Headers section)
    add_header Strict-Transport-Security "max-age=63072000; includeSubDomains; preload" always;
}
```

**Rules**:
- **Redirect all HTTP to HTTPS with 301** — not 302.
- **Use TLS 1.2 or 1.3 only** — disable TLS 1.0/1.1.
- **Enable HTTP/2** (or HTTP/3) — requires HTTPS, significantly improves performance.
- **Update all internal links and resources** to `https://`.
- **Update canonical URLs, sitemap, and hreflang** to use `https://`.
- **Auto-renew certificates** — expired certs break the site entirely.

**Risks**:
- Mixed content (HTTP resources on HTTPS page) — browser blocks insecure resources
- Expired SSL certificates — browsers show full-page security warning
- Not updating internal links to HTTPS — redirect chains, minor performance hit
- Not enabling HSTS — vulnerable to SSL stripping attacks

---

### 4. Security Headers

**Purpose**: Protect against common web attacks (XSS, clickjacking, MIME sniffing). Security improves trust signals.

**Priority**: Medium | **Effort**: 2h

**Implementation**:

```nginx
# Essential security headers
server {
    # Prevent clickjacking
    add_header X-Frame-Options "SAMEORIGIN" always;

    # Prevent MIME type sniffing
    add_header X-Content-Type-Options "nosniff" always;

    # Enable HSTS (HTTP Strict Transport Security)
    add_header Strict-Transport-Security "max-age=63072000; includeSubDomains; preload" always;

    # Referrer Policy — control what's sent in the Referer header
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Permissions Policy — restrict browser features
    add_header Permissions-Policy "camera=(), microphone=(), geolocation=(self), payment=(self)" always;

    # Content Security Policy (start with report-only to test)
    add_header Content-Security-Policy-Report-Only "
        default-src 'self';
        script-src 'self' https://cdn.example.com;
        style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;
        img-src 'self' data: https://images.example.com;
        font-src 'self' https://fonts.gstatic.com;
        connect-src 'self' https://api.example.com;
        frame-ancestors 'self';
        base-uri 'self';
        form-action 'self';
    " always;
}
```

**Header reference**:

| Header | Purpose | Recommended Value |
|--------|---------|------------------|
| `Strict-Transport-Security` | Force HTTPS for N seconds | `max-age=63072000; includeSubDomains; preload` |
| `X-Frame-Options` | Prevent clickjacking | `SAMEORIGIN` |
| `X-Content-Type-Options` | Prevent MIME sniffing | `nosniff` |
| `Referrer-Policy` | Control referer info | `strict-origin-when-cross-origin` |
| `Permissions-Policy` | Restrict browser APIs | Deny unused features |
| `Content-Security-Policy` | Prevent XSS, injection | Allow only trusted sources |

**Rules**:
- **Start CSP in report-only mode** — `Content-Security-Policy-Report-Only` — test before enforcing.
- **Set HSTS `max-age` to at least 1 year** (31536000 seconds).
- **Include `includeSubDomains`** in HSTS if all subdomains support HTTPS.
- **Use `frame-ancestors 'self'`** in CSP as a replacement for `X-Frame-Options`.

**Risks**:
- Enforcing CSP without testing — blocks legitimate scripts, breaks the site
- Missing HSTS — users can be downgraded from HTTPS to HTTP
- Not including `always` directive — headers not sent on error pages
- Too permissive Permissions-Policy — third-party scripts access device APIs

---

### 5. Featured Snippets Optimization

**Purpose**: Structure content to win position zero (featured snippet) in search results for targeted queries.

**Priority**: Medium | **Effort**: 2h

**Implementation**:

```html
<!-- Paragraph snippet (40-60 words answering a specific question) -->
<h2>What Is Container Gardening?</h2>
<p>
  Container gardening is the practice of growing plants exclusively in containers
  instead of planting them directly in the ground. It is ideal for small spaces
  like balconies, patios, and windowsills. Common containers include pots, raised
  beds, grow bags, and repurposed household items.
</p>

<!-- List snippet (ordered steps or unordered items) -->
<h2>How to Start a Container Garden</h2>
<ol>
  <li>Choose containers with drainage holes (minimum 12 inches deep)</li>
  <li>Select a high-quality potting mix (not garden soil)</li>
  <li>Pick plants suited to your light conditions (6+ hours for vegetables)</li>
  <li>Water when the top inch of soil feels dry</li>
  <li>Fertilize every 2-4 weeks during the growing season</li>
</ol>

<!-- Table snippet (comparison or data) -->
<h2>Container Sizes for Common Vegetables</h2>
<table>
  <thead>
    <tr>
      <th>Vegetable</th>
      <th>Minimum Container Size</th>
      <th>Depth Required</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>Tomatoes</td><td>5 gallons</td><td>12 inches</td></tr>
    <tr><td>Lettuce</td><td>2 gallons</td><td>6 inches</td></tr>
    <tr><td>Peppers</td><td>3 gallons</td><td>10 inches</td></tr>
    <tr><td>Herbs</td><td>1 gallon</td><td>6 inches</td></tr>
  </tbody>
</table>

<!-- Definition snippet -->
<h2>What Is Potting Mix?</h2>
<p><strong>Potting mix</strong> is a soilless growing medium specifically formulated for container plants. Unlike garden soil, it provides excellent drainage, aeration, and moisture retention through a blend of peat moss, perlite, and vermiculite.</p>
```

**Snippet type guidelines**:

| Snippet Type | Format | Optimal Length |
|-------------|--------|---------------|
| Paragraph | `<p>` after `<h2>` question | 40-60 words |
| List | `<ol>` or `<ul>` after `<h2>` | 4-8 items |
| Table | `<table>` after `<h2>` | 3-6 rows, 2-4 columns |
| Definition | Bold term + explanation | 30-50 words |

**Rules**:
- **Use question-format headings** — match how users search ("What is", "How to", "Why does").
- **Answer immediately after the heading** — first `<p>`, `<ol>`, or `<table>` after `<h2>`.
- **Keep answers concise** — Google prefers 40-60 word paragraph answers.
- **Use `<ol>` for process steps, `<ul>` for unordered lists** — Google renders them as is.
- **Include a comparison table** for "vs" or "comparison" queries.

**Risks**:
- Burying the answer deep in the content — Google cannot extract it for a snippet
- Answers that are too long or too short — 40-60 words is the sweet spot for paragraphs
- Not using proper HTML semantic elements — `<div>`s with text do not trigger snippets as easily
- Answering questions without preceding `<h2>` — harder for Google to pair Q&A

---

### 6. FAQ Schema for Snippets

**Purpose**: Add FAQ structured data to enable expandable FAQ rich results in SERPs.

**Priority**: Medium | **Effort**: 1h

**Implementation**:

```html
<!-- HTML for the FAQ section -->
<section>
  <h2>Frequently Asked Questions</h2>

  <details>
    <summary>How often should I water container plants?</summary>
    <p>Water container plants when the top inch of soil feels dry, typically every 1-3 days in summer and weekly in winter. Containers dry out faster than ground soil due to more surface area exposed to air.</p>
  </details>

  <details>
    <summary>Can I use garden soil in containers?</summary>
    <p>No. Garden soil compacts in containers, blocks drainage, and may contain pests or diseases. Always use a potting mix formulated for containers, which provides proper aeration and moisture retention.</p>
  </details>

  <details>
    <summary>What size container do I need for tomatoes?</summary>
    <p>Tomatoes need a minimum 5-gallon container that is at least 12 inches deep. Larger varieties like beefsteaks perform best in 10-15 gallon containers.</p>
  </details>
</section>

<!-- JSON-LD structured data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How often should I water container plants?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Water container plants when the top inch of soil feels dry, typically every 1-3 days in summer and weekly in winter. Containers dry out faster than ground soil due to more surface area exposed to air."
      }
    },
    {
      "@type": "Question",
      "name": "Can I use garden soil in containers?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "No. Garden soil compacts in containers, blocks drainage, and may contain pests or diseases. Always use a potting mix formulated for containers, which provides proper aeration and moisture retention."
      }
    },
    {
      "@type": "Question",
      "name": "What size container do I need for tomatoes?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tomatoes need a minimum 5-gallon container that is at least 12 inches deep. Larger varieties like beefsteaks perform best in 10-15 gallon containers."
      }
    }
  ]
}
</script>
```

**Rules**:
- **FAQ content must be visible on the page** — do not hide FAQs in JSON-LD only.
- **Use `<details>`/`<summary>` for collapsible FAQ UI** — good UX and accessible.
- **3-10 questions per page** — Google may not display more than 3-4 in results.
- **Answers can contain HTML** within the JSON-LD `text` field (links, lists).
- **FAQ schema is for publisher-authored Q&A only** — not user-submitted (use QAPage for that).

**Risks**:
- FAQ content not on the page — Google requires visible matching content
- Using FAQ schema for user-submitted questions — use QAPage instead
- Too many FAQs — Google limits display to a few, and may ignore the schema entirely
- Duplicate FAQ content across multiple pages — use FAQ schema on the most relevant page only

---

### 7. Google Search Console Setup

**Purpose**: Monitor search performance, indexing status, errors, and submit content for crawling.

**Priority**: High | **Effort**: 1h

**Implementation**:

```html
<!-- Verification via meta tag -->
<meta name="google-site-verification" content="YOUR_VERIFICATION_TOKEN">

<!-- OR verification via DNS TXT record (preferred — no HTML changes needed) -->
<!-- Add TXT record: google-site-verification=YOUR_TOKEN -->
```

**Essential GSC tasks**:

| Task | Frequency | Purpose |
|------|-----------|---------|
| Submit sitemap | Once + on updates | Ensure all pages are discoverable |
| Check Coverage report | Weekly | Find indexing errors (404, redirect, noindex) |
| Monitor Core Web Vitals | Weekly | Track LCP, INP, CLS regressions |
| Review Manual Actions | Monthly | Check for penalties |
| Inspect URLs | As needed | Debug specific page indexing |
| Check Mobile Usability | Monthly | Find mobile rendering issues |
| Monitor crawl stats | Monthly | Detect crawl budget issues |
| Review Search Performance | Weekly | Track impressions, clicks, CTR, position |

**Rules**:
- **Verify both www and non-www properties** — or use domain-level verification.
- **Submit sitemap immediately after verification**.
- **Set up email alerts** for critical issues (manual actions, significant crawl errors).
- **Use URL Inspection tool** to debug individual page indexing.
- **Export performance data monthly** for trend analysis.

**Risks**:
- Not setting up GSC — flying blind on indexing and search performance
- Ignoring coverage errors — 404s and redirect loops accumulate
- Not monitoring Core Web Vitals — performance regressions go unnoticed
- Not using URL Inspection after deploying changes — delayed discovery of issues

---

### 8. Lighthouse and Performance Audits

**Purpose**: Automated auditing of performance, accessibility, SEO, and best practices.

**Priority**: High | **Effort**: 1h per audit

**Implementation**:

```bash
# CLI Lighthouse audit
npx lighthouse https://example.com \
  --output=html \
  --output-path=./lighthouse-report.html \
  --chrome-flags="--headless" \
  --preset=desktop

# Performance-focused audit
npx lighthouse https://example.com \
  --only-categories=performance,seo,accessibility \
  --output=json \
  --output-path=./audit.json

# CI integration (GitHub Actions example)
# - name: Lighthouse CI
#   uses: treosh/lighthouse-ci-action@v12
#   with:
#     urls: |
#       https://example.com/
#       https://example.com/products
#     budgetPath: ./lighthouse-budget.json
```

```json
// lighthouse-budget.json — performance budgets
[
  {
    "path": "/*",
    "timings": [
      { "metric": "largest-contentful-paint", "budget": 2500 },
      { "metric": "cumulative-layout-shift", "budget": 0.1 },
      { "metric": "interactive", "budget": 3500 }
    ],
    "resourceSizes": [
      { "resourceType": "script", "budget": 150 },
      { "resourceType": "image", "budget": 300 },
      { "resourceType": "total", "budget": 500 }
    ]
  }
]
```

**Target scores**:

| Category | Minimum | Target |
|----------|---------|--------|
| Performance | 80 | 90+ |
| Accessibility | 90 | 100 |
| SEO | 90 | 100 |
| Best Practices | 90 | 100 |

**Rules**:
- **Run Lighthouse on key pages** — homepage, product pages, blog posts, landing pages.
- **Test both mobile and desktop** — use `--preset=desktop` for desktop.
- **Set performance budgets in CI** — fail the build if scores drop below threshold.
- **Use WebPageTest for real-world conditions** — Lighthouse runs locally, may not reflect real users.
- **Test from multiple geographic locations** — latency varies significantly.

**Risks**:
- Testing only in local/development environment — production may have different performance
- Ignoring Lighthouse accessibility score — a11y issues affect SEO and legal compliance
- Not setting CI budgets — performance regressions ship silently
- Over-optimizing for Lighthouse score — synthetic scores may not reflect real user experience

---

### 9. Crawler Log Monitoring

**Purpose**: Analyze server logs to understand how search engine bots crawl the site and identify crawl inefficiencies.

**Priority**: Low | **Effort**: 3h

**Implementation**:

```nginx
# Nginx log format with bot detection
log_format seo_log '$remote_addr - $http_user_agent - [$time_local] '
                    '"$request" $status $body_bytes_sent '
                    '"$http_referer" rt=$request_time';

access_log /var/log/nginx/seo-access.log seo_log;
```

```bash
# Filter Googlebot requests
grep "Googlebot" /var/log/nginx/access.log | awk '{print $7}' | sort | uniq -c | sort -rn | head -20

# Find pages with high crawl frequency
grep "Googlebot" /var/log/nginx/access.log | awk '{print $7}' | sort | uniq -c | sort -rn > crawl-frequency.txt

# Find 404s hit by crawlers
grep "Googlebot" /var/log/nginx/access.log | grep " 404 " | awk '{print $7}' | sort | uniq -c | sort -rn

# Find slow responses to crawlers
grep "Googlebot" /var/log/nginx/access.log | awk -F'rt=' '{if($2>2.0) print $0}' | head -20
```

**Key crawler user-agents**:

| Bot | User-Agent Contains | Purpose |
|-----|-------------------|---------|
| Googlebot | `Googlebot` | Google Search |
| Googlebot Mobile | `Googlebot-Mobile` | Google mobile crawl |
| Bingbot | `bingbot` | Bing Search |
| Yandex | `YandexBot` | Yandex Search |
| GPTBot | `GPTBot` | OpenAI crawler |
| CCBot | `CCBot` | Common Crawl |

**Rules**:
- **Monitor crawl frequency trends** — sudden drops indicate crawl budget issues.
- **Identify wasted crawl budget** — bots crawling noindex, redirect, or parameter URLs.
- **Track response times for bots** — slow TTFB reduces crawl budget.
- **Watch for 5xx errors on bot requests** — server issues hurt indexing.

**Risks**:
- Not monitoring crawler behavior — unable to diagnose indexing issues
- High error rates for crawlers — bots reduce crawl frequency
- Crawlers spending budget on parameter URLs — wastes crawl capacity

---

### 10. Automated SEO Testing

**Purpose**: Catch SEO regressions before they reach production through automated testing in CI/CD pipeline.

**Priority**: Medium | **Effort**: 4h

**Implementation**:

```javascript
// Example: Playwright-based SEO tests
import { test, expect } from '@playwright/test';

test.describe('SEO fundamentals', () => {
  test('homepage has required meta tags', async ({ page }) => {
    await page.goto('/');

    // Title exists and is within length
    const title = await page.title();
    expect(title.length).toBeGreaterThan(10);
    expect(title.length).toBeLessThanOrEqual(60);

    // Meta description exists and is within length
    const metaDesc = await page.getAttribute('meta[name="description"]', 'content');
    expect(metaDesc).toBeTruthy();
    expect(metaDesc.length).toBeGreaterThan(50);
    expect(metaDesc.length).toBeLessThanOrEqual(160);

    // Canonical URL exists
    const canonical = await page.getAttribute('link[rel="canonical"]', 'href');
    expect(canonical).toBeTruthy();
    expect(canonical).toContain('https://');

    // Only one H1
    const h1Count = await page.locator('h1').count();
    expect(h1Count).toBe(1);

    // Open Graph tags
    const ogTitle = await page.getAttribute('meta[property="og:title"]', 'content');
    expect(ogTitle).toBeTruthy();
    const ogImage = await page.getAttribute('meta[property="og:image"]', 'content');
    expect(ogImage).toBeTruthy();

    // Viewport meta tag
    const viewport = await page.getAttribute('meta[name="viewport"]', 'content');
    expect(viewport).toContain('width=device-width');
  });

  test('all images have alt attributes', async ({ page }) => {
    await page.goto('/');
    const images = await page.locator('img').all();
    for (const img of images) {
      const alt = await img.getAttribute('alt');
      expect(alt).not.toBeNull(); // alt="" is OK for decorative images
    }
  });

  test('no broken internal links', async ({ page }) => {
    await page.goto('/');
    const links = await page.locator('a[href^="/"]').all();
    for (const link of links) {
      const href = await link.getAttribute('href');
      const response = await page.request.get(href);
      expect(response.status()).toBeLessThan(400);
    }
  });

  test('structured data is valid JSON-LD', async ({ page }) => {
    await page.goto('/');
    const scripts = await page.locator('script[type="application/ld+json"]').allTextContents();
    for (const script of scripts) {
      expect(() => JSON.parse(script)).not.toThrow();
      const data = JSON.parse(script);
      expect(data['@context']).toBe('https://schema.org');
      expect(data['@type']).toBeTruthy();
    }
  });
});
```

**Test checklist for CI**:

| Test | What to check |
|------|--------------|
| Meta tags | Title (10-60 chars), description (50-160 chars), viewport |
| Canonical | Exists, absolute URL, HTTPS, 200 status |
| Headings | Single H1, no skipped levels |
| Images | All have `alt`, have `width`/`height` |
| Links | No broken internal links (no 404s) |
| Structured data | Valid JSON-LD, has `@context` and `@type` |
| Robots | No accidental `noindex` on key pages |
| HTTPS | All resources load over HTTPS (no mixed content) |
| Open Graph | `og:title`, `og:image`, `og:description` present |
| Performance | LCP < 2.5s, CLS < 0.1, INP < 200ms (Lighthouse CI) |

**Risks**:
- No automated SEO tests — regressions ship to production undetected
- Tests only check homepage — need coverage on key page templates
- Not testing in CI — manual testing is forgotten or skipped
- Tests too brittle — break on content changes rather than structural issues
