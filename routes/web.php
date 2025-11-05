<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified', 'password.confirm']], function () { 
    
    Route::get('/user/two-faction-setup', function() {
        return Inertia::render( 'auth/TwoFactorSetup', [
            'mfa_enabled' => Auth::user()->two_factor_confirmed_at !== null
        ]);
    })->name('two-factor.setup');

    Route::group(['middleware' => ['role:publisher|writer|administrator']], function () { 
        
        Route::get('admin', function() {
            return Inertia::render('admin/Index');
        })->name('admin');
        
        Route::resource('article', ArticleController::class)->except(['show']);
        Route::resource('category', CategoryController::class);
        Route::resource('users', UserController::class)->except('show');
    });
});

Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');
