<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Fetch tags, categories, and articles
        $tags = Tag::all();
        $categories = Category::all();
        $articles = Article::with('category')->latest()->paginate(10); // 10 articles per page
    
        // Fetch pending articles if the user has approval rights (admin or editor)
        $pendingArticles = Gate::allows('approve-article') 
            ? Article::where('status', 'pending')->latest()->get() 
            : [];
    
        return view('dashboard.article', compact('articles', 'categories', 'tags', 'pendingArticles'));
    }

    public function getArticle($id)
    {
        $article = Article::with(['category', 'tags', 'user'])->latest()->findOrFail($id);
        
        // Ensure JSON response (not a view!)
        return response()->json([
            'title' => $article->title,
            'author' => $article->user->name,
            'category' => $article->category->name ?? 'Uncategorized',
            'content' => $article->content,
            'tags' => $article->tags->pluck('name')->toArray(),
        ]);
    }

    public function archive(Request $request)
    {
        // Fetch categories for filtering
        $categories = Category::all();

        // Get filtering parameters from the request
        $category_id = $request->input('category_id');
        $date = $request->input('date');

        // Query for published articles only
        $query = Article::where('status', 'published');

        // Filter by category if selected
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        // Filter by date if selected
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }

        // Paginate results for better performance
        $articles = $query->latest()->paginate(10);

        return view('article_archive', compact('articles', 'categories'));
    }

    public function create()
    {
        // Show form to create a new article
        $categories = Category::all();
        return view('admin.articles.create', compact('categories')); // Adjust the view accordingly
    }
    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);

        $article->status = ($article->status === 'published') ? 'inactive' : 'published';
        $article->save();

        return redirect()->back()->with('success', 'Article status updated successfully!');
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
    //         'tags' => 'nullable|array',
    //         'tags.*' => 'nullable|exists:tags,id',
    //         'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    //     ]);

    //     // Create a new article
    //     $article = new Article();
    //     $article->title = $request->title;
    //     $article->content = $request->content;
    //     $article->category_id = $request->category_id;
    //     $article->user_id = Auth::id();
    //     $article->status = 'pending';

    //     // Generate a unique slug
    //     $slug = Str::slug($request->title);
    //     $originalSlug = $slug;
    //     $count = 1;

    //     // Check if slug exists and generate a new one if needed
    //     while (Article::where('slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $count;
    //         $count++;
    //     }

    //     $article->slug = $slug;

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         $article->image = $request->file('image')->store('articles', 'public');
    //     }

    //     $article->save(); // Save article first

    //     // Ensure tags are either valid or null
    //     $tags = !empty($request->tags) ? array_filter($request->tags) : null;

    //     // Sync only if tags exist; otherwise, detach any existing tags
    //     if (!empty($tags)) {
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
    
        try {
            $article = new Article();
            $article->title = $request->title;
            $article->content = $request->content;
            $article->category_id = $request->category_id;
            $article->user_id = Auth::id();
    
            // Automatically set status based on role
            $user = Auth::user();
            $article->status = in_array($user->role, ['admin', 'editor']) ? 'published' : 'pending';
    
            // Generate a unique slug
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
    
            while (Article::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
    
            $article->slug = $slug;
    
            if ($request->hasFile('image')) {
                $article->image = $request->file('image')->store('articles', 'public');
            }
    
            $article->save();
    
            $tags = !empty($request->tags) ? array_filter($request->tags) : null;
    
            if (!empty($tags)) {
                $article->tags()->sync($tags);
            } else {
                $article->tags()->detach();
            }
    
            return redirect()->route('admin.articles.index')->with('success', 'Article added successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                Session::flash('error', 'Duplicate entry: The slug already exists!');
            } else {
                Session::flash('error', 'An unexpected error occurred!');
            }
            
            return redirect()->back();
        }
    }



    public function pending()
    {
        // Authorize for admin and editor
        if (!Gate::allows('approve-article')) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch pending articles
        $pendingArticles = Article::where('status', 'pending')->latest()->get();



        return view('admin.articles.pending', compact('articles'));
    }

    public function approve($id)
    {
        // Check if user can approve the article
        if (!Gate::allows('approve-article')) {
            abort(403, 'Unauthorized action.');
        }

        $article = Article::findOrFail($id);
        $article->update(['status' => 'published']);

        return redirect()->back()->with('success', 'Article approved successfully!');
    }


    public function deactivate($id)
    {
        // Check if user can deactivate the article
        if (!Gate::allows('approve-article')) {
            abort(403, 'Unauthorized action.');
        }

        $article = Article::findOrFail($id);
        $article->update(['status' => 'inactive']);

        return redirect()->back()->with('success', 'Article deactivated successfully!');
    }

    // public function show($id)
    // {
    //     // Fetch the article by ID
    //     $article = Article::with('category')->findOrFail($id);

    //     // Fetch latest articles for sidebar
    //     $latestArticles = Article::latest()->take(5)->get();

    //     // Fetch related articles based on category
    //     $relatedArticles = Article::where('category_id', $article->category_id)
    //         ->where('id', '!=', $id)
    //         ->latest()
    //         ->take(3)
    //         ->get();

    //     return view('article_details', compact('article', 'latestArticles', 'relatedArticles'));
    // }

    public function show($id)
    {
        // Fetch the article by ID
        $article = Article::with('category')->findOrFail($id);

        // Check if the user has already visited this article in the current session
        $articleKey = 'article_' . $id;

        if (!Session::has($articleKey)) {
            // Increment the view count by 10 for a unique visit
            $article->increment('views', 10);

            // Mark as visited in the session
            Session::put($articleKey, true);
        }

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
        $article = Article::findOrFail($id);

        // Ensure only admin or author can delete
        if (Auth::id() !== $article->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $article->tags()->detach(); // Remove associated tags
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


        try {
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
        } catch (QueryException $e) {
            // Check if the error is due to duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Data already exists!');
            }

            return redirect()->back()->with('error', 'An unexpected error occurred!');
        }
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
