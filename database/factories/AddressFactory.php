<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'street' => fake()->streetAddress(),
            'number' => fake()->buildingNumber(),
            'neighborhood' =>  fake()->name(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'zip_code' => fake()->postcode(),
            'type' => 'residential', 
            'user_id' => User::all()->random()
        ];
    }
}
