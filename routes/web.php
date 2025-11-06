<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified', 'password.confirm']], function () { 

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile/details', [ProfileController::class, 'edit_details'])->name('profile.details');
    Route::patch('/profile/password', [ProfileController::class, 'edit_password'])->name('profile.password');

    Route::group(['middleware' => ['role:publisher|writer|administrator']], function () { 
        
        Route::get('admin', function() {
            return Inertia::render('admin/Index');
        })->name('admin');
        
        Route::resource('article', ArticleController::class)->except(['show']);
        Route::resource('category', CategoryController::class);
        Route::resource('users', UserController::class)->except('show');
        Route::resource('comment', CommentController::class)->only('store', 'update', 'destroy');
    });
});

Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');
