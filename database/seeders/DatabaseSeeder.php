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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'GN User',
            'email' => 'gn@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'is_active' => true,
        ]);
    }
}
