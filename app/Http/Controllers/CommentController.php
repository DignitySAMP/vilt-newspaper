<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'article_id' => 'required|int|exists:articles,id',
            'content' => 'required|string|min:4|max:4096'
        ]);

        $comment = Comment::create([
            'article_id' => $validate['article_id'],
            'user_id' => Auth::user()->id,
            'content' => $validate['content']
        ]);

        return redirect()->back()->with('message', 'You have posted a comment.');;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validate = $request->validate([
            'content' => 'required|string|min:4|max:4096'
        ]);

        if($comment->user_id === Auth::user()->id) {
            $comment->update([
                'content' => $validate['content']
            ]);

            return redirect()->back()->with('message', 'You have updated your comment.');;
        }

        return redirect()->back()->withErrors(['content' => "You don't own this comment!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id === Auth::user()->id) {
            $comment->delete();

            return redirect()->back()->with('message', 'You have deleted your comment.');;
        }
        return redirect()->back()->withErrors(['content' => "You don't own this comment!"]);
    }
}
