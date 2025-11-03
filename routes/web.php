<?php

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