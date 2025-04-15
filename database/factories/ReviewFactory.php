<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Shop;
use App\Models\SurfSpot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        // 50%の確率でShopまたはSurfSpotに紐づけ
        $shopOrSurfSpot = $this->faker->randomElement([Shop::class, SurfSpot::class]);

        return [
            'user_id' => User::all()->random()->id,  
            'title' => $this->faker->sentence,      
            'content' => $this->faker->paragraph,    
            'rating' => $this->faker->numberBetween(1, 5), 
            'shop_id' => $shopOrSurfSpot == Shop::class ? Shop::factory()->create()->id : null,  
            'surf_spot_id' => $shopOrSurfSpot == SurfSpot::class ? SurfSpot::factory()->create()->id : null,  
        ];
    }
}
