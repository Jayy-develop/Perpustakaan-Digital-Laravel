<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Petugas User
        User::factory()->create([
            'name' => 'Petugas User',
            'email' => 'petugas@example.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        // Create Member Users
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'name' => 'Member User ' . $i,
                'email' => 'member' . $i . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'member',
            ]);
        }

        // Run other seeders
        $this->call([
            CategorySeeder::class,
            BookSeeder::class,
            LoanSeeder::class,
            FineSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
