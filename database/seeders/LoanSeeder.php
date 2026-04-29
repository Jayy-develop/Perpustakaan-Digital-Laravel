<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::where('role', 'member')->get();
        $books = Book::all();

        for ($i = 0; $i < 10; $i++) {
            Loan::create([
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'loan_date' => Carbon::now()->subDays(rand(5, 30)),
                'return_date' => Carbon::now()->subDays(rand(1, 4)),
                'status' => 'returned',
            ]);
        }

        // Create some active loans
        for ($i = 0; $i < 5; $i++) {
            Loan::create([
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'loan_date' => Carbon::now()->subDays(rand(1, 14)),
                'return_date' => null,
                'status' => 'borrowed',
            ]);
        }
    }
}
