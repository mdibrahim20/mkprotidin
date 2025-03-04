<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::with(['articles' => function ($query) {
            $query->latest()->limit(5);
        }])->get();

        // Fetch latest articles for news ticker
        $latestArticles = Article::latest()->limit(20)->get(['id', 'title']);

        return view('index', compact('categories', 'latestArticles'));
    }

    public function category($id)
    {
        $category = Category::with('articles')->findOrFail($id);

        return view('category', compact('category'));
    }

    public function show($id)
    {
        // Fetch category
        $category = Category::findOrFail($id);

        // Fetch articles belonging to the category
        $articles = Article::where('category_id', $id)->latest()->paginate(9);

        return view('category_page', compact('category', 'articles'));
    }
}
