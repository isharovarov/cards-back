<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionGroupFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'image_id' => Image::factory(),
            'text' => fake()->text(50),
        ];
    }

    public function text(): static
    {
        return $this->state(fn(array $attributes) => [
            'image_id' => null,
            'text' => fake()->text(50),
        ]);
    }

    public function image(): static
    {
        return $this->state(fn(array $attributes) => [
            'image_id' => Image::factory(),
            'text' => null,
        ]);
    }
}
