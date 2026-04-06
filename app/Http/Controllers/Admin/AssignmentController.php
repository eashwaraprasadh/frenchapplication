<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\CourseFolder;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\CourseFile;
use App\Models\StudentContentPermission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * Display course assignments
     */
    public function index()
    {
        // Get all courses with enrollment counts
        $courses = Course::withCount(['enrollments', 'lessons', 'tests'])
            ->with(['teacher'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all students
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->get();

        // Get recent enrollments
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.assignments.index', compact('courses', 'students', 'recentEnrollments'));
    }

    /**
     * Show assignment form for a specific course
     */
    public function show(Course $course)
    {
        // Load course relationships
        $course->load(['lessons', 'tests']);

        // Get all students
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->get();

        // Get currently enrolled students for this course
        $enrollments = $course->enrollments()->with('user')->get();
        $enrolledStudents = $enrollments->map(function ($enrollment) {
            $user = $enrollment->user;
            $user->pivot = $enrollment; // Add enrollment data as pivot
            return $user;
        });

        // Get students not enrolled in this course
        $availableStudents = $students->diff($enrolledStudents);

        return view('admin.assignments.show', compact('course', 'enrolledStudents', 'availableStudents'));
    }

    /**
     * Assign course to students
     */
    public function assign(Request $request, Course $course): JsonResponse
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id'
        ]);

        try {
            DB::beginTransaction();

            $assignedCount = 0;
            $alreadyEnrolled = [];

            foreach ($request->student_ids as $studentId) {
                // Check if student is already enrolled
                $existingEnrollment = Enrollment::where('user_id', $studentId)
                    ->where('course_id', $course->id)
                    ->first();

                if ($existingEnrollment) {
                    $student = User::find($studentId);
                    $alreadyEnrolled[] = $student->name;
                    continue;
                }

                // Create new enrollment
                Enrollment::create([
                    'user_id' => $studentId,
                    'course_id' => $course->id,
                    'enrolled_at' => now(),
                    'status' => 'active',
                    'progress_percentage' => 0,
                    'payment_status' => 'free',
                    'payment_amount' => 0
                ]);

                $assignedCount++;
            }

            DB::commit();

            $message = "Successfully assigned {$assignedCount} student(s) to the course.";
            if (!empty($alreadyEnrolled)) {
                $message .= " Note: " . implode(', ', $alreadyEnrolled) . " were already enrolled.";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'assigned_count' => $assignedCount,
                'already_enrolled' => $alreadyEnrolled
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error assigning students: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove student from course
     */
    public function unassign(Request $request, Course $course): JsonResponse
    {
        $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);

        try {
            $enrollment = Enrollment::where('user_id', $request->student_id)
                ->where('course_id', $course->id)
                ->first();

            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student is not enrolled in this course.'
                ], 404);
            }

            $student = User::find($request->student_id);
            $enrollment->delete();

            return response()->json([
                'success' => true,
                'message' => "Successfully removed {$student->name} from the course."
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing student: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get course assignment data for AJAX
     */
    public function getCourseData(Course $course): JsonResponse
    {
        $course->load(['enrollments.user', 'teacher']);

        return response()->json([
            'success' => true,
            'course' => $course,
            'enrolled_students' => $course->enrollments->map(function ($enrollment) {
                return [
                    'id' => $enrollment->user->id,
                    'name' => $enrollment->user->name,
                    'email' => $enrollment->user->email,
                    'enrolled_at' => $enrollment->enrolled_at->format('M d, Y'),
                    'progress' => $enrollment->progress_percentage,
                    'status' => $enrollment->status
                ];
            })
        ]);
    }
    /**
     * Manage granular content permissions for a student in a course.
     */
    /**
     * Manage granular content permissions for a student in a course.
     */
    public function permissions(Course $course, $student_id, Request $request)
    {
        $student = User::findOrFail($student_id);

        // Ensure student is enrolled
        $enrolled = Enrollment::where('user_id', $student->id)->where('course_id', $course->id)->exists();
        if (!$enrolled) {
            return redirect()->route('admin.assignments.course.show', $course)->with('error', 'Student is not enrolled in this course.');
        }

        $perPage = 20;
        $cacheMinutes = 10;
        $cachePrefix = "permissions:{$course->id}:{$student->id}";

        // Load top-level items (cached, unpaginated for quick access)
        $topFolders = \Cache::remember(
            "{$cachePrefix}:top-folders",
            now()->addMinutes($cacheMinutes),
            fn() => CourseFolder::where('course_id', $course->id)
                ->whereNull('parent_folder_id')
                ->orderBy('order_index')
                ->get()
        );

        $rootLessons = \Cache::remember(
            "{$cachePrefix}:root-lessons",
            now()->addMinutes($cacheMinutes),
            fn() => Lesson::where('course_id', $course->id)
                ->whereNull('folder_id')
                ->orderBy('order_index')
                ->get()
        );

        $rootTests = \Cache::remember(
            "{$cachePrefix}:root-tests",
            now()->addMinutes($cacheMinutes),
            fn() => Test::where('course_id', $course->id)
                ->whereNull('folder_id')
                ->orderBy('order_index')
                ->get()
        );

        $rootFiles = \Cache::remember(
            "{$cachePrefix}:root-files",
            now()->addMinutes($cacheMinutes),
            fn() => CourseFile::where('course_id', $course->id)
                ->whereNull('folder_id')
                ->orderBy('order_index')
                ->get()
        );

        // Load all items for granular control (NO pagination, show full list)
        $allFolders = \Cache::remember(
            "{$cachePrefix}:all-folders",
            now()->addMinutes($cacheMinutes),
            fn() => CourseFolder::where('course_id', $course->id)
                ->with('parentFolder')
                ->orderBy('parent_folder_id')
                ->orderBy('order_index')
                ->get()
        );

        $allLessons = \Cache::remember(
            "{$cachePrefix}:all-lessons",
            now()->addMinutes($cacheMinutes),
            fn() => Lesson::where('course_id', $course->id)
                ->with('folder')
                ->orderBy('order_index')
                ->get()
        );

        $allTests = \Cache::remember(
            "{$cachePrefix}:all-tests",
            now()->addMinutes($cacheMinutes),
            fn() => Test::where('course_id', $course->id)
                ->with('folder')
                ->orderBy('order_index')
                ->get()
        );

        // Existing permissions for this student+course keyed by tuple (cached)
        $existing = \Cache::remember(
            "{$cachePrefix}:existing",
            now()->addMinutes($cacheMinutes),
            fn() => StudentContentPermission::where('student_id', $student->id)
                ->where('course_id', $course->id)
                ->get()
                ->keyBy(function ($p) {
                    return $p->content_type . ':' . $p->content_id;
                })
        );

        return view('admin.assignments.permissions', compact(
            'course',
            'student',
            'topFolders',
            'rootLessons',
            'rootTests',
            'rootFiles',
            'allFolders',
            'allLessons',
            'allTests',
            'existing'
        ));
    }

    /**
     * Save granular permissions for a student in a course.
     */
    public function savePermissions(Request $request, Course $course, $student_id)
    {
        $student = User::findOrFail($student_id);
        $request->validate([
            'permissions' => 'array'
        ]);

        // Ensure enrollment
        $enrolled = Enrollment::where('user_id', $student->id)->where('course_id', $course->id)->exists();
        if (!$enrolled) {
            return back()->with('error', 'Student is not enrolled in this course.');
        }

        try {
            DB::beginTransaction();

            $perms = $request->input('permissions', []);
            $now = now();
            $adminId = auth()->id();

            // Strategy: upsert records for all submitted entries; remove any not submitted if they belong to this course+student
            $seenKeys = [];
            foreach (['folder', 'lesson', 'test', 'file'] as $type) {
                if (!isset($perms[$type]) || !is_array($perms[$type]))
                    continue;
                foreach ($perms[$type] as $id => $value) {
                    $key = $type . ':' . (int) $id;
                    $seenKeys[] = $key;
                    StudentContentPermission::updateOrCreate(
                        [
                            'student_id' => $student->id,
                            'course_id' => $course->id,
                            'content_type' => $type,
                            'content_id' => (int) $id,
                        ],
                        [
                            'has_access' => (bool) $value,
                            'granted_by' => $adminId,
                            'granted_at' => $now,
                        ]
                    );
                }
            }

            // Revoke any previously granted access that was not submitted (deny-by-default)
            StudentContentPermission::where('student_id', $student->id)
                ->where('course_id', $course->id)
                ->where('has_access', true)
                ->whereNotIn(DB::raw("CONCAT(content_type,':',content_id)"), $seenKeys)
                ->delete();

            DB::commit();

            // Clear permission cache for this student+course
            $this->clearPermissionCache($course->id, $student->id);

            return back()->with('success', 'Permissions updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save permissions: ' . $e->getMessage());
        }
    }

    /**
     * Clear cached permission data for a specific course and student
     */
    private function clearPermissionCache(int $courseId, int $studentId): void
    {
        $prefix = "permissions:{$courseId}:{$studentId}";

        // Clear top-level caches
        \Cache::forget("{$prefix}:top-folders");
        \Cache::forget("{$prefix}:root-lessons");
        \Cache::forget("{$prefix}:root-tests");
        \Cache::forget("{$prefix}:root-files");

        // Clear paginated caches (up to 10 pages for each type)
        foreach (['all-folders', 'all-lessons', 'all-tests'] as $type) {
            for ($page = 1; $page <= 10; $page++) {
                \Cache::forget("{$prefix}:{$type}:page:{$page}");
            }
        }

        // Clear existing permissions cache
        \Cache::forget("{$prefix}:existing");
    }


}
