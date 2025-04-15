<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SpotController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SurfSpotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurfShopController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommentController;

// トップページ
Route::middleware('log.visit')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// 認証が必要なユーザー用ルート
Route::middleware('auth')->group(function () {
    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 管理者用ルート（/admin）
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ダッシュボード
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'visitStats'])->name('dashboard.stats');
    Route::get('/dashboard/communityStats', [DashboardController::class, 'visitStats'])->name('dashboard.communityStats');

    // サーフスポット管理
    Route::resource('spots', SpotController::class)->except(['show']);
    Route::get('/spots/{spot}', [SpotController::class, 'show'])->name('spots.show');

    // サーフショップ管理
    Route::resource('shops', ShopController::class)->except(['show']);
    Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');

    // ユーザー管理
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// 一般ユーザー向け：一覧表示
Route::get('/surfspots', [SurfSpotController::class, 'index'])->name('surfspots.index');
Route::get('/surfshops', [SurfShopController::class, 'index'])->name('surfshops.index');
Route::get('/rules', [RuleController::class, 'index'])->name('rules.index');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');

// 詳細ページ（誰でもアクセス可）
Route::get('/surfspots/{id}', [SurfSpotController::class, 'show'])->name('surfspots.show');
Route::get('/shops/{id}', [SurfShopController::class, 'show'])->name('shops.show');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/community/{id}', [CommunityController::class, 'show'])->name('community.show');

// 認証が必要な投稿系機能
Route::middleware('auth')->group(function () {
    // レビュー投稿
    Route::resource('reviews', ReviewController::class)->except(['index', 'show']);

    // コミュニティ投稿
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::get('/community/{id}/edit', [CommunityController::class, 'edit'])->name('community.edit');
    Route::put('/community/{id}', [CommunityController::class, 'update'])->name('community.update');
    Route::delete('/community/{id}', [CommunityController::class, 'destroy'])->name('community.destroy');

    // コメント
    Route::post('/community/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/community/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/community/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/community/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
