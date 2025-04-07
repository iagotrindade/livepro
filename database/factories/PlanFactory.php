<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 1, 100),
            'billing_cycle' => fake()->randomElement(['weekly','monthly','annual']),
            'trial_period_days' => 30,
            'description' => fake()->text(),
            'features' => json_encode(fake()->words(5)),
            'is_active' => 1,
        ];
    }
}
