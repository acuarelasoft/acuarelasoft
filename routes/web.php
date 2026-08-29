<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

$landingPage = static fn () => view('landing');
$serviceDefinitions = config('site_services');

$servicePage = static function (string $service) use ($serviceDefinitions) {
    $serviceDefinition = collect($serviceDefinitions)->firstWhere('slug', $service);
    abort_if(! $serviceDefinition, 404);

    return view('pages.services.show', ['service' => $serviceDefinition]);
};

$intakePage = static fn () => view('pages.intake');

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

    return response()
        ->view('sitemap', ['serviceSlugs' => $serviceSlugs])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/', $landingPage)->name('home');
Route::get('/servicios/{service}', $servicePage)->name('service');
Route::get('/modulos', $intakePage)->name('intake');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
