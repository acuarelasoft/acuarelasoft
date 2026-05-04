<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

// Contact form
Route::post('/contact', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::get('/intake', function () {
    return view('pages.intake');
})->middleware('throttle:20,1')->name('intake');

Route::get('/intake/thanks', function () {
    return view('pages.intake-thanks');
})->name('intake.thanks');

// Service pages (Spanish)
Route::get('/services/{service}', function (string $slug) {
    $service = collect(config('site_services'))->firstWhere('slug', $slug);
    abort_if(! $service, 404);

    return view('pages.services.show', ['service' => $service]);
})->name('service');

Route::get('/{lang}', function (string $lang) {
    if (! in_array($lang, ['en', 'es'])) {
        abort(404);
    }

    session(['lang' => $lang]);

    return redirect()->route('home');
})->name('home.lang');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
