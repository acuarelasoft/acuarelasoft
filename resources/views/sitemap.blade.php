@php
use App\Support\LocalizedRoute;

$pages = [
    [
        'baseName' => 'home',
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
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($pages as $page)
    @php($canonical = LocalizedRoute::route($page['baseName'], $page['parameters']))
    <url>
        <loc>{{ $canonical }}</loc>
    </url>
@endforeach
</urlset>
