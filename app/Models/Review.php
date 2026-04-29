<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'rating',
        'comment',
        'is_approved'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean'
    ];

    // Relationships
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    // Methods
    public function getStarDisplay()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function approve()
    {
        $this->update(['is_approved' => true]);
        return $this;
    }

    public function reject()
    {
        $this->delete();
    }

    public static function getAverageRating($bookId)
    {
        return self::where('book_id', $bookId)
            ->approved()
            ->avg('rating') ?? 0;
    }

    public static function getRatingCount($bookId)
    {
        return self::where('book_id', $bookId)
            ->approved()
            ->count();
    }

    public static function getRatingBreakdown($bookId)
    {
        $breakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $breakdown[$i] = self::where('book_id', $bookId)
                ->approved()
                ->where('rating', $i)
                ->count();
        }
        return $breakdown;
    }
}
