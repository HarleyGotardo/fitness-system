<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppClass>
 */
class AppClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assigned_to' => User::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
        ];
    }
}