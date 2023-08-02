<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique(true)->randomElement(["Ca", "Moter", "Bu-s", "Spo", "Bo", "Hou", "Lap", "biles", "Bat", "Hous"]),
            "slug" =>  fake()->unique(true)->randomElement(["Ca", "Moter", "Bu-s", "Spo", "Bo", "Hou", "Lap", "biles", "Bat", "Hous"]),
            "category_id" => fake()->randomElement(['1', '2', '3', '4', '5']),
            'status' => "active",
            "image" => fake()->image('public/images', 200, '200', null, false)
        ];
    }
}
