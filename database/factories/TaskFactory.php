<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        User::factory()->create();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => fake()->sentence(3),
            'status' => fake()->randomElement(['todo', 'in progress', 'completed']),
        ];
    }
}
