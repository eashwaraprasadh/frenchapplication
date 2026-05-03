<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\CourseFolder;
use App\Models\Lesson;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['teacher', 'enrollments'])
            ->withCount(['lessons', 'tests', 'enrollments'])
            ->latest()
            ->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')
            ->orWhere('role', 'admin')
            ->orderBy('name')
            ->get();

        return view('admin.courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|in:french,spanish,german,italian',
            'level' => 'required|in:A1,A2,B1,B2,C1,C2',
            'teacher_id' => 'required|exists:users,id',
            'price' => 'nullable|numeric|min:0',
            'duration_hours' => 'nullable|integer|min:1',
            'featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['price'] = $validated['price'] ?? 0;
        $validated['duration_hours'] = $validated['duration_hours'] ?? 1;

        $course = Course::create($validated);

        return redirect()
            ->route('admin.courses.builder', $course)
            ->with('success', 'Course created successfully! Now you can add content.');
    }

    public function show(Course $course)
    {
        $course->load(['teacher', 'lessons', 'folders', 'enrollments']);

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')
            ->orWhere('role', 'admin')
            ->orderBy('name')
            ->get();

        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|in:french,spanish,german,italian',
            'level' => 'required|in:A1,A2,B1,B2,C1,C2',
            'teacher_id' => 'required|exists:users,id',
            'price' => 'nullable|numeric|min:0',
            'duration_hours' => 'nullable|integer|min:1',
            'featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['price'] = $validated['price'] ?? 0;
        $validated['duration_hours'] = $validated['duration_hours'] ?? 1;

        $course->update($validated);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        // Delete related data
        $course->lessons()->delete();
        $course->folders()->delete();
        $course->enrollments()->delete();
        $course->tests()->delete();

        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    /**
     * Course Builder - The main interface for building course content
     */
    public function builder(Course $course)
    {
        // Load course with all related data for the builder
        $course->load([
            'folders' => function($query) {
                $query->whereNull('parent_folder_id')->orderBy('order_index');
            },
            'folders.subfolders' => function($query) {
                $query->orderBy('order_index');
            },
            'folders.lessons' => function($query) {
                $query->orderBy('order_index');
            },
            'folders.tests' => function($query) {
                $query->orderBy('order_index');
            },
            'lessons' => function($query) {
                $query->whereNull('folder_id')->orderBy('order_index');
            },
            'tests' => function($query) {
                $query->whereNull('folder_id')->orderBy('order_index');
            }
        ]);

        // Get course statistics
        $stats = [
            'total_folders' => $course->folders()->count(),
            'total_lessons' => $course->lessons()->count(),
            'total_tests' => $course->tests()->count(),
            'total_enrollments' => $course->enrollments()->count(),
            'completion_rate' => $this->calculateCompletionRate($course),
        ];

        return view('admin.courses.builder', compact('course', 'stats'));
    }

    private function calculateCompletionRate(Course $course)
    {
        $totalEnrollments = $course->enrollments()->count();

        if ($totalEnrollments === 0) {
            return 0;
        }

        $completedEnrollments = $course->enrollments()
            ->where('status', 'completed')
            ->count();

        return round(($completedEnrollments / $totalEnrollments) * 100, 1);
    }

    /**
     * Get folder contents for AJAX navigation
     */
    public function getFolderContents(Course $course, CourseFolder $folder)
    {
        try {
            // Load folder with its contents
            $folder->load([
                'subfolders' => function($query) {
                    $query->orderBy('order_index');
                },
                'lessons' => function($query) {
                    $query->orderBy('order_index');
                },
                'tests' => function($query) {
                    $query->orderBy('order_index');
                }
            ]);

            // Format the data for frontend
            $contents = [
                'folders' => $folder->subfolders->map(function($subfolder) {
                    return [
                        'id' => $subfolder->id,
                        'name' => $subfolder->name,
                        'description' => $subfolder->description,
                        'items_count' => $subfolder->subfolders->count() + $subfolder->lessons->count() + $subfolder->tests->count(),
                        'updated_at' => $subfolder->updated_at->diffForHumans(),
                    ];
                }),
                'lessons' => $folder->lessons->map(function($lesson) {
                    return [
                        'id' => $lesson->id,
                        'title' => $lesson->title,
                        'description' => $lesson->description,
                        'duration' => $lesson->duration,
                        'status' => $lesson->status,
                        'updated_at' => $lesson->updated_at->diffForHumans(),
                    ];
                }),
                'tests' => $folder->tests->map(function($test) {
                    return [
                        'id' => $test->id,
                        'title' => $test->title,
                        'description' => $test->description,
                        'duration' => $test->duration,
                        'passing_score' => $test->passing_score,
                        'status' => $test->status,
                        'updated_at' => $test->updated_at->diffForHumans(),
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'contents' => $contents,
                'folder' => [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'description' => $folder->description,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading folder contents: ' . $e->getMessage()
            ], 500);
        }
    }
}
