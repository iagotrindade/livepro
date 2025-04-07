<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
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
            'plan_id' => Plan::all()->random(),
            'payment_id' => Payment::all()->random(),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'active',
        ];
    }
}
