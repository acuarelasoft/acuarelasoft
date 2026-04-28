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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
