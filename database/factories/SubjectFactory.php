<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subject;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Maths', 'Science', 'English', 'History', 'Geography']),
            'code' => strtoupper(Str::random(5)),
            'description' => fake()->sentence(),
            'credits' => fake()->numberBetween(1, 5),
        ];
    }
}
