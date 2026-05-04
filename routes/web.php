<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Landing page (Spanish — default)
Route::get('/', function () {
    app()->setLocale('es');

    return view('landing');
})->name('home');

// Landing page (English)
Route::get('/en', function () {
    app()->setLocale('en');

    return view('landing');
})->name('home.en');

// Contact form
Route::post('/contacto', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::get('/intake', function () {
    app()->setLocale('es');

    return view('pages.intake');
})->middleware('throttle:20,1')->name('intake');

Route::get('/en/intake', function () {
    app()->setLocale('en');

    return view('pages.intake');
})->middleware('throttle:20,1')->name('intake.en');

Route::get('/intake/gracias', function () {
    app()->setLocale('es');

    return view('pages.intake-thanks');
})->name('intake.thanks');

Route::get('/en/intake/thanks', function () {
    app()->setLocale('en');

    return view('pages.intake-thanks');
})->name('intake.thanks.en');

// Service pages (Spanish)
Route::get('/servicios/{service}', function (string $slug) {
    app()->setLocale('es');
    $service = collect(config('site_services'))->firstWhere('slug', $slug);
    abort_if(! $service, 404);

    return view('pages.services.show', ['service' => $service]);
})->name('service');

// Service pages (English)
Route::get('/en/services/{service}', function (string $slug) {
    app()->setLocale('en');
    $service = collect(config('site_services'))->firstWhere('slug', $slug);
    abort_if(! $service, 404);

    return view('pages.services.show', ['service' => $service]);
})->name('service.en');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
