<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ad::class;
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'link' => fake()->url(),
            'status' => "active",
            "image" => fake()->image('public/images', 200, '200', null, false)
        ];
    }
}
