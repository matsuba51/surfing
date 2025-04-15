<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\Shop;
use App\Models\SurfSpot;
use App\Models\Review;
use App\Models\CommunityPost;
use App\Models\Comment;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(5)->create();  // ユーザーを5件作成

        BlogPost::factory()->count(5)->create();

        Shop::factory(10)->create();  // 10件のショップデータを作成
        SurfSpot::factory(10)->create();  // 10件のサーフスポットデータを作成

        Review::factory()->count(20)->create();  // 20件のレビューを作成

        CommunityPost::factory()->count(10)->create();

        Comment::factory()->count(30)->create();  // コメントは30件、1つの投稿に3件程度のコメントを追加
    }
}
