<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "color" => fake()->randomElement(["red", "blue", "yellow", "black", "gray", "orange", "purple"]),
            "available" => fake()->randomElement(["Available", "Not Available"]),
            "product_id" => floor(fake()->numberBetween(1, 100)),
        ];
    }
}
