<?php

namespace Database\Factories;

use App\Models\Book;
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

    protected $model = Book::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'publication_year' => $this->faker->year(),
            'description' => $this->faker->paragraph(),
            'cover_image' => $this->faker->imageUrl(),
            'state' => 'available',
            'available_copies' => $this->faker->numberBetween(1, 50),
            'book_state' => 'good',
            'book_type' => 'school'
        ];
    }

    public function notAvailable(): static
    {
        return $this->state(fn (array $attributes) => [
            'state' => 'not_available',
        ]);
    }

    public function badState(): static
    {
        return $this->state(fn (array $attributes) => [
            'book_state' => 'bad',
        ]);
    }

    public function readingState(): static
    {
        return $this->state(fn (array $attributes) => [
            'book_type' => 'reading',
        ]);
    }
}
