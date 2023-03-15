<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),
            'image_id' => Image::factory(),
            'text' => fake()->text(50),
            'is_answer' => fake()->boolean(),
        ];
    }

    public function wrong(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_answer' => false,
        ]);
    }

    public function answer(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_answer' => true,
        ]);
    }
}
