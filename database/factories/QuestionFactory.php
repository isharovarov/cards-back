<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\QuestionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question_group_id' => QuestionGroup::factory(),
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
