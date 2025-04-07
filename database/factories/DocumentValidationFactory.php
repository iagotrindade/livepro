<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ProfessionalDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentValidation>
 */
class DocumentValidationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'protocol' => fake()->uuid(),
            'professional_documents_id' => ProfessionalDocument::all()->random(),
            'support_agent_id' => User::all()->random(),
            'status' => fake()->randomElement(['validated', 'invalidated', 'pending', 'on_appeal'])
        ];
    }
}
