@php
use App\Support\LocalizedRoute;

$pages = [
    [
        'baseName' => 'home',
        'parameters' => [],
    ],
    [
        'baseName' => 'intake',
        'parameters' => [],
    ],
];

foreach ($serviceSlugs as $serviceSlug) {
    $pages[] = [
        'baseName' => 'service',
        'parameters' => ['service' => $serviceSlug],
    ];
}

@endphp
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($pages as $page)
    @foreach (LocalizedRoute::SUPPORTED_LOCALES as $locale)
        @php($canonical = LocalizedRoute::route($page['baseName'], $page['parameters'], $locale))
        @php($alternates = LocalizedRoute::alternates($page['baseName'], $page['parameters']))
        <url>
            <loc>{{ $canonical }}</loc>
            @foreach ($alternates as $hreflang => $href)
                <xhtml:link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $href }}" />
            @endforeach
        </url>
    @endforeach
@endforeach
</urlset>
