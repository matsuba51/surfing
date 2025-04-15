<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityPost;
use Jenssegers\Agent\Agent;

class CommunityController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $posts = CommunityPost::select('id', 'title', 'content', 'user_id', 'created_at')->paginate(5);

        return view('community.index', compact('posts', 'layout'));
    }

    public function show($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $post = CommunityPost::with('comments.user')->findOrFail($id);

        return view('community.show', compact('post', 'layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:500',
        ]);

        CommunityPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('community.index')->with('success', '投稿が完了しました');
    }

    public function edit($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $post = CommunityPost::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->route('community.index')->with('error', '編集権限がありません');
        }

        return view('community.edit', compact('post', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $post = CommunityPost::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->route('community.index')->with('error', '編集権限がありません');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:500',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('community.index')->with('success', '投稿を更新しました');
    }

    public function destroy($id)
    {
        $post = CommunityPost::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->route('community.index')->with('error', '削除権限がありません');
        }

        $post->delete();

        return redirect()->route('community.index')->with('success', '投稿を削除しました');
    }
}
