<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@scholarix.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'student@test.com',
            'password' => bcrypt('student123'),
            'role' => 'student',
            'student_id' => '2024-00001',
            'course' => 'BS Computer Science',
            'phone' => '+63 912 345 6789',
        ]);
    }
}
