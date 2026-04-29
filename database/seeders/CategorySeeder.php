<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Buku cerita fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku pengetahuan dan referensi'],
            ['name' => 'Biografi', 'description' => 'Kisah hidup tokoh-tokoh terkenal'],
            ['name' => 'Sains', 'description' => 'Buku tentang ilmu sains dan teknologi'],
            ['name' => 'Seni', 'description' => 'Buku tentang seni dan desain'],
            ['name' => 'Pendidikan', 'description' => 'Buku panduan pendidikan dan pembelajaran'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
