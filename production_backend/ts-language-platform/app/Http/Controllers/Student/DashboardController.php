<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use App\Models\TestSubmission;
use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\StudentTestAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Removed constructor middleware - handled by routes

    public function index()
    {
        $user = Auth::user();

        // Get enrolled courses with progress
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.lessons', 'course.teacher'])
            ->get();

        // Calculate overall statistics
        $totalCourses = $enrollments->count();
        $completedLessons = LessonProgress::where('student_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $totalLessons = $enrollments->sum(function ($enrollment) {
            return $enrollment->course->lessons->count();
        });

        $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // Get recent activity
        $recentProgress = LessonProgress::where('student_id', $user->id)
            ->with(['lesson.course'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent test results
        $recentTests = TestSubmission::where('student_id', $user->id)
            ->with(['test.course'])
            ->orderBy('submitted_at', 'desc')
            ->limit(5)
            ->get();

        // Get achievements
        $achievements = $user->achievements()
            ->orderBy('user_achievements.earned_at', 'desc')
            ->limit(6)
            ->get();

        // Get recommended courses
        $recommendedCourses = Course::where('status', 'published')
            ->whereNotIn('id', $enrollments->pluck('course_id'))
            ->where('level', $user->language_level ?? 'beginner')
            ->limit(3)
            ->get();

        // Study streak calculation
        $currentStreak = $user->current_streak ?? 0;
        $longestStreak = $user->longest_streak ?? 0;

        return view('student.dashboard', compact(
            'user',
            'enrollments',
            'totalCourses',
            'completedLessons',
            'totalLessons',
            'progressPercentage',
            'recentProgress',
            'recentTests',
            'achievements',
            'recommendedCourses',
            'currentStreak',
            'longestStreak'
        ));
    }

    public function courses()
    {
        $user = Auth::user();

        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.lessons', 'course.teacher'])
            ->paginate(12);

        return view('student.courses', compact('enrollments'));
    }

    public function progress()
    {
        $user = Auth::user();

        // Get enrolled courses with progress
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.lessons', 'course.tests'])
            ->get();

        // Calculate statistics
        $totalCourses = $enrollments->count();
        $completedLessons = LessonProgress::where('student_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $completedTests = TestSubmission::where('student_id', $user->id)
            ->where('passed', true)
            ->count();

        // Calculate overall progress
        $totalLessons = $enrollments->sum(function ($enrollment) {
            return $enrollment->course->lessons->count();
        });
        $overallProgress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // Get course progress details
        $courseProgress = $enrollments->map(function ($enrollment) use ($user) {
            $course = $enrollment->course;
            $totalLessons = $course->lessons->count();
            $completedLessons = LessonProgress::where('student_id', $user->id)
                ->whereIn('lesson_id', $course->lessons->pluck('id'))
                ->where('status', 'completed')
                ->count();

            return [
                'course' => $course,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
                'last_activity' => LessonProgress::where('student_id', $user->id)
                    ->whereIn('lesson_id', $course->lessons->pluck('id'))
                    ->latest('updated_at')
                    ->first()?->updated_at?->diffForHumans(),
                'time_spent' => LessonProgress::where('student_id', $user->id)
                    ->whereIn('lesson_id', $course->lessons->pluck('id'))
                    ->sum('time_spent') ?: 0
            ];
        });

        // Get recent activity
        $recentActivity = LessonProgress::where('student_id', $user->id)
            ->with(['lesson.course'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($progress) {
                return [
                    'title' => $progress->status === 'completed' ? 'Completed lesson' : 'Started lesson',
                    'course' => $progress->lesson->course->title,
                    'date' => $progress->updated_at->diffForHumans(),
                    'description' => $progress->lesson->title
                ];
            });

        // Get real achievements data from database
        $achievements = collect([
            [
                'name' => 'First Steps',
                'description' => 'Complete your first lesson',
                'icon' => 'trophy',
                'earned' => $completedLessons > 0,
                'progress' => min(100, $completedLessons * 100),
                'earned_date' => $completedLessons > 0 ?
                    LessonProgress::where('student_id', $user->id)
                        ->where('status', 'completed')
                        ->oldest('completed_at')
                        ->first()?->completed_at?->diffForHumans() : null
            ],
            [
                'name' => 'Dedicated Learner',
                'description' => 'Complete 10 lessons',
                'icon' => 'award',
                'earned' => $completedLessons >= 10,
                'progress' => min(100, ($completedLessons / 10) * 100),
                'earned_date' => $completedLessons >= 10 ?
                    LessonProgress::where('student_id', $user->id)
                        ->where('status', 'completed')
                        ->skip(9)
                        ->first()?->completed_at?->diffForHumans() : null
            ],
            [
                'name' => 'Test Master',
                'description' => 'Pass 5 tests',
                'icon' => 'patch-check',
                'earned' => $completedTests >= 5,
                'progress' => min(100, ($completedTests / 5) * 100),
                'earned_date' => $completedTests >= 5 ?
                    TestSubmission::where('student_id', $user->id)
                        ->where('passed', true)
                        ->skip(4)
                        ->first()?->submitted_at?->diffForHumans() : null
            ]
        ]);

        $currentStreak = $user->current_streak ?? 0;

        return view('student.progress', compact(
            'totalCourses',
            'completedLessons',
            'completedTests',
            'overallProgress',
            'currentStreak',
            'courseProgress',
            'recentActivity',
            'achievements'
        ));
    }

    /**
     * Show a specific course
     */
    public function showCourse(Course $course)
    {
        // Check if user is enrolled in the course
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You must be enrolled in this course to access it.');
        }

        // Load course relationships
        $course->load(['lessons.contentBlocks', 'tests.questions']);

        // Calculate progress
        $totalLessons = $course->lessons->count();
        $completedLessons = LessonProgress::where('student_id', Auth::id())
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->where('status', 'completed')
            ->count();
        $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // Find next lesson
        $nextLesson = $course->lessons()
            ->whereNotIn('id', function($query) {
                $query->select('lesson_id')
                    ->from('lesson_progress')
                    ->where('student_id', Auth::id())
                    ->where('status', 'completed');
            })
            ->orderBy('order')
            ->first();

        // Get recent achievements for this course
        $recentAchievements = collect([]);

        // Check for course-specific achievements
        if ($completedLessons > 0 && $completedLessons == 1) {
            $recentAchievements->push([
                'name' => 'Course Started',
                'description' => 'Started learning ' . $course->title,
                'icon' => 'play-circle',
                'earned_date' => 'Recently'
            ]);
        }

        if ($progressPercentage >= 50) {
            $recentAchievements->push([
                'name' => 'Halfway There',
                'description' => 'Completed 50% of ' . $course->title,
                'icon' => 'speedometer',
                'earned_date' => 'Recently'
            ]);
        }

        $estimatedDuration = $course->duration_hours ?? 5;

        return view('student.course', compact(
            'course',
            'enrollment',
            'progressPercentage',
            'completedLessons',
            'totalLessons',
            'nextLesson',
            'recentAchievements',
            'estimatedDuration'
        ));
    }

    /**
     * Show a specific lesson
     */
    public function showLesson(Lesson $lesson)
    {
        // Check if user is enrolled in the course
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $lesson->course_id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You must be enrolled in this course to access this lesson.');
        }

        // Get lesson progress
        $progress = LessonProgress::where('student_id', Auth::id())
            ->where('lesson_id', $lesson->id)
            ->first();

        // Load lesson content blocks
        $lesson->load(['contentBlocks', 'course']);

        // Calculate lesson progress
        $totalBlocks = $lesson->contentBlocks->count();
        $currentBlock = 0; // Would track which block user is currently viewing
        $progressPercentage = $totalBlocks > 0 ? round((($currentBlock + 1) / $totalBlocks) * 100) : 0;
        $isCompleted = $progress && $progress->status === 'completed';

        // Find next lesson
        $nextLesson = Lesson::where('course_id', $lesson->course_id)
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        return view('student.lesson', compact(
            'lesson',
            'progress',
            'totalBlocks',
            'currentBlock',
            'progressPercentage',
            'isCompleted',
            'nextLesson'
        ));
    }

    /**
     * Complete a lesson
     */
    public function completeLesson(Request $request, Lesson $lesson)
    {
        // Check enrollment
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $lesson->course_id)
            ->first();

        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Not enrolled'], 403);
        }

        // Create or update lesson progress
        $progress = LessonProgress::updateOrCreate(
            [
                'student_id' => Auth::id(),
                'lesson_id' => $lesson->id
            ],
            [
                'status' => 'completed',
                'completed_at' => now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Lesson completed successfully!'
        ]);
    }

    /**
     * Show a specific test
     */
    public function showTest(Test $test)
    {
        // Check if user is enrolled in the course
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $test->course_id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You must be enrolled in this course to access this test.');
        }

        // Load test questions with options
        $test->load(['questions.options', 'course']);

        // Get user's attempts for this test
        $attempts = StudentTestAttempt::where('student_id', Auth::id())
            ->where('test_id', $test->id)
            ->orderBy('attempt_number', 'desc')
            ->get();

        // Check if user can take the test
        $canTakeTest = true;
        $attemptsLeft = $test->max_attempts;
        $currentAttempt = $attempts->count() + 1;

        if ($test->max_attempts && $attempts->count() >= $test->max_attempts) {
            $canTakeTest = false;
            $attemptsLeft = 0;
        } else if ($test->max_attempts) {
            $attemptsLeft = $test->max_attempts - $attempts->count();
        }

        // Check if there's an active attempt
        $activeAttempt = $attempts->where('status', 'in_progress')->first();

        // If no active attempt and user can take test, create one
        if (!$activeAttempt && $canTakeTest) {
            $activeAttempt = StudentTestAttempt::create([
                'student_id' => Auth::id(),
                'test_id' => $test->id,
                'attempt_number' => $currentAttempt,
                'status' => 'in_progress',
                'started_at' => now()
            ]);
        }

        // Calculate test data
        $totalQuestions = $test->questions->count();
        $currentQuestion = 0; // Starting question

        return view('student.test', compact(
            'test',
            'attempts',
            'canTakeTest',
            'attemptsLeft',
            'currentAttempt',
            'totalQuestions',
            'currentQuestion',
            'activeAttempt'
        ));
    }

    /**
     * Preview test (for admins/teachers)
     */
    public function previewTest(Test $test)
    {
        $user = Auth::user();

        // Allow admins and teachers to preview tests
        if (!$user || (!$user->isAdmin() && !$user->isTeacher())) {
            abort(403, 'Access denied. Admin or teacher role required.');
        }

        // Load test questions with options
        $test->load(['questions.options']);

        return view('student.test.preview', compact('test'));
    }

    /**
     * Preview lesson (for admins/teachers)
     */
    public function previewLesson(Lesson $lesson)
    {
        $user = Auth::user();

        // Allow admins and teachers to preview lessons
        if (!$user || (!$user->isAdmin() && !$user->isTeacher())) {
            abort(403, 'Access denied. Admin or teacher role required.');
        }

        // Load lesson content blocks
        $lesson->load('contentBlocks');

        return view('student.lesson.preview', compact('lesson'));
    }

    /**
     * Start a test attempt
     */
    public function startTest(Request $request, Test $test)
    {
        // Check enrollment and attempt limits
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $test->course_id)
            ->first();

        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Not enrolled in course'], 403);
        }

        $attempts = StudentTestAttempt::where('student_id', Auth::id())
            ->where('test_id', $test->id)
            ->count();

        if ($test->max_attempts && $attempts >= $test->max_attempts) {
            return response()->json(['success' => false, 'message' => 'Maximum attempts reached'], 403);
        }

        // Create new attempt
        $attempt = StudentTestAttempt::create([
            'student_id' => Auth::id(),
            'test_id' => $test->id,
            'attempt_number' => $attempts + 1,
            'status' => 'in_progress',
            'started_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'attempt_id' => $attempt->id,
            'redirect_url' => route('student.test.take', ['test' => $test->id, 'attempt' => $attempt->id])
        ]);
    }

    /**
     * Submit test answers
     */
    public function submitTest(Request $request, \App\Models\Test $test)
    {
        try {
            $request->validate([
                'test_id' => 'required|exists:tests,id',
                'answers' => 'required|array',
                'time_taken' => 'nullable|integer'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        }

        try {

        // Check enrollment
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $test->course_id)
            ->first();

        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Not enrolled in course'], 403);
        }

        // Get current attempt
        $currentAttempt = StudentTestAttempt::where('student_id', Auth::id())
            ->where('test_id', $test->id)
            ->where('status', 'in_progress')
            ->latest()
            ->first();

        if (!$currentAttempt) {
            return response()->json(['success' => false, 'message' => 'No active test attempt found'], 404);
        }

        // Load test questions with options
        $test->load('questions.options');

        // Calculate score
        $totalQuestions = $test->questions->count();
        $correctAnswers = 0;
        $answers = $request->answers;

        foreach ($test->questions as $index => $question) {
            $questionKey = (string)$index;
            $userAnswer = $answers[$questionKey] ?? null;

            if ($question->type === 'fill_blanks') {
                // Handle fill in the blanks
                $correctAnswerArray = $question->correct_answer ?? [];
                $userAnswerArray = is_array($userAnswer) ? $userAnswer : [];

                $correctCount = 0;
                foreach ($correctAnswerArray as $i => $correctAnswer) {
                    if (isset($userAnswerArray[$i]) &&
                        strtolower(trim($userAnswerArray[$i])) === strtolower(trim($correctAnswer))) {
                        $correctCount++;
                    }
                }

                if ($correctCount === count($correctAnswerArray)) {
                    $correctAnswers++;
                }
            } else {
                // Handle MCQ questions (mcq, mcq_image, audio, video, image_mcq)
                $correctOptionIndex = null;
                foreach ($question->options as $optionIndex => $option) {
                    if ($option->is_correct) {
                        $correctOptionIndex = $optionIndex;
                        break;
                    }
                }

                if ($userAnswer !== null && (int)$userAnswer === $correctOptionIndex) {
                    $correctAnswers++;
                }
            }
        }

        $scorePercentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        $passed = $scorePercentage >= $test->passing_score;

        // Update attempt (only status and completion time)
        $currentAttempt->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // Create test submission record
        TestSubmission::create([
            'student_id' => Auth::id(),
            'test_id' => $test->id,
            'score' => $scorePercentage,
            'passed' => $passed,
            'submitted_at' => now(),
            'answers' => $answers,
            'time_taken' => $request->time_taken,
            'attempt_number' => $currentAttempt->attempt_number
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Test submitted successfully',
            'redirect_url' => route('student.test.results', ['test' => $test->id, 'attempt' => $currentAttempt->id])
        ]);

        } catch (\Exception $e) {
            \Log::error('Test submission error', [
                'user_id' => Auth::id(),
                'test_id' => $test->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error submitting test: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show test results
     */
    public function showTestResults(\App\Models\Test $test, \App\Models\StudentTestAttempt $attempt)
    {
        // Verify the attempt belongs to the current user
        if ($attempt->student_id !== Auth::id()) {
            abort(403, 'Access denied.');
        }

        // Check enrollment
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $test->course_id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You must be enrolled in this course to view results.');
        }

        // Load test with questions and options
        $test->load(['questions.options', 'course']);

        // Get all attempts for this test
        $allAttempts = StudentTestAttempt::where('student_id', Auth::id())
            ->where('test_id', $test->id)
            ->orderBy('attempt_number', 'desc')
            ->get();

        // Check if user can retake the test
        $canRetake = true;
        $attemptsLeft = $test->max_attempts;

        if ($test->max_attempts && $allAttempts->count() >= $test->max_attempts) {
            $canRetake = false;
            $attemptsLeft = 0;
        } else if ($test->max_attempts) {
            $attemptsLeft = $test->max_attempts - $allAttempts->count();
        }

        // Calculate detailed results if test shows answers
        $detailedResults = null;
        if ($test->show_answers && $attempt->answers) {
            $detailedResults = [];
            foreach ($test->questions as $index => $question) {
                $questionKey = (string)$index;
                $userAnswer = $attempt->answers[$questionKey] ?? null;

                $result = [
                    'question' => $question,
                    'user_answer' => $userAnswer,
                    'is_correct' => false,
                    'correct_answer' => null
                ];

                if ($question->type === 'fill_blanks') {
                    $correctAnswers = $question->correct_answer ?? [];
                    $userAnswers = is_array($userAnswer) ? $userAnswer : [];

                    $result['correct_answer'] = $correctAnswers;
                    $result['is_correct'] = count($correctAnswers) === count(array_filter($correctAnswers, function($correct, $i) use ($userAnswers) {
                        return isset($userAnswers[$i]) && strtolower(trim($userAnswers[$i])) === strtolower(trim($correct));
                    }, ARRAY_FILTER_USE_BOTH));
                } else {
                    // MCQ questions
                    foreach ($question->options as $optionIndex => $option) {
                        if ($option->is_correct) {
                            $result['correct_answer'] = $optionIndex;
                            $result['is_correct'] = $userAnswer !== null && (int)$userAnswer === $optionIndex;
                            break;
                        }
                    }
                }

                $detailedResults[] = $result;
            }
        }

        return view('student.test.results', compact(
            'test',
            'attempt',
            'allAttempts',
            'canRetake',
            'attemptsLeft',
            'detailedResults'
        ));
    }
}
