<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'reason',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    // Methods
    public static function calculateFine($loanId)
    {
        $loan = Loan::find($loanId);
        if (!$loan || $loan->status === 'borrowed') {
            return 0;
        }

        $dueDate = $loan->loan_date->addDays(7); // 7-day loan period
        $returnDate = $loan->return_date;

        if ($returnDate->lessThanOrEqualTo($dueDate)) {
            return 0; // No fine if returned on time
        }

        $overdayDays = $returnDate->diffInDays($dueDate);
        return $overdayDays * 5000; // Rp 5000 per day fine
    }

    public function markAsPaid()
    {
        $this->update(['status' => 'paid']);
        return $this;
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
