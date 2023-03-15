<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(
                QuestionGroup::factory()->has(
                    Question::factory()->has(
                        Option::factory()->count(5)
                    )->count(5)
                )->count(5)
            )
            ->count(10)
            ->create();
    }
}
