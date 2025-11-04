<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

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
    public function index()
    {
        return Inertia::render('categories/Index',[
            'category' => Category::select(['id', 'title', 'description'])->get()
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
