<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured courses
        $featuredCourses = Course::where('status', 'published')
            ->where('featured', true)
            ->with('teacher')
            ->limit(6)
            ->get();

        // Get popular courses (most enrollments)
        $popularCourses = Course::where('status', 'published')
            ->withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->with('teacher')
            ->limit(6)
            ->get();

        // Platform statistics
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_courses' => Course::where('status', 'published')->count(),
            'total_lessons' => Course::where('status', 'published')->withCount('lessons')->get()->sum('lessons_count'),
            'total_enrollments' => Enrollment::count(),
        ];

        // Testimonials (you can move this to database later)
        $testimonials = [
            [
                'name' => 'Sarah Johnson',
                'role' => 'Marketing Manager',
                'content' => 'TS Language Platform transformed my French learning experience. The interactive lessons and personalized approach made all the difference!',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&color=7F9CF5&background=EBF4FF'
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Software Developer',
                'content' => 'As a busy professional, I love how flexible the platform is. I can learn at my own pace and track my progress effectively.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&color=7F9CF5&background=EBF4FF'
            ],
            [
                'name' => 'Emma Rodriguez',
                'role' => 'University Student',
                'content' => 'The variety of learning materials and the supportive community make this the best language learning platform I\'ve used.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Emma+Rodriguez&color=7F9CF5&background=EBF4FF'
            ]
        ];

        return view('home', compact('featuredCourses', 'popularCourses', 'stats', 'testimonials'));
    }
}
