<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(15),
            'author' => $this->faker->name(),
            'detail' => $this->faker->text(),
            'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg'
            
        ];
    }
}
