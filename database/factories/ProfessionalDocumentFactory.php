<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfessionalDocument>
 */
class ProfessionalDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_id' => Document::all()->random(),
            'user_id' => User::all()->random(),
            'folder_path' => fake()->url(),
        ];
    }
}
