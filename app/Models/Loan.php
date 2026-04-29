<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'loan_date', 'return_date', 'status'];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
    ];

    /**
     * Get the user that owns the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the loan.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the fines for this loan.
     */
    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
