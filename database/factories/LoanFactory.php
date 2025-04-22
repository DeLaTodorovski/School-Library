<?php

namespace Database\Factories;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Loan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'loaned_at' => $this->faker->dateTimeThisYear,
            'returned_at' => null, // Assuming book not returned yet
            'return_due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
        ];
    }

}
