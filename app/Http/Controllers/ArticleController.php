<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Article;
use App\Models\Category;
use App\Models\Newsletter;

use Inertia\Inertia;

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
    public function index(Request $request)
    {
        $query = Article::with(['author:id,name', 'category:id,title']);

        if ($request->has('search') && !empty(trim($request->get('search')))) {
            $search = trim($request->get('search'));
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('summary', 'like', "%{$search}%");
        }

        $articles = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return Inertia::render('articles/Index', [
            'articles' => $articles,
            'search' => [
                'term' => $request->get('search'),
            ]
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
            'image' => 'required|file|image|max:1500',
            'category' => 'required|integer|exists:categories,id'
        ]);

        $category = Category::findOrFail($validate['category']);

        $article = Article::create([
            'user_id' => Auth::user()->id,
            'category_id' => $category->id,
            'title' => $validate['title'],
            'content' => $validate['content'],
            'summary' => $validate['summary'],
            'image' => null, // updated after successful storage
        ]);
    
        $extension = $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs(
            path: 'articles/' . $article->id,
            name: 'image.' . $extension,
            options: 'public'
        );
    
        $article->update(['image' => $imagePath]);

        $emailsSent = Newsletter::sendToAll(
            subject: $article->title,
            content: $article->summary,
            buttonText: 'Read more',
            buttonUrl: route('article.show', $article->id)
        );

        return redirect()->route('article.index')->with('message', "Article has been created. {$emailsSent} emails have been sent");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return Inertia::render('articles/Show', [
            'article' => $article->load(['author', 'category']),
            'comments' => $article->comment()->with('author')->orderBy('created_at', 'desc')->paginate(10)
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
            'image' => 'nullable|file|image|max:1500',
            'category' => 'required|integer|exists:categories,id',
        ]);

        $category = Category::findOrFail($validate['category']);

        // replace the image if a new one is provided
        if ($request->hasFile('image')) {

            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }


            $extension = $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs(
                path: 'articles/' . $article->id,
                name: 'image.' . $extension,
                options: 'public'
            );

            $article->update([
                'title' => $validate['title'],
                'content' => $validate['content'],
                'summary' => $validate['summary'],
                'image' => $imagePath,
                'category_id' => $category->id
            ]);
        } else {

            // just update the regular article if no image change is passed
            $article->update([
                'title' => $validate['title'],
                'content' => $validate['content'],
                'summary' => $validate['summary'],
                'category_id' => $category->id
            ]);
        }

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
        
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('article.index')->with('message', 'Article has been deleted.');
    }
}
