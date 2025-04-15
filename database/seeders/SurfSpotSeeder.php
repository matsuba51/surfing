<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurfSpot;

class SurfSpotSeeder extends Seeder
{
    public function run()
    {
        // 30件のダミーデータを生成
        SurfSpot::factory(30)->create();
    }
}
