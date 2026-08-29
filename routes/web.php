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

    return response()
        ->view('sitemap', ['serviceSlugs' => $serviceSlugs])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
