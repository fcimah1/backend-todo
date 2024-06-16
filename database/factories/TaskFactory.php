<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Task' => fake()->sentence(5),
            'Description' => fake()->sentence(20),
            'is_done' => fake()->boolean(false)
        ];
    }
}
