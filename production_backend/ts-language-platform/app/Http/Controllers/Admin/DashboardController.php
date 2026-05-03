<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\TestSubmission;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware is now handled in routes/web.php
    }

    public function index()
    {
        // Platform Statistics
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $pendingTeachers = User::where('role', 'teacher')->where('status', 'pending')->count();

        $totalCourses = Course::count();
        $publishedCourses = Course::where('status', 'published')->count();
        $draftCourses = Course::where('status', 'draft')->count();
        $pendingCourses = Course::where('status', 'pending')->count();

        $totalEnrollments = Enrollment::count();
        $activeEnrollments = Enrollment::where('status', 'active')->count();

        // Recent Activity
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $recentCourses = Course::with('teacher')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Monthly Growth Data
        $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyEnrollments = Enrollment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Course Performance
        $topCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->limit(5)
            ->get();

        // System Health
        $systemHealth = [
            'database' => $this->checkDatabaseHealth(),
            'storage' => $this->checkStorageHealth(),
            'cache' => $this->checkCacheHealth(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStudents',
            'totalTeachers',
            'pendingTeachers',
            'totalCourses',
            'publishedCourses',
            'draftCourses',
            'pendingCourses',
            'totalEnrollments',
            'activeEnrollments',
            'recentUsers',
            'recentCourses',
            'recentEnrollments',
            'monthlyUsers',
            'monthlyEnrollments',
            'topCourses',
            'systemHealth'
        ));
    }

    public function users()
    {
        $users = User::when(request('role'), function($query) {
                return $query->where('role', request('role'));
            })
            ->when(request('status'), function($query) {
                return $query->where('status', request('status'));
            })
            ->when(request('search'), function($query) {
                return $query->where(function($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }



    public function settings()
    {
        return view('admin.settings.index');
    }

    /**
     * Show course builder page
     */
    public function courseBuilder()
    {
        $courses = Course::with('teacher')
            ->withCount(['lessons', 'enrollments'])
            ->latest()
            ->get();

        return view('admin.course-builder.index', compact('courses'));
    }

    /**
     * Show assignments page
     */
    public function assignments()
    {
        // Get real assignment data
        $courses = Course::with(['teacher', 'enrollments.user'])
            ->withCount('enrollments')
            ->get();

        return view('admin.assignments.index', compact('courses'));
    }

    /**
     * Show analytics page
     */
    public function analytics()
    {
        $analytics = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'total_enrollments' => Enrollment::count(),
            'completion_rate' => 0, // Calculate completion rate
        ];

        return view('admin.analytics.index', compact('analytics'));
    }

    /**
     * Show test submissions page
     */
    public function testSubmissions()
    {
        // Get real test submission data
        $submissions = TestSubmission::with(['test.course', 'student'])
            ->orderBy('submitted_at', 'desc')
            ->paginate(20);

        return view('admin.test-submissions.index', compact('submissions'));
    }

    /**
     * Show file management page
     */
    public function files()
    {
        // Get real file data from storage
        $uploadPath = storage_path('app/public');
        $files = collect();

        if (is_dir($uploadPath)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($uploadPath)
            );

            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $files->push([
                        'name' => $file->getFilename(),
                        'path' => str_replace($uploadPath, '', $file->getPathname()),
                        'size' => $file->getSize(),
                        'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                        'type' => $file->getExtension()
                    ]);
                }
            }
        }

        return view('admin.files.index', compact('files'));
    }

    private function checkDatabaseHealth()
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'healthy', 'message' => 'Database connection successful'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Database connection failed'];
        }
    }

    private function checkStorageHealth()
    {
        $storagePath = storage_path('app');
        if (is_writable($storagePath)) {
            return ['status' => 'healthy', 'message' => 'Storage is writable'];
        }
        return ['status' => 'warning', 'message' => 'Storage permission issues'];
    }

    private function checkCacheHealth()
    {
        try {
            cache()->put('health_check', 'ok', 60);
            $value = cache()->get('health_check');
            return ['status' => 'healthy', 'message' => 'Cache is working'];
        } catch (\Exception $e) {
            return ['status' => 'warning', 'message' => 'Cache issues detected'];
        }
    }
}
