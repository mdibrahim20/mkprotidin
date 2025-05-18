<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function dashboard()
    {
        $tags = Tag::all();
        return view('dashboard.dashboard', [
            'totalArticles' => Article::count(),
            // 'activeUsers' => User::where('status', 'published')->count(),
            'totalCategories' => Category::count(),
            'recentArticles' => Article::latest()->take(5)->get(),
            'tags' => $tags,
            'totalViews'=>Article::sum('views'),
        ]);
    }

    public function analytics()
{
    $totalArticles = Article::count();
    $mostViewed = Article::orderBy('views', 'desc')->take(5)->get();

    return view('admin.analytics', compact('totalArticles', 'mostViewed'));
}

public function toggleStatus($id)
{
    $user = User::findOrFail($id);

    // Toggle status
    $user->status = $user->status === 'active' ? 'inactive' : 'active';
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully!');
}

    public function index()
    {
        $users = User::where('role', '!=', 'admin')->paginate(10); // Exclude admin from the list
        return view('dashboard.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,author,editor',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
    
        // Debugging Before Save
        // dd($user); // If this prints correctly, proceed
    
        $saved = $user->save(); // Try to save
    
        if (!$saved) {
            dd('Error saving user');
        }
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    

    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'role' => 'required|in:admin,author,editor',
            'password'=>'nullable|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Update only if provided
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }




}
