<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (): mixed {
    return Inertia::render('home/Index');
})->name('home');


Route::get('/dashboard', function (): mixed {
    return Inertia::render('Welcome');
})->name('dashboard');


Route::get('/user/two-faction-setup', function() {

    return Inertia::render( 'auth/TwoFactorSetup', [
        'mfa_enabled' => Auth::user()->two_factor_confirmed_at !== null
    ]);
})->middleware(['auth', 'verified', 'password.confirm'])->name('two-factor.setup');

Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::resource('article', ArticleController::class)->except(['show'])->middleware(['auth', 'verified', 'password.confirm']);

Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::resource('category', CategoryController::class)->except(['show'])->middleware(['auth', 'verified', 'password.confirm']);