<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique(true)->randomElement(["Car", "Moter Cycle", "Bus", "Sports", "Books", "House", "Laptops", "Mobiles", "Bat", "Housing"]),
            "slug" => fake()->unique(true)->randomElement(["Car", "Moter-Cycle", "Bus", "Sports", "Books", "House", "Laptops", "Mobiles", "Bat", "Housing"]),
            "icon" => fake()->randomElement(['<i class="ri-git-repository-fill"></i>', '<i class="ri-bookmark-line"></i>', '<i class="ri-car-line"></i>', '<i class="ri-bear-smile-line"></i>', '<i class="ri-bell-line"></i>', '<i class="ri-caravan-line"></i>', '<i class="ri-mastercard-line"></i>', '<i class="ri-empathize-line"></i>']),
            'status' => "active",
            "image" => fake()->image('public/images', 200, '200', null, false)
        ];
    }
}
