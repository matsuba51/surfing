<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\SurfSpot;
use App\Models\Shop;
use App\Models\User;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $surfSpots = SurfSpot::all(); // サーフスポットの取得

        foreach ($surfSpots as $surfSpot) {
            Review::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'surf_spot_id' => $surfSpot->id,
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }

        $shops = Shop::all(); // ショップの取得

        foreach ($shops as $shop) {
            Review::create([
                'user_id' => User::inRandomOrder()->first()->id, 
                'shop_id' => $shop->id,
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
