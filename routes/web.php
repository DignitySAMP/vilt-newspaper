<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function (Request $request): mixed {

    $query = Article::with(['author:id,name', 'category:id,title'])->select();

    if ($request->has('category')) {
        $category = Category::where('title', $request->get('category'))->first(['id']);

        if ($category) {
            $query->where('category_id', $category->id);
        }
    }

    $articles = $query->orderByDesc('created_at')->paginate(20);

    return Inertia::render('home/Index', [
        'articles' => $articles,
    ]);
})->name('home');



Route::get('/dashboard', function (): mixed {
    return Inertia::render('Welcome');
})->name('dashboard');


Route::get('/user/two-faction-setup', function() {

    return Inertia::render( 'auth/TwoFactorSetup', [
        'mfa_enabled' => Auth::user()->two_factor_confirmed_at !== null
    ]);
})->middleware(['auth', 'verified', 'password.confirm'])->name('two-factor.setup');

Route::resource('article', ArticleController::class)->except(['show'])->middleware(['auth', 'verified', 'password.confirm']);
Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');

Route::resource('category', CategoryController::class)->except(['show'])->middleware(['auth', 'verified', 'password.confirm']);
Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');