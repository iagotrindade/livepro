<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use App\Models\Support;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'entity_type' => fake()->randomElement([Schedule::class, User::class]), // Salva o nome completo da classe
            'entity_id' => fake()->randomElement([Schedule::all()->random()->id, User::all()->random()->id]),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(2),
            'status' => fake()->randomElement(['published', 'under_analysis', 'hidden', 'deleted']),
            'anonymous' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
