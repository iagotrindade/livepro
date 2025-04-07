<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\SupportCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(),
            'support_agent_id' => User::all()->random(),
            'support_categories_id' => SupportCategory::all()->random(),
            'protocol' => fake()->uuid(),
            'subject' => fake()->text(),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => fake()->randomElement(['open', 'in_progress', 'resolved', 'closed']),
        ];
    }
}
