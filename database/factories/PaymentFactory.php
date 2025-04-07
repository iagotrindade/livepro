<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'type' => 'call',
            'method' => fake()->randomElement(['pix', 'card', 'bank_slip']),
            'amount' => fake()->randomFloat(2, 100, 1000),
            'profit_tax' => fake()->randomFloat(2, 0, 10),
            'remote_ip' =>  fake()->ipv4(),
            'status' => fake()->randomElement(['pending', 'finalized', 'refounded']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
