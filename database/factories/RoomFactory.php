<?php

namespace Database\Factories;

use App\Models\Recording;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recording_id' => Recording::factory(),
            'room_id' => fake()->uuid(),
            'name' => fake()->name(),
            'url' => fake()->url(),
            'start_time' => Carbon::now(),
            'expires_at' => Carbon::now(),
            'status' => fake()->randomElement(['scheduled', 'paid', 'refunded', 'in_progress', 'finished']),
        ];
    }
}
