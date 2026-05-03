@extends('layouts.app')

@section('title', 'Student Dashboard - TS Language Platform')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-1">
                                <i class="bi bi-sun me-2"></i>
                                Bonjour, {{ $user->name }}!
                            </h2>
                            <p class="mb-0 opacity-75">
                                Ready to continue your French learning journey? 
                                @if($currentStreak > 0)
                                    You're on a {{ $currentStreak }}-day streak! 🔥
                                @else
                                    Let's start building your study streak!
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex justify-content-md-end gap-3">
                                <div class="text-center">
                                    <div class="fs-4 fw-bold">{{ $user->level }}</div>
                                    <small class="opacity-75">Level</small>
                                </div>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold">{{ number_format($user->points) }}</div>
                                    <small class="opacity-75">Points</small>
                                </div>
                                <div class="text-center">
                                    <div class="fs-4 fw-bold">{{ $currentStreak }}</div>
                                    <small class="opacity-75">Day Streak</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-book text-primary fs-1 mb-2"></i>
                    <h5 class="card-title">{{ $totalCourses }}</h5>
                    <p class="card-text text-muted">Enrolled Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle text-success fs-1 mb-2"></i>
                    <h5 class="card-title">{{ $completedLessons }}</h5>
                    <p class="card-text text-muted">Lessons Completed</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-graph-up text-warning fs-1 mb-2"></i>
                    <h5 class="card-title">{{ $progressPercentage }}%</h5>
                    <p class="card-text text-muted">Overall Progress</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-trophy text-danger fs-1 mb-2"></i>
                    <h5 class="card-title">{{ $achievements->count() }}</h5>
                    <p class="card-text text-muted">Achievements</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- My Courses -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-book me-2"></i>
                        My Courses
                    </h5>
                    <a href="{{ route('student.courses') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($enrollments->count() > 0)
                        <div class="row">
                            @foreach($enrollments->take(4) as $enrollment)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $enrollment->course->title }}</h6>
                                            <p class="card-text small text-muted">
                                                {{ Str::limit($enrollment->course->description, 80) }}
                                            </p>
                                            
                                            <!-- Progress Bar -->
                                            @php
                                                $courseProgress = $enrollment->course->lessons->count() > 0 
                                                    ? round(($enrollment->course->lessons->where('lessonProgress.status', 'completed')->count() / $enrollment->course->lessons->count()) * 100)
                                                    : 0;
                                            @endphp
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between small">
                                                    <span>Progress</span>
                                                    <span>{{ $courseProgress }}%</span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $courseProgress }}%" 
                                                         aria-valuenow="{{ $courseProgress }}" 
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="bi bi-person me-1"></i>
                                                    {{ $enrollment->course->teacher->name }}
                                                </small>
                                                <a href="{{ route('student.course.show', $enrollment->course) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    Continue
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-book text-muted fs-1"></i>
                            <h6 class="mt-2">No Courses Yet</h6>
                            <p class="text-muted">Start your learning journey by enrolling in a course!</p>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                <i class="bi bi-search me-2"></i>
                                Browse Courses
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Activity -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Recent Activity
                    </h6>
                </div>
                <div class="card-body">
                    @if($recentProgress->count() > 0)
                        @foreach($recentProgress->take(5) as $progress)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    @if($progress->status === 'completed')
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <i class="bi bi-play-circle text-primary"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="small fw-semibold">{{ $progress->lesson->title }}</div>
                                    <div class="small text-muted">{{ $progress->lesson->course->title }}</div>
                                    <div class="small text-muted">{{ $progress->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">No recent activity</p>
                    @endif
                </div>
            </div>

            <!-- Achievements -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-trophy me-2"></i>
                        Recent Achievements
                    </h6>
                </div>
                <div class="card-body">
                    @if($achievements->count() > 0)
                        <div class="row">
                            @foreach($achievements->take(6) as $achievement)
                                <div class="col-4 text-center mb-3">
                                    <div class="achievement-badge">
                                        <i class="bi bi-award text-warning fs-3"></i>
                                        <div class="small mt-1">{{ $achievement->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No achievements yet</p>
                    @endif
                </div>
            </div>

            <!-- Recommended Courses -->
            @if($recommendedCourses->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="bi bi-lightbulb me-2"></i>
                            Recommended for You
                        </h6>
                    </div>
                    <div class="card-body">
                        @foreach($recommendedCourses as $course)
                            <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <h6 class="mb-1">{{ $course->title }}</h6>
                                <p class="small text-muted mb-2">{{ Str::limit($course->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.achievement-badge {
    transition: transform 0.2s ease;
}

.achievement-badge:hover {
    transform: scale(1.1);
}

.progress {
    background-color: #e9ecef;
}

.card {
    transition: box-shadow 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endpush
@endsection
