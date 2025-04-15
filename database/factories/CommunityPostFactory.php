<?php

namespace Database\Factories;

use App\Models\CommunityPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityPostFactory extends Factory
{
    protected $model = CommunityPost::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, 
            'title' => $this->faker->sentence,
            'content' => $this->faker->sentence(10),
        ];
    }
}

