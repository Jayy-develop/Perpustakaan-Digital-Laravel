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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Petugas User
        User::factory()->create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        // Create Member Users
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'name' => 'Member ' . $i,
                'email' => 'member' . $i . '@gmail.com',
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
