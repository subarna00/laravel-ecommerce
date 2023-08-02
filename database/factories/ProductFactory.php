<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "slug" => Str::slug(fake()->name()),
            "model" => fake()->name(),
            "sub_description" => fake()->paragraph(2),
            "description" => fake()->paragraph(),
            "price" => floor(fake()->numberBetween(100, 10000)),
            "discount" => floor(fake()->numberBetween(1, 75)),
            "offer" => fake()->randomElement([fake()->numberBetween(1, 75), null]),
            "rating" => floor(fake()->numberBetween(0, 5)),
            "stock" => floor(fake()->numberBetween(0, 100)),
            "types" => fake()->randomElement(["Trending", "Featured", "Casual"]),
            "policy" => fake()->paragraph(),
            "status" => fake()->randomElement(["active", "inactive"]),
            "brand_id" => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            "category_id" => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            "sub_category_id" => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),


        ];
    }
}
