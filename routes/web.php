<?php

use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'tr'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);
    app()->setLocale($locale);

    return redirect()->back();
})->name('locale.switch');

Route::view('/', 'welcome')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('documents', [App\Http\Controllers\Doc\DocController::class, 'index'])
    ->name('documents');
Route::get('documents/{slug}', [App\Http\Controllers\Doc\DocController::class, 'show'])
    ->name('documents.show');

require __DIR__ . '/auth.php';
