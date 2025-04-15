<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\CommunityPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,  
            'community_post_id' => CommunityPost::inRandomOrder()->first()->id,  
            'content' => $this->faker->paragraph,  
        ];
    }
}
