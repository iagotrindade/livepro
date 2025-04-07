<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recording>
 */
class RecordingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recording_id' => fake()->uuid(),
            'start_ts' => Carbon::now(),
            'duration' => fake()->randomNumber(5, true),
            'url' => fake()->url(),
            'status' => fake()->randomElement(['available', 'unavailable', 'deleted']),
        ];
    }
}
