<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request) {

        $query = Article::with(['author:id,name', 'category:id,title']);
        $query->select('articles.*'); 
        
        if ($request->has('category')) {
            $category = Category::where('title', $request->get('category'))->first(['id']);
        
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        if ($request->has('search') && !empty(trim($request->get('search')))) {
            $search = trim($request->get('search'));
        
            $query->where(function ($q) use ($search) {
                $q->where('content', 'like', "%{$search}%")
                ->orWhere('summary', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%");
            });
        }
       
        $articles = $query->orderByDesc('created_at')->paginate(10);
        
        return Inertia::render('home/Index', [
            'articles' => $articles,
            'search' => [
                'term' => $request->get('search'),
                'category' => $request->get('category')
            ]
        ]);
    }
}
