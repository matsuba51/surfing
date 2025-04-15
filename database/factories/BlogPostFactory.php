<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        $faker = Faker::create('ja_JP'); // 日本語設定

        return [
            'title' => $this->faker->sentence, // タイトル（日本語）
            'content' => $this->faker->realText(200), // コンテンツ（日本語）
            'user_id' => User::inRandomOrder()->first()->id, // ランダムなユーザーIDを設定
        ];
    }
}
