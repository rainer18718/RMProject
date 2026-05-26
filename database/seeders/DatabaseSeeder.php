<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('profiles')->updateOrInsert(
            ['user_id' => 1],
            [
                'bio' => 'Sample student profile',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('posts')->updateOrInsert(
            ['id' => 1],
            [
                'user_id' => 1,
                'title' => 'Welcome Post',
                'content' => 'This is a sample post.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('degrees')->updateOrInsert(
            ['id' => 1],
            [
                'degree_title' => 'Bachelor of Science in Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_accounts')->updateOrInsert(
            ['username' => 'admin'],
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_accounts')->updateOrInsert(
            ['username' => 'teacher'],
            [
                'email' => 'teacher@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_accounts')->updateOrInsert(
            ['username' => 'juan'],
            [
                'email' => 'juan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_accounts')->updateOrInsert(
            ['username' => 'maria'],
            [
                'email' => 'maria@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $juanAccountId = DB::table('user_accounts')->where('username', 'juan')->value('id');
        $mariaAccountId = DB::table('user_accounts')->where('username', 'maria')->value('id');

        DB::table('students')->updateOrInsert(
            ['id' => 1],
            [
                'user_account_id' => $juanAccountId,
                'student_id' => 'S-001',
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'address' => 'Manila',
                'contact_number' => '09123456789',
                'email' => 'juan@example.com',
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('students')->updateOrInsert(
            ['id' => 2],
            [
                'user_account_id' => $mariaAccountId,
                'student_id' => 'S-002',
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'address' => 'Quezon City',
                'contact_number' => '09987654321',
                'email' => 'maria@example.com',
                'degree_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('courses')->updateOrInsert(
            ['id' => 1],
            [
                'course_name' => 'Web Development',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('course__students')->updateOrInsert(
            [
                'course_id' => 1,
                'student_id' => 2,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
