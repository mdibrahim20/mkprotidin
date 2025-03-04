<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        // Fetch all articles with pagination
        $tags = Tag::all();
        $categories = Category::all();
        $articles = Article::with('category')->paginate(10); // 10 articles per page
        return view('dashboard.article', compact('articles','categories','tags')); // Adjust the view accordingly
    }

    public function create()
    {
        // Show form to create a new article
        $categories = Category::all();
        return view('admin.articles.create', compact('categories')); // Adjust the view accordingly
    }

    // public function store(Request $request)
    // {
    //     // Convert string tags to an array if necessary
    //     if (!is_array($request->tags)) {
    //         $request->merge(['tags' => explode(',', $request->tags)]); // Convert CSV string to array
    //     }
    
    //     // Validate the request data
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'tags' => 'nullable|array', // Tags should be an array
    //         'tags.*' => 'nullable|exists:tags,id', // Each tag should exist in the tags table
    //         'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    //     ]);
    
    //     // Create a new article
    //     $article = new Article();
    //     $article->title = $request->title;
    //     $article->content = $request->content;
    //     $article->category_id = $request->category_id;
    //     $article->user_id = Auth::id(); // Authenticated user
    
    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         $article->image = $request->file('image')->store('articles', 'public');
    //     }
    
    //     $article->save(); // Save article first
    
    //     // Ensure tags are either valid or null
    //     $tags = !empty($request->tags) ? $request->tags : null;
    
    //     // Sync only if tags exist; otherwise, detach any existing tags
    //     if ($tags) {
    //         $article->tags()->sync($tags);
    //     } else {
    //         $article->tags()->detach(); // Ensure no tags are linked
    //     }
    
    //     return redirect()->route('admin.articles.index')->with('success', 'Article added successfully!');
    // }

    public function store(Request $request)
    {
        // Convert string tags to an array if necessary
        if (!is_array($request->tags)) {
            $request->merge(['tags' => explode(',', $request->tags)]); // Convert CSV string to array
        }
    
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:tags,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        // Create a new article
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->user_id = Auth::id();
    
        // Generate a unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
    
        // Check if slug exists and generate a new one if needed
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        $article->slug = $slug;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }
    
        $article->save(); // Save article first
    
        // Ensure tags are either valid or null
        $tags = !empty($request->tags) ? array_filter($request->tags) : null;
    
        // Sync only if tags exist; otherwise, detach any existing tags
        if (!empty($tags)) {
            $article->tags()->sync($tags);
        } else {
            $article->tags()->detach(); // Ensure no tags are linked
        }
    
        return redirect()->route('admin.articles.index')->with('success', 'Article added successfully!');
    }

    
    
    public function show($id)
    {
        // Fetch the article by ID
        $article = Article::with('category')->findOrFail($id);

        // Fetch latest articles for sidebar
        $latestArticles = Article::latest()->take(5)->get();

        // Fetch related articles based on category
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('article_details', compact('article', 'latestArticles', 'relatedArticles'));
    }


    public function destroy($id)
    {
        // Delete article
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }

    public function dashboard()
    {
        // Fetch article data, paginate, and pass to view
        $articles = Article::with('category')->paginate(10); // 10 articles per page
        $categories = Category::all();

        return view('dashboard.article', compact('articles', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array', // Tags should be an array of tag IDs
            'tags.*' => 'exists:tags,id', // Each tag should exist in the tags table
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        // Find the article by its ID
        $article = Article::findOrFail($id);
    
        // Update the article's basic data
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
    
        // If a new image is uploaded, store it and update the article's image
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Store the new image
            $article->image = $request->file('image')->store('articles', 'public');
        }
    
        // Save the updated article
        $article->save();
    
        // Sync the tags (if any) with the article
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }
    
        // Redirect back to the articles index with success message
        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(10);
    
        return view('search_results', compact('articles', 'query'));
    }
    



    

}
