<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            // 'user_id'=>$this->faker->randomNumber(),
            'detail' => $this->faker->text(),
            'price' => $this->faker->numberBetween(12,5000),
            'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg'
            
        ];
    }
}
