<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClassRoom;
use App\Models\Teacher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fn () => 'Grade ' . fake()->numberBetween(1, 10) . '-' . fake()->randomElement(['A', 'B']),
            'grade' => fake()->numberBetween(1, 10),
            'section' => fake()->randomElement(['A', 'B']),
            'class_teacher_id' => Teacher::inRandomOrder()->first()?->id,
            'capacity' => 40,
            'room_number' => fake()->numberBetween(101, 305),
        ];
    }
}
