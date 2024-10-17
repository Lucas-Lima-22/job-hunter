<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => fake()->name(),
            'headline'   => fake()->sentence(),
            'email'      => fake()->safeEmail(),
            'phone'      => fake()->phoneNumber(),
            'street'     => fake()->streetAddress(),
            'city'       => fake()->city(),
            'state'      => fake()->stateAbbr(),
            'summary'    => fake()->paragraphs(6, true),
            'experience' => fake()->paragraphs(6, true),
            'skills'     => fake()->paragraphs(6, true),
            'education'  => fake()->paragraphs(6, true),
        ];
    }
}
