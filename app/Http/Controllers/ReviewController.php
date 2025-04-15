<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\SurfSpot;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class ReviewController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $surfspotReviews = Review::whereNotNull('surf_spot_id')->with('surfSpot')->latest()->paginate(5);

        $shopReviews = Review::whereNotNull('shop_id')->with('shop')->latest()->paginate(5);

        return view('reviews.index', compact('surfspotReviews', 'shopReviews', 'layout'));
    }


    public function show($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $review = Review::with('comments.user')->findOrFail($id); 
        return view('reviews.show', compact('review', 'layout'));
    }


    public function store(Request $request)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ], [
            'content.min' => 'コメント内容は10文字以上で入力してください。',
            'content.max' => 'コメント内容は1000文字以内で入力してください。',
        ]);

        // サーフスポットID または ショップID が設定されているかチェック
        if (!$request->has('surf_spot_id') && !$request->has('shop_id')) {
            return back()
                ->withErrors(['error' => 'サーフスポットまたはショップを選択してください。'])
                ->with('layout', $layout);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'surf_spot_id' => $request->surf_spot_id,
            'shop_id' => $request->shop_id,
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        // 元のページ（スポット or ショップの詳細ページ）に戻る
        return back()->with([
            'layout' => $layout,
            'success' => 'レビューを投稿しました！'
        ]);
    }

    public function edit($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return redirect()->route('reviews.index')->with([
                'layout' => $layout,
                'error' => '不正な操作です'
            ]);
        }

        return view('reviews.edit', compact('review', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ], [
            'content.min' => 'コメント内容は10文字以上で入力してください。',
            'content.max' => 'コメント内容は1000文字以内で入力してください。',
        ]);

        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return redirect()->route('reviews.index')->with([
                'layout' => $layout,
                'error' => '不正な操作です'
            ]);
        }

        $review->update([
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.show', $review->id)->with([
            'layout' => $layout,
            'success' => 'レビューを更新しました！'
        ]);
    }

    public function destroy($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return redirect()->route('reviews.index')->with([
                'layout' => $layout,
                'error' => '不正な操作です'
            ]);
        }

        $review->delete();

        if ($review->surf_spot_id) {
            $surfspot = SurfSpot::findOrFail($review->surf_spot_id);
            $reviews = $surfspot->reviews;  
            return redirect()->route('surfspots.show', $review->surf_spot_id)
                ->with('success', 'レビューを削除しました！')
                ->with('reviews', $reviews); 
        }

        if ($review->shop_id) {
            $shop = Shop::findOrFail($review->shop_id);
            $reviews = $shop->reviews;  
            return redirect()->route('shops.show', $review->shop_id)
                ->with('success', 'レビューを削除しました！')
                ->with('reviews', $reviews); 
        }

        return redirect()->route('reviews.index')->with([
            'layout' => $layout,
            'success' => 'レビューを削除しました！'
        ]);
    }
}
