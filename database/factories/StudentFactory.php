<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassRoom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'user_id' => User::factory(),
            'admission_number' => 'ADM-' . fake()->unique()->numberBetween(10000, 99999),
            'class_id' => ClassRoom::inRandomOrder()->first()?->id,
            'roll_number' => fake()->numberBetween(1, 40),
            'admission_date' => fake()->date(),
            'parent_name' => fake()->name(),
            'parent_phone' => fake()->phoneNumber(),
            'parent_email' => fake()->safeEmail(),
            'status' => 'active',
        ];
    }
}
