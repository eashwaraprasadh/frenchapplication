<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
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
}
