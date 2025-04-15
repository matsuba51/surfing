<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommunityPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class CommentController extends Controller
{
    public function store(Request $request, CommunityPost $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('community.show', $post->id)->with('success', 'コメントを追加しました。');
    }

    public function edit(CommunityPost $post, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('comments.edit', compact('post', 'comment', 'layout'));
    }

    public function update(Request $request, CommunityPost $post, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update(['content' => $request->content]);

        return redirect()->route('community.show', $post->id)->with('success', 'コメントを更新しました。');
    }

    public function destroy(CommunityPost $post, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('community.show', $post->id)->with('success', 'コメントを削除しました。');
    }
}
