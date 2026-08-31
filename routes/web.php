<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Contact form
Route::post('/contact', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::get('/robots.txt', function () {
    return response(file_get_contents(public_path('robots.txt')) ?: '', 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
})->name('robots');

Route::get('/sitemap.xml', function () {
    $serviceSlugs = collect(config('site_services'))
        ->pluck('slug')
        ->all();

    // Prefer the slug-specific static Folio view's mtime when it exists, else the wildcard view's.
    $lastModified = fn (string $path) => file_exists($path) ? filemtime($path) : false;

    $homeLastMod = $lastModified(resource_path('views/folio/index.blade.php'));

    $serviceLastMods = collect($serviceSlugs)->mapWithKeys(function (string $slug) use ($lastModified) {
        $mtime = $lastModified(resource_path("views/folio/servicios/{$slug}.blade.php"))
            ?: $lastModified(resource_path('views/folio/servicios/[service].blade.php'));

        return [$slug => $mtime];
    });

    return response()
        ->view('sitemap', [
            'serviceSlugs' => $serviceSlugs,
            'homeLastMod' => $homeLastMod,
            'serviceLastMods' => $serviceLastMods,
        ])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
