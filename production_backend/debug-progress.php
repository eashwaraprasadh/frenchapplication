<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\User;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use App\Models\TestSubmission;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

// Find user with most completed lessons
$student = User::where('role', 'student')
    ->withCount([
        'lessonProgress as completed_lessons_count' => function ($query) {
            $query->where('status', 'completed');
        }
    ])
    ->orderByDesc('completed_lessons_count')
    ->first();

if (!$student) {
    echo "No student found.\n";
    exit;
}

echo "Analyzing data for student: {$student->name} (ID: {$student->id})\n";
echo "Total Completed Lessons (DB count): {$student->completed_lessons_count}\n";
echo "--------------------------------------------------\n";

// 1. Check Enrollments
$enrollments = Enrollment::where('user_id', $student->id)->with('course')->get();
echo "Enrollments count: " . $enrollments->count() . "\n";
$enrolledCourseIds = [];
foreach ($enrollments as $enrollment) {
    $enrolledCourseIds[] = $enrollment->course_id;
    echo "- Course: {$enrollment->course->title} (ID: {$enrollment->course_id})\n";
    $lessonCount = $enrollment->course->lessons()->count();
    $userLessonCount = LessonProgress::where('student_id', $student->id)
        ->whereIn('lesson_id', $enrollment->course->lessons()->pluck('id'))
        ->where('status', 'completed')
        ->count();
    echo "  Total Lessons: {$lessonCount}, Completed by User: {$userLessonCount}\n";
}
echo "\n";

// 2. Analyze Completed Lessons Distribution
echo "Distribution of Completed Lessons by Course:\n";
$completedLessons = LessonProgress::where('student_id', $student->id)
    ->where('status', 'completed')
    ->with('lesson.course')
    ->get();

$distribution = [];
foreach ($completedLessons as $progress) {
    if ($progress->lesson && $progress->lesson->course) {
        $courseTitle = $progress->lesson->course->title;
        $courseId = $progress->lesson->course_id;
        $key = "{$courseTitle} (ID: {$courseId})";
        if (!isset($distribution[$key])) {
            $distribution[$key] = 0;
        }
        $distribution[$key]++;
    } else {
        $key = "Orphaned/Deleted Lesson (Lesson ID: {$progress->lesson_id})";
        if (!isset($distribution[$key])) {
            $distribution[$key] = 0;
        }
        $distribution[$key]++;
    }
}

foreach ($distribution as $key => $count) {
    $isEnrolled = false;
    foreach ($enrolledCourseIds as $id) {
        if (strpos($key, "ID: {$id}") !== false) {
            $isEnrolled = true;
            break;
        }
    }
    echo "- {$key}: {$count} " . ($isEnrolled ? "[ENROLLED]" : "[NOT ENROLLED]") . "\n";
}

echo "\n";

// 3. Check Test Submissions
$totalSubmissions = TestSubmission::where('student_id', $student->id)->count();
$passedSubmissions = TestSubmission::where('student_id', $student->id)->where('passed', true)->count();
echo "Total Test Submissions: {$totalSubmissions}\n";
echo "Passed Tests: {$passedSubmissions}\n";
