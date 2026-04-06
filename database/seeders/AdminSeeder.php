<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
                'points' => 0,
                'level' => 1,
                'current_streak' => 0,
                'longest_streak' => 0,
                'total_study_time' => 0,
            ]
        );

        // Create Sample Student
        $student = User::firstOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'status' => 'active',
                'email_verified_at' => now(),
                'language_level' => 'beginner',
                'bio' => 'Learning French with TS Language Platform!',
                'points' => 0,
                'level' => 1,
                'current_streak' => 0,
                'longest_streak' => 0,
                'total_study_time' => 0, // 0 minutes
            ]
        );

        // Create Sample Courses (using admin as teacher for now)
        $courses = [
            [
                'title' => 'French for Beginners',
                'description' => 'Start your French journey with basic vocabulary, pronunciation, and essential phrases. Perfect for absolute beginners.',
                'level' => 'beginner',
                'status' => 'published',
                'featured' => true,
                'teacher_id' => $admin->id, // Using admin as teacher
                'duration_hours' => 20,
                'price' => 0, // Free course
            ],
            [
                'title' => 'Conversational French',
                'description' => 'Improve your speaking skills with practical conversations and real-life scenarios.',
                'level' => 'intermediate',
                'status' => 'published',
                'featured' => true,
                'teacher_id' => $admin->id, // Using admin as teacher
                'duration_hours' => 30,
                'price' => 49.99,
            ],
            [
                'title' => 'French Grammar Mastery',
                'description' => 'Master French grammar rules with comprehensive lessons and practice exercises.',
                'level' => 'intermediate',
                'status' => 'published',
                'featured' => false,
                'teacher_id' => $admin->id, // Using admin as teacher
                'duration_hours' => 25,
                'price' => 39.99,
            ]
        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['title' => $courseData['title']],
                $courseData
            );
        }

        // Create System Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'TS Language Learning Platform'],
            ['key' => 'site_description', 'value' => 'Master French with our comprehensive online learning platform'],
            ['key' => 'contact_email', 'value' => 'contact@tslanguage.com'],
            ['key' => 'max_file_upload_size', 'value' => '10'], // MB
            ['key' => 'allowed_file_types', 'value' => 'jpg,jpeg,png,gif,mp3,mp4,pdf,doc,docx'],
            ['key' => 'points_per_lesson', 'value' => '10'],
            ['key' => 'points_per_test', 'value' => '25'],
            ['key' => 'maintenance_mode', 'value' => 'false'],
        ];

        foreach ($settings as $setting) {
            SystemSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Admin seeder completed successfully!');
        $this->command->info('Admin Login: admin@gmail.com / admin123');
        $this->command->info('Student Login: student@gmail.com / student123');
    }
}
