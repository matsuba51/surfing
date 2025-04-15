<?php

namespace Database\Factories;

use App\Models\SurfSpot;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurfSpotFactory extends Factory
{
    protected $model = SurfSpot::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company, 
            'description' => $this->faker->text(), 
            'image' => 'kanegahama.jpg', 
            'address' => $this->faker->address, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
