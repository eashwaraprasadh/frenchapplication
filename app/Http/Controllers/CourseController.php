<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'published')
            ->with('teacher')
            ->paginate(12);

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if ($course->status !== 'published') {
            abort(404);
        }

        $course->load('teacher', 'lessons');

        return view('courses.show', compact('course'));
    }
}
