<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Inertia\Inertia;
use App\Models\Category;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:publisher', only: ['index']),
            new Middleware('permission:create categories', only: ['create', 'store']),
            new Middleware('permission:edit categories', only: ['show', 'edit', 'update']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::select(['id', 'title', 'description']);

        if ($request->has('search') && !empty(trim($request->get('search')))) {
            $search = trim($request->get('search'));
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $categories = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        return Inertia::render('categories/Index',[
            'categories' => $categories,
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
        return Inertia::render('categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|min:5|max:128',
            'description' => 'required|string|min:8|max:256'
        ]);

        Category::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
        ]);

        return redirect()->route('category.index')->with('message', 'Category has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('articles');

        return Inertia::render('categories/Show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('categories/Edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'title' => 'required|string|min:5|max:128',
            'description' => 'required|string|min:8|max:256'
        ]);

        $category->update([
            'title' => $validate['title'],
            'description' => $validate['description'],
        ]);

        $category->save();

        return redirect()->route('category.index')->with('message', 'Category has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        $validate = $request->validate(['name' => 'required|string',]);
        if($validate['name'] != $category->title) {
            return back()->withErrors(['name' => 'Confirmation does not match the category title.']);
        }

        $category->delete();

        return redirect()->route('category.index')->with('message', 'Category has been deleted.');
    }
}
