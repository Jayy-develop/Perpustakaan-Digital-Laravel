<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display all reviews for a book
     */
    public function indexByBook($bookId)
    {
        $book = Book::findOrFail($bookId);
        $reviews = Review::where('book_id', $bookId)
            ->approved()
            ->with('user')
            ->latest()
            ->paginate(10);

        $averageRating = Review::getAverageRating($bookId);
        $ratingCount = Review::getRatingCount($bookId);
        $ratingBreakdown = Review::getRatingBreakdown($bookId);

        return view('reviews.index', compact('book', 'reviews', 'averageRating', 'ratingCount', 'ratingBreakdown'));
    }

    /**
     * Display all reviews for admin moderation
     */
    public function adminIndex()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $reviews = Review::with(['user', 'book'])
            ->latest()
            ->paginate(15);

        $stats = [
            'pending' => Review::pending()->count(),
            'approved' => Review::approved()->count(),
            'total' => Review::count(),
        ];

        return view('reviews.admin-index', compact('reviews', 'stats'));
    }

    /**
     * Show review creation form
     */
    public function create($bookId)
    {
        $book = Book::findOrFail($bookId);

        // Check if user already reviewed this book
        $existingReview = Review::where('book_id', $bookId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return redirect()->route('reviews.edit', $existingReview->id)
                ->with('info', 'Anda sudah memberikan review untuk buku ini');
        }

        return view('reviews.create', compact('book'));
    }

    /**
     * Store a new review
     */
    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed
        $existing = Review::where('book_id', $bookId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk buku ini');
        }

        Review::create([
            'book_id' => $bookId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false,
        ]);

        return redirect()->route('books.show', $bookId)
            ->with('success', 'Review berhasil dikirim. Menunggu persetujuan admin.');
    }

    /**
     * Show edit form
     */
    public function edit($reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if (auth()->id() !== $review->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $book = $review->book;

        return view('reviews.edit', compact('review', 'book'));
    }

    /**
     * Update review
     */
    public function update(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if (auth()->id() !== $review->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('books.show', $review->book_id)
            ->with('success', 'Review berhasil diperbarui');
    }

    /**
     * Delete review
     */
    public function destroy($reviewId)
    {
        $review = Review::findOrFail($reviewId);

        if (auth()->id() !== $review->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $bookId = $review->book_id;
        $review->delete();

        return redirect()->route('books.show', $bookId)
            ->with('success', 'Review berhasil dihapus');
    }

    /**
     * Approve review (admin only)
     */
    public function approve($reviewId)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $review = Review::findOrFail($reviewId);
        $review->approve();

        return back()->with('success', 'Review berhasil disetujui');
    }

    /**
     * Reject review (admin only)
     */
    public function reject($reviewId)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $review = Review::findOrFail($reviewId);
        $review->reject();

        return back()->with('success', 'Review berhasil ditolak');
    }
}
