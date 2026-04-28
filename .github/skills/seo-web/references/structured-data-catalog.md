# Structured Data Catalog

## Table of Contents

- [Usage Workflow](#usage-workflow)
- [Google-Supported Structured Data](#google-supported-structured-data)
- [Extended Schema.org Types](#extended-schemaorg-types)
  - [Creative Works](#creative-works)
  - [Commerce & Offers](#commerce--offers)
  - [People & Organizations](#people--organizations)
  - [Places & Local](#places--local)
  - [Media Objects](#media-objects)
  - [Actions](#actions)
  - [Medical & Health](#medical--health)
  - [Events & Scheduling](#events--scheduling)
  - [Web & Navigation](#web--navigation)
  - [Data & Measurements](#data--measurements)

## Usage Workflow

When adding structured data to a page:

1. **Identify the type** — Find the matching schema in the tables below.
2. **Fetch full property spec** — Use `fetch_webpage` with the Schema.org URL from the catalog to get the complete property list, required fields, and expected value types.
3. **Fetch Google implementation guide** (if available) — Use `fetch_webpage` with the Google Docs URL for Google-specific requirements, recommended properties, and rich result eligibility.
4. **Implement JSON-LD** — Build a `<script type="application/ld+json">` block with required and recommended properties.
5. **Validate** — Test with Google Rich Results Test or Schema.org Validator.

**Example fetch sequence for adding Product structured data:**

```
1. fetch_webpage("https://schema.org/Product")        → get all properties
2. fetch_webpage("https://developers.google.com/search/docs/appearance/structured-data/product") → get Google requirements
3. Implement JSON-LD with: @type, name, image, description, offers, aggregateRating, brand, sku, review
4. Validate at https://search.google.com/test/rich-results
```

**JSON-LD is the recommended format.** Google, Bing, and other major search engines prefer JSON-LD over Microdata HTML attributes or RDFa. Place the `<script>` in `<head>` or `<body>`.

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Example Product",
  "image": "https://example.com/photo.jpg",
  "description": "High-quality example product",
  "brand": { "@type": "Brand", "name": "ExampleBrand" },
  "offers": {
    "@type": "Offer",
    "price": "29.99",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock"
  }
}
</script>
```

---

## Google-Supported Structured Data

These types are recognized by Google Search and can generate rich results. Each has a dedicated Google documentation page.

| # | Type | Schema.org URL | Google Docs URL | Rich Result |
|---|------|---------------|-----------------|-------------|
| 1 | Article | https://schema.org/Article | https://developers.google.com/search/docs/appearance/structured-data/article | Top stories, headline text, thumbnail |
| 2 | Book | https://schema.org/Book | https://developers.google.com/search/docs/appearance/structured-data/book | Book actions, info panel |
| 3 | Breadcrumb | https://schema.org/BreadcrumbList | https://developers.google.com/search/docs/appearance/structured-data/breadcrumb | Breadcrumb trail in results |
| 4 | Carousel | https://schema.org/ItemList | https://developers.google.com/search/docs/appearance/structured-data/carousel | Sequential list/gallery from single site |
| 5 | Course List | https://schema.org/Course | https://developers.google.com/search/docs/appearance/structured-data/course | Course provider, title, description |
| 6 | Dataset | https://schema.org/Dataset | https://developers.google.com/search/docs/appearance/structured-data/dataset | Google Dataset Search |
| 7 | Discussion Forum | https://schema.org/DiscussionForumPosting | https://developers.google.com/search/docs/appearance/structured-data/discussion-forum | Forum thread rich result |
| 8 | Education Q&A | https://schema.org/Quiz | https://developers.google.com/search/docs/appearance/structured-data/education-qa | Flashcard carousel |
| 9 | Employer Aggregate Rating | https://schema.org/EmployerAggregateRating | https://developers.google.com/search/docs/appearance/structured-data/employer-rating | Star rating in job search |
| 10 | Event | https://schema.org/Event | https://developers.google.com/search/docs/appearance/structured-data/event | Event date, location, actions |
| 11 | FAQ | https://schema.org/FAQPage | https://developers.google.com/search/docs/appearance/structured-data/faqpage | Expandable Q&A in results |
| 12 | Fact Check | https://schema.org/ClaimReview | https://developers.google.com/search/docs/appearance/structured-data/factcheck | Fact check label |
| 13 | Image Metadata | https://schema.org/ImageObject | https://developers.google.com/search/docs/appearance/structured-data/image-license-metadata | Creator, license info on images |
| 14 | Job Posting | https://schema.org/JobPosting | https://developers.google.com/search/docs/appearance/structured-data/job-posting | Job search experience |
| 15 | Local Business | https://schema.org/LocalBusiness | https://developers.google.com/search/docs/appearance/structured-data/local-business | Knowledge panel, maps |
| 16 | Math Solver | https://schema.org/MathSolver | https://developers.google.com/search/docs/appearance/structured-data/math-solvers | Step-by-step math solutions |
| 17 | Movie | https://schema.org/Movie | https://developers.google.com/search/docs/appearance/structured-data/movie | Movie carousel |
| 18 | Organization | https://schema.org/Organization | https://developers.google.com/search/docs/appearance/structured-data/organization | Knowledge panel, logo |
| 19 | Product | https://schema.org/Product | https://developers.google.com/search/docs/appearance/structured-data/product | Price, availability, rating |
| 20 | Profile Page | https://schema.org/ProfilePage | https://developers.google.com/search/docs/appearance/structured-data/profile-page | Perspectives filter |
| 21 | Q&A | https://schema.org/QAPage | https://developers.google.com/search/docs/appearance/structured-data/qapage | Question and answer rich result |
| 22 | Recipe | https://schema.org/Recipe | https://developers.google.com/search/docs/appearance/structured-data/recipe | Recipe carousel, cook time |
| 23 | Review Snippet | https://schema.org/Review | https://developers.google.com/search/docs/appearance/structured-data/review-snippet | Star rating snippet |
| 24 | Software App | https://schema.org/SoftwareApplication | https://developers.google.com/search/docs/appearance/structured-data/software-app | App info, rating |
| 25 | Speakable | https://schema.org/SpeakableSpecification | https://developers.google.com/search/docs/appearance/structured-data/speakable | Google Assistant TTS |
| 26 | Subscription / Paywall | https://schema.org/CreativeWork | https://developers.google.com/search/docs/appearance/structured-data/paywalled-content | Paywall indicator |
| 27 | Vacation Rental | https://schema.org/LodgingBusiness | https://developers.google.com/search/docs/appearance/structured-data/vacation-rental | Rental listing |
| 28 | Video | https://schema.org/VideoObject | https://developers.google.com/search/docs/appearance/structured-data/video | Thumbnail, duration, live badge |

---

## Extended Schema.org Types

Common schema.org types beyond Google-supported rich results. Useful for general semantic enrichment, knowledge graphs, and search engine understanding.

### Creative Works

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 29 | CreativeWork | https://schema.org/CreativeWork | Base type for any creative output |
| 30 | WebPage | https://schema.org/WebPage | A single web page |
| 31 | WebSite | https://schema.org/WebSite | A complete website (enables sitelinks search box) |
| 32 | BlogPosting | https://schema.org/BlogPosting | A blog post entry |
| 33 | NewsArticle | https://schema.org/NewsArticle | A news article |
| 34 | TechArticle | https://schema.org/TechArticle | A technical article or tutorial |
| 35 | ScholarlyArticle | https://schema.org/ScholarlyArticle | Academic or research article |
| 36 | Report | https://schema.org/Report | A formal report document |
| 37 | HowTo | https://schema.org/HowTo | Step-by-step instructions |
| 38 | TVSeries | https://schema.org/TVSeries | A television series |
| 39 | MusicRecording | https://schema.org/MusicRecording | A single music track |
| 40 | MusicAlbum | https://schema.org/MusicAlbum | A music album |
| 41 | MusicPlaylist | https://schema.org/MusicPlaylist | A playlist of music tracks |
| 42 | Podcast | https://schema.org/PodcastSeries | A podcast series |
| 43 | PodcastEpisode | https://schema.org/PodcastEpisode | A single podcast episode |
| 44 | SoftwareSourceCode | https://schema.org/SoftwareSourceCode | Source code for software |
| 45 | DigitalDocument | https://schema.org/DigitalDocument | A digital document file |
| 46 | Menu | https://schema.org/Menu | A restaurant or service menu |
| 47 | Review | https://schema.org/Review | A review of an item |
| 48 | Claim | https://schema.org/Claim | A factual claim |
| 49 | Collection | https://schema.org/Collection | A collection of creative works |
| 50 | LearningResource | https://schema.org/LearningResource | Educational material |

### Commerce & Offers

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 51 | Offer | https://schema.org/Offer | A product offer with price/availability |
| 52 | AggregateOffer | https://schema.org/AggregateOffer | Summary of multiple product offers |
| 53 | AggregateRating | https://schema.org/AggregateRating | Average rating from multiple reviews |
| 54 | Brand | https://schema.org/Brand | A brand or trademark |
| 55 | Service | https://schema.org/Service | A service provided by an organization |
| 56 | FinancialProduct | https://schema.org/FinancialProduct | A financial product (loan, credit card) |
| 57 | Invoice | https://schema.org/Invoice | A bill or invoice |
| 58 | Order | https://schema.org/Order | A purchase order |
| 59 | ShippingDeliveryTime | https://schema.org/ShippingDeliveryTime | Delivery time expectations |
| 60 | OfferShippingDetails | https://schema.org/OfferShippingDetails | Shipping details for offers |
| 61 | MerchantReturnPolicy | https://schema.org/MerchantReturnPolicy | Return and refund policy |

### People & Organizations

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 62 | Person | https://schema.org/Person | An individual person |
| 63 | Organization | https://schema.org/Organization | Base organization type |
| 64 | Corporation | https://schema.org/Corporation | A corporation |
| 65 | EducationalOrganization | https://schema.org/EducationalOrganization | A school or university |
| 66 | GovernmentOrganization | https://schema.org/GovernmentOrganization | A government body |
| 67 | NGO | https://schema.org/NGO | A non-governmental organization |
| 68 | SportsTeam | https://schema.org/SportsTeam | A sports team |
| 69 | MusicGroup | https://schema.org/MusicGroup | A musical group or band |
| 70 | ContactPoint | https://schema.org/ContactPoint | Contact information for a person/org |

### Places & Local

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 71 | Place | https://schema.org/Place | A physical location |
| 72 | LocalBusiness | https://schema.org/LocalBusiness | A local business establishment |
| 73 | Restaurant | https://schema.org/Restaurant | A restaurant |
| 74 | Hotel | https://schema.org/Hotel | A hotel or lodging |
| 75 | PostalAddress | https://schema.org/PostalAddress | A mailing address |
| 76 | GeoCoordinates | https://schema.org/GeoCoordinates | Geographic coordinates (lat/lon) |
| 77 | OpeningHoursSpecification | https://schema.org/OpeningHoursSpecification | Business hours |
| 78 | TouristAttraction | https://schema.org/TouristAttraction | A tourist attraction |
| 79 | CivicStructure | https://schema.org/CivicStructure | Public buildings (library, hospital) |

### Media Objects

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 80 | ImageObject | https://schema.org/ImageObject | An image file with metadata |
| 81 | VideoObject | https://schema.org/VideoObject | A video file with metadata |
| 82 | AudioObject | https://schema.org/AudioObject | An audio file with metadata |
| 83 | MediaObject | https://schema.org/MediaObject | Base type for media content |
| 84 | 3DModel | https://schema.org/3DModel | A 3D model file |
| 85 | DataDownload | https://schema.org/DataDownload | A downloadable dataset file |

### Actions

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 86 | SearchAction | https://schema.org/SearchAction | Site search action (sitelinks searchbox) |
| 87 | ReadAction | https://schema.org/ReadAction | Reading content |
| 88 | ViewAction | https://schema.org/ViewAction | Viewing content |
| 89 | BuyAction | https://schema.org/BuyAction | Purchasing an item |
| 90 | SubscribeAction | https://schema.org/SubscribeAction | Subscribing to a service |
| 91 | WatchAction | https://schema.org/WatchAction | Watching video content |
| 92 | ListenAction | https://schema.org/ListenAction | Listening to audio content |
| 93 | OrderAction | https://schema.org/OrderAction | Placing an order |

### Medical & Health

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 94 | MedicalEntity | https://schema.org/MedicalEntity | Base type for medical concepts |
| 95 | MedicalCondition | https://schema.org/MedicalCondition | A medical condition or disease |
| 96 | Drug | https://schema.org/Drug | A pharmaceutical drug |
| 97 | MedicalProcedure | https://schema.org/MedicalProcedure | A medical procedure |
| 98 | MedicalOrganization | https://schema.org/MedicalOrganization | A hospital, clinic, or pharmacy |

### Events & Scheduling

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 99 | Event | https://schema.org/Event | Base event type |
| 100 | BusinessEvent | https://schema.org/BusinessEvent | A business event (conference) |
| 101 | SportsEvent | https://schema.org/SportsEvent | A sporting event |
| 102 | MusicEvent | https://schema.org/MusicEvent | A concert or music performance |
| 103 | ScreeningEvent | https://schema.org/ScreeningEvent | A film screening |
| 104 | Schedule | https://schema.org/Schedule | A recurring schedule |

### Web & Navigation

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 105 | BreadcrumbList | https://schema.org/BreadcrumbList | Navigation breadcrumb trail |
| 106 | ItemList | https://schema.org/ItemList | An ordered or unordered list of items |
| 107 | ListItem | https://schema.org/ListItem | A single item in a list |
| 108 | SiteNavigationElement | https://schema.org/SiteNavigationElement | Site navigation structure |
| 109 | WPHeader | https://schema.org/WPHeader | Page header section |
| 110 | WPFooter | https://schema.org/WPFooter | Page footer section |
| 111 | WPSideBar | https://schema.org/WPSideBar | Page sidebar section |
| 112 | Table | https://schema.org/Table | A data table |

### Data & Measurements

| # | Type | Schema.org URL | Description |
|---|------|---------------|-------------|
| 113 | PropertyValue | https://schema.org/PropertyValue | A name-value pair |
| 114 | QuantitativeValue | https://schema.org/QuantitativeValue | A numeric value with unit |
| 115 | MonetaryAmount | https://schema.org/MonetaryAmount | A monetary value |
| 116 | NutritionInformation | https://schema.org/NutritionInformation | Nutritional data (calories, etc.) |
| 117 | Rating | https://schema.org/Rating | A rating value |
| 118 | DefinedTerm | https://schema.org/DefinedTerm | A term from a controlled vocabulary |
| 119 | CategoryCode | https://schema.org/CategoryCode | A classification code |
| 120 | Intangible | https://schema.org/Intangible | Base type for non-physical things |
