<?php

namespace Database\Seeders;

use App\Models\CommunityPost;
use Illuminate\Database\Seeder;

class CommunityPostSeeder extends Seeder
{
    public function run()
    {
        CommunityPost::factory(10)->create();
    }
}
