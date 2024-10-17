<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'    => fake()->jobTitle(),
            'salary'   => fake()->numberBetween(100, 1000),
            'schedule' => fake()->randomElement(['Full-Time', 'Part-Time', 'Contract', 'Temporary', 'Internship']),
            'model'    => fake()->randomElement(['On-Site', 'Remote', 'Hybrid']),
            'about'    => fake()->paragraphs(6, true),
            'tags'     => fake()->words(rand(3, 6))
        ];
    }
}
