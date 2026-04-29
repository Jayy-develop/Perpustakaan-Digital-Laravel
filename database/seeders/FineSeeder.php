<?php

namespace Database\Seeders;

use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class FineSeeder extends Seeder
{
    public function run(): void
    {
        // Create fines for returned loans that are overdue
        $returnedLoans = Loan::where('status', 'returned')->get();

        foreach ($returnedLoans as $loan) {
            // Calculate overdue days
            $dueDate = $loan->loan_date->addDays(7);
            
            if ($loan->return_date && $loan->return_date->greaterThan($dueDate)) {
                $overdayDays = $loan->return_date->diffInDays($dueDate);
                $amount = $overdayDays * 5000; // Rp 5000 per day

                // Check if fine already exists for this loan
                if (!Fine::where('loan_id', $loan->id)->exists()) {
                    Fine::create([
                        'loan_id' => $loan->id,
                        'amount' => $amount,
                        'reason' => 'Late return - ' . $overdayDays . ' days overdue',
                        'status' => 'pending',
                    ]);
                }
            }
        }
    }
}
