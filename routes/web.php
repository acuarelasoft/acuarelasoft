<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

$landingPage = static fn () => view('landing');

$servicePage = static function (string $service) {
    $serviceDefinition = collect(config('site_services'))->firstWhere('slug', $service);
    abort_if(! $serviceDefinition, 404);

    return view('pages.services.show', ['service' => $serviceDefinition]);
};

$intakePage = static fn () => view('pages.intake');

$intakeThanksPage = static fn () => view('pages.intake-thanks');

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
Route::get('/requerimientos', $intakePage)->middleware('throttle:20,1')->name('intake');
Route::get('/requerimientos/gracias', $intakeThanksPage)->name('intake.thanks');

Route::prefix('en')->name('en.')->group(function () use ($landingPage, $servicePage, $intakePage, $intakeThanksPage) {
    Route::get('/', $landingPage)->name('home');
    Route::get('/services/{service}', $servicePage)->name('service');
    Route::get('/intake', $intakePage)->middleware('throttle:20,1')->name('intake');
    Route::get('/intake/thanks', $intakeThanksPage)->name('intake.thanks');
});

Route::get('/es', static fn () => redirect()->route('home', [], 301))->name('es.home');
Route::get('/services/{service}', static fn (string $service) => redirect()->route('service', ['service' => $service], 301));
Route::get('/intake', static fn () => redirect()->route('intake', [], 301));
Route::get('/intake/thanks', static fn () => redirect()->route('intake.thanks', [], 301));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
