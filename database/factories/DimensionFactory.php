<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dimension>
 */
class DimensionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "dimension" => fake()->randomElement(["sm", "lg", "xl", "2xl", "3xl"]),
            "available" => fake()->randomElement(["Available", "Not Available"]),
            "product_id" => floor(fake()->numberBetween(1, 100)),
        ];
    }
}
