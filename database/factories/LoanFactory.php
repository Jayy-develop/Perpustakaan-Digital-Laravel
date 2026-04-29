<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'book_id' => \App\Models\Book::factory(),
            'loan_date' => $this->faker->dateTimeBetween('-30 days'),
            'return_date' => $this->faker->dateTimeBetween('-10 days'),
            'status' => $this->faker->randomElement(['borrowed', 'returned']),
        ];
    }
}
