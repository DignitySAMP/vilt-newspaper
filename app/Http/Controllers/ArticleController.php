<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:writer', only: ['index']),
            new Middleware('permission:create articles', only: ['create', 'store']),
            new Middleware('permission:edit articles', only: ['edit', 'update']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()->latest()->with(['author', 'category'])->get();
        return Inertia::render('articles/Index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return Inertia::render('articles/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|min:5|max:128',
            'content' => 'required|string|min:32|max:2048',
            'summary' => 'required|string|min:8|max:150',
            'image' => 'required|string|min:8|max:150',
            'category' => 'required|integer|exists:categories,id'
        ]);

        $category = Category::findOrFail($validate['category']);

        Article::create([
            'user_id' => Auth::user()->id,
            'category_id' => $category->id,
            'title' => $validate['title'],
            'content' => $validate['content'],
            'summary' => $validate['summary'],
            'image' => $validate['image'],
        ]);

        return redirect()->route('article.index')->with('message', 'Article has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return Inertia::render('articles/Show', [
            'article' => $article->load(['author', 'category']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return Inertia::render('articles/Edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validate = $request->validate([
            'title' => 'required|string|min:5|max:128',
            'content' => 'required|string|min:32|max:2048',
            'summary' => 'required|string|min:8|max:150',
            'image' => 'required|string|min:8|max:150',
            'category' => 'required|integer|exists:categories,id',
        ]);

        $category = Category::findOrFail($validate['category']);

        $article->update([
            'title' => $validate['title'],
            'content' => $validate['content'],
            'summary' => $validate['summary'],
            'image' => $validate['image'],
            'category_id' => $category->id
        ]);

        $article->save();

        return redirect()->route('article.index')->with('message', 'Article has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Article $article)
    {
        $validate = $request->validate(['name' => 'required|string']);
        if($validate['name'] != $article->title) {
            return back()->withErrors(['name' => 'Confirmation does not match the article title.']);
        }

        $article->delete();

        return redirect()->route('article.index')->with('message', 'Article has been deleted.');
    }
}
