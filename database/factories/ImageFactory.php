<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => fake()->imageUrl(),
            'path' => fake()->word(),
        ];
    }
}
