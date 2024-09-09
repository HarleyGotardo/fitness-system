<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MealPlan>
 */
class MealPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner', 'snack']),
            'assigned_to' => User::find(1),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
