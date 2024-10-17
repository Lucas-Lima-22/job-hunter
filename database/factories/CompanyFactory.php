<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'    => fake()->company(),
            'slogan'  => fake()->catchPhrase(),
            'email'   => fake()->safeEmail(),
            'website' => fake()->domainName(),
            'street'  => fake()->streetAddress(),
            'city'    => fake()->city(),
            'state'   => fake()->stateAbbr(),
            'about'   => fake()->paragraphs(6, true),
        ];
    }
}
