<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    public function run()
    {
        // 外部キー制約を無効にする
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // shopsテーブルのデータを削除
        Shop::truncate();

        // 外部キー制約を再度有効にする
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 新しいデータを30件挿入
        Shop::factory(30)->create();
    }
}
