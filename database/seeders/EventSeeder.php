<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'サーフィン大会2025',
                'description' => '宮崎県で開催されるサーフィンの大会です。',
                'date' => '2025-06-15',
                'location' => '宮崎県青島ビーチ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'サーフィン講習会',
                'description' => '初心者向けのサーフィン講習会。',
                'date' => '2025-07-10',
                'location' => '宮崎県日向サーフスポット',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'サーフィン修行キャンプ',
                'description' => 'サーフィン技術を向上させる修行キャンプ。',
                'date' => '2025-08-20',
                'location' => '宮崎県木崎浜ビーチ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
