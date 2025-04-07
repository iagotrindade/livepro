<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => User::all()->random(),
            'professional_id' => User::all()->random(),
            'room_id' => Room::factory(),
            'payment_id' => Payment::factory(),
            'protocol' => fake()->uuid(),
            'date' => Carbon::now(),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'status' => fake()->randomElement(['scheduled', 'in_progress', 'finished', 'canceled', 'in_dispute']),
        ];
    }
}
