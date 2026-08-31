@php
use App\Support\LocalizedRoute;

$pages = [
    [
        'baseName' => 'home',
        'parameters' => [],
        'lastMod' => $homeLastMod,
    ],
];

foreach ($serviceSlugs as $serviceSlug) {
    $pages[] = [
        'baseName' => 'service',
        'parameters' => ['service' => $serviceSlug],
        'lastMod' => $serviceLastMods[$serviceSlug] ?? false,
    ];
}

@endphp
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($pages as $page)
    @php($canonical = LocalizedRoute::route($page['baseName'], $page['parameters']))
    <url>
        <loc>{{ $canonical }}</loc>
        @if ($page['lastMod'])
        <lastmod>{{ date('Y-m-d', $page['lastMod']) }}</lastmod>
        @endif
    </url>
@endforeach
</urlset>
