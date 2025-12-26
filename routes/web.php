<?php

use Illuminate\Support\Facades\Route;

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
