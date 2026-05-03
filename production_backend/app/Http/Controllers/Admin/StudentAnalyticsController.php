<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentTestAttempt;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StudentAnalyticsController extends Controller
{
    /**
     * Show student analytics dashboard
     */
    public function show(User $student, Request $request)
    {
        // Ensure the user is a student
        if ($student->role !== 'student') {
            return redirect()->route('admin.dashboard')->with('error', 'Invalid student');
        }

        // Get filter parameters
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $courseId = $request->get('course_id');

        // Build cache key
        $cacheKey = "student_analytics:{$student->id}:{$dateFrom}:{$dateTo}:{$courseId}";

        // Get metrics with caching
        $metrics = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($student, $dateFrom, $dateTo, $courseId) {
            return $this->calculateMetrics($student, $dateFrom, $dateTo, $courseId);
        });

        // Get test history
        $testHistory = $this->getTestHistory($student, $dateFrom, $dateTo, $courseId);

        // Get available courses for filter
        $courses = Course::whereHas('tests.attempts', function ($q) use ($student) {
            $q->where('student_id', $student->id);
        })->get();

        return view('admin.students.analytics', compact('student', 'metrics', 'testHistory', 'courses', 'dateFrom', 'dateTo', 'courseId'));
    }

    /**
     * Get chart data for score progression
     */
    public function getChartData(User $student, Request $request): JsonResponse
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $courseId = $request->get('course_id');

        $query = StudentTestAttempt::where('student_id', $student->id)
            ->where('status', 'completed')
            ->with('test');

        if ($dateFrom) {
            $query->where('completed_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('completed_at', '<=', $dateTo);
        }
        if ($courseId) {
            $query->whereHas('test', function ($q) use ($courseId) {
                $q->where('course_id', $courseId);
            });
        }

        $attempts = $query->orderBy('completed_at')->get();

        return response()->json([
            'labels' => $attempts->map(fn($a) => $a->completed_at->format('M d, Y'))->values(),
            'scores' => $attempts->pluck('score')->values(),
            'testNames' => $attempts->map(fn($a) => $a->test->title)->values(),
            'courseNames' => $attempts->map(fn($a) => $a->test->course->title ?? 'N/A')->values(),
            'attempts' => $attempts->pluck('attempt_number')->values(),
            'passed' => $attempts->pluck('passed')->values()
        ]);
    }

    /**
     * Calculate performance metrics
     */
    private function calculateMetrics(User $student, $dateFrom = null, $dateTo = null, $courseId = null): array
    {
        $query = StudentTestAttempt::where('student_id', $student->id)
            ->where('status', 'completed');

        if ($dateFrom) {
            $query->where('completed_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('completed_at', '<=', $dateTo);
        }
        if ($courseId) {
            $query->whereHas('test', function ($q) use ($courseId) {
                $q->where('course_id', $courseId);
            });
        }

        $attempts = $query->get();
        $testsCompleted = $attempts->count();

        $avgScore = $testsCompleted > 0 ? round($attempts->avg('score'), 2) : 0;
        $totalTime = round($attempts->sum('time_taken') / 3600, 1); // Convert to hours
        $passRate = $testsCompleted > 0 ? round(($attempts->where('passed', true)->count() / $testsCompleted) * 100, 1) : 0;

        // Calculate improvement (compare last 5 tests to previous 5)
        $improvement = $this->calculateImprovement($student->id, $dateFrom, $dateTo, $courseId);

        return [
            'avg_score' => $avgScore,
            'tests_completed' => $testsCompleted,
            'total_time' => $totalTime,
            'current_streak' => $student->current_streak ?? 0,
            'pass_rate' => $passRate,
            'improvement' => $improvement,
            'points' => $student->points ?? 0,
            'level' => $student->level ?? 1
        ];
    }

    /**
     * Calculate improvement trend
     */
    private function calculateImprovement($studentId, $dateFrom = null, $dateTo = null, $courseId = null): float
    {
        $query = StudentTestAttempt::where('student_id', $studentId)
            ->where('status', 'completed');

        if ($dateFrom) {
            $query->where('completed_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('completed_at', '<=', $dateTo);
        }
        if ($courseId) {
            $query->whereHas('test', function ($q) use ($courseId) {
                $q->where('course_id', $courseId);
            });
        }

        $allAttempts = $query->orderBy('completed_at')->get();

        if ($allAttempts->count() < 2) {
            return 0;
        }

        // Compare last 5 tests to previous 5
        $recentTests = $allAttempts->take(-5);
        $previousTests = $allAttempts->slice(-10, 5);

        if ($previousTests->count() === 0) {
            return 0;
        }

        $recentAvg = $recentTests->avg('score');
        $previousAvg = $previousTests->avg('score');

        return round($recentAvg - $previousAvg, 2);
    }

    /**
     * Get test history with details
     */
    private function getTestHistory(User $student, $dateFrom = null, $dateTo = null, $courseId = null)
    {
        $query = StudentTestAttempt::where('student_id', $student->id)
            ->where('status', 'completed')
            ->with(['test.course']);

        if ($dateFrom) {
            $query->where('completed_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('completed_at', '<=', $dateTo);
        }
        if ($courseId) {
            $query->whereHas('test', function ($q) use ($courseId) {
                $q->where('course_id', $courseId);
            });
        }

        return $query->orderBy('completed_at', 'desc')->get();
    }

    /**
     * Show analytics for the authenticated student (student viewing own analytics)
     */
    public function showOwn(Request $request)
    {
        $student = auth()->user();

        // Redirect if not a student
        if ($student->role !== 'student') {
            return redirect()->route('dashboard')->with('error', 'Access denied');
        }

        return $this->show($student, $request);
    }

    /**
     * Get chart data for the authenticated student
     */
    public function getOwnChartData(Request $request): JsonResponse
    {
        $student = auth()->user();

        if ($student->role !== 'student') {
            return response()->json(['error' => 'Access denied'], 403);
        }

        return $this->getChartData($student, $request);
    }
}
