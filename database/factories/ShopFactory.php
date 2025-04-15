<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,         
            'description' => $this->faker->text(200), 
            'address' => $this->faker->address,      
            'phone' => $this->faker->phoneNumber,    
            'email' => $this->faker->email,         
        ];
    }
}
