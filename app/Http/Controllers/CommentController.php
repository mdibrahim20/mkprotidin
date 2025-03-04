<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('article', 'user')->paginate(10); // Paginate results
        return view('dashboard.comments', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'Comment approved successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    public function store(Request $request, $articleId)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:500',
            'guest_name' => 'nullable|string|max:100',
            'guest_email' => 'nullable|email|max:255',
        ]);

        $comment = new Comment();
        $comment->article_id = $articleId;

        if (Auth::check()) {
            // User is logged in
            $comment->user_id = Auth::id();
        } else {
            // Guest user
            $request->validate([
                'guest_name' => 'required|string|max:100',
                'guest_email' => 'required|email|max:255',
            ]);

            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
        }

        $comment->comment = $request->comment;
        $comment->is_approved = false; // Admin approval required
        $comment->save();

        return redirect()->back()->with('success', 'Your comment is awaiting moderation.');
    }

}
