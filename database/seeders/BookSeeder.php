<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [

            [
                'category_id' => 1,
                'title' => 'Harry Potter and The Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'year' => 1997,
                'stock' => 15,
                'description' => 'The first book in Harry Potter series.',
            ],
            [
                'category_id' => 1,
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'Allen & Unwin',
                'year' => 1954,
                'stock' => 12,
                'description' => 'Epic fantasy adventure.',
            ],
            [
                'category_id' => 2,
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'publisher' => 'Bantam',
                'year' => 1988,
                'stock' => 8,
                'description' => 'Explaining the universe.',
            ],
            [
                'category_id' => 3,
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'publisher' => 'Simon & Schuster',
                'year' => 2011,
                'stock' => 10,
                'description' => 'Biography of Steve Jobs.',
            ],
            [
                'category_id' => 4,
                'title' => 'The Selfish Gene',
                'author' => 'Richard Dawkins',
                'publisher' => 'Oxford University Press',
                'year' => 1976,
                'stock' => 7,
                'description' => 'Evolution and natural selection.',
            ],
            [
                'category_id' => 5,
                'title' => 'The Design of Everyday Things',
                'author' => 'Don Norman',
                'publisher' => 'Basic Books',
                'year' => 1988,
                'stock' => 9,
                'description' => 'Design principles and UX.',
            ],
            [
                'category_id' => 6,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'stock' => 11,
                'description' => 'Writing better software code.',
            ],
            [
                'category_id' => 1,
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'year' => 1949,
                'stock' => 14,
                'description' => 'Dystopian society novel.',
            ],
            [
                'category_id'=> 2,
                'title'=> 'Tegar Hitam Berkelana',
                'author'=> 'Tegar Hitam',
                'publisher'=> 'Penerbit Tegar Hitam',
                'year'=> 2020,
                'stock'=> 10,
                'description'=> 'Sosok Hitam Tegar.',
            ],
        ];

        // INSERT DATA MANUAL
        foreach ($books as $book) {
            Book::create($book);
        }

        // ============================
        // AUTO GENERATE SAMPAI 50 BUKU
        // ============================

        $authors = [
            'Agatha Christie',
            'Dan Brown',
            'Paulo Coelho',
            'Andrea Hirata',
            'Tere Liye',
            'Pramoedya Ananta Toer',
            'Yuval Noah Harari',
            'Robert Kiyosaki',
        ];

        $publishers = [
            'Gramedia',
            'Erlangga',
            'Bentang Pustaka',
            'Mizan',
            'Deepublish',
        ];

        for ($i = 10; $i <= 50; $i++) {

            Book::create([
                'category_id' => rand(1,6),
                'title' => 'Library Collection Book '.$i,
                'author' => $authors[array_rand($authors)],
                'publisher' => $publishers[array_rand($publishers)],
                'year' => rand(1990,2024),
                'stock' => rand(5,20),
                'description' => 'Premium library collection book number '.$i,
            ]);

        }
    }
}