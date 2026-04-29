<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all();
        $users = User::where('role', 'member')->get();

        if ($books->isEmpty() || $users->isEmpty()) {
            return;
        }

        $reviews = [
            ['rating' => 5, 'comment' => 'Buku yang sangat bagus! Alur cerita menarik dan karakter yang kuat. Sangat merekomendasikan untuk dibaca.', 'is_approved' => true],
            ['rating' => 4, 'comment' => 'Cerita yang menarik dengan penulisan yang cukup baik. Ada beberapa bagian yang bisa lebih dikembangkan.', 'is_approved' => true],
            ['rating' => 5, 'comment' => 'Masterpiece! Saya tidak bisa berhenti membacanya. Ending yang sempurna!', 'is_approved' => true],
            ['rating' => 3, 'comment' => 'Buku yang lumayan. Ceritanya bagus tetapi sedikit lambat di awal.', 'is_approved' => true],
            ['rating' => 2, 'comment' => 'Tidak sesuai dengan harapan saya. Ceritanya membosankan dan karakter kurang berkembang.', 'is_approved' => true],
            ['rating' => 4, 'comment' => 'Sangat enjoy membaca buku ini. Plot twist yang tidak terduga!', 'is_approved' => true],
            ['rating' => 5, 'comment' => 'Luar biasa! Saya sudah baca berkali-kali dan tetap suka.', 'is_approved' => true],
            ['rating' => 3, 'comment' => 'Cukup baik untuk dibaca. Tapi ada yang terlewat dari yang saya harapkan.', 'is_approved' => true],
            ['rating' => 4, 'comment' => 'Buku yang mendidik dan menghibur. Cocok untuk semua kalangan.', 'is_approved' => true],
            ['rating' => 1, 'comment' => 'Saya tidak merekomendasikan. Sangat mengecewakan.', 'is_approved' => false],
        ];

        $bookIndex = 0;
        $userIndex = 0;

        foreach ($reviews as $reviewData) {
            // Cycle through books and users
            $book = $books[$bookIndex % $books->count()];
            $user = $users[$userIndex % $users->count()];

            // Check if user already reviewed this book
            $exists = Review::where('book_id', $book->id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$exists) {
                Review::create([
                    'book_id' => $book->id,
                    'user_id' => $user->id,
                    'rating' => $reviewData['rating'],
                    'comment' => $reviewData['comment'],
                    'is_approved' => $reviewData['is_approved'],
                ]);
            }

            $bookIndex++;
            $userIndex++;
        }
    }
}
