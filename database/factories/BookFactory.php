<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(fake()->numberBetween(2, 4)),
            'description' => fake()->paragraph(),
            'publisher' => fake()->optional(80)->company(),
            'cover_url' => fake()->imageUrl(362, 544, 'book')
        ];
    }
}
