@extends('layouts.admin')

@section('title', 'Admin Dashboard - TS Language Platform')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-1">
                                <i class="bi bi-shield-check me-2"></i>
                                Admin Dashboard
                            </h2>
                            <p class="mb-0 opacity-75">
                                Welcome back, {{ auth()->user()->name }}. Here's what's happening on your platform.
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex justify-content-md-end gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-people me-1"></i>
                                    Manage Users
                                </a>
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-light btn-sm">
                                    <i class="bi bi-book me-1"></i>
                                    Manage Courses
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <i class="bi bi-people text-primary fs-1 mb-2"></i>
                    <h4 class="card-title">{{ number_format($totalUsers) }}</h4>
                    <p class="card-text text-muted">Total Users</p>
                    <div class="small">
                        <span class="text-success">{{ $totalStudents }} Students</span> • 
                        <span class="text-info">{{ $totalTeachers }} Teachers</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="bi bi-book text-success fs-1 mb-2"></i>
                    <h4 class="card-title">{{ number_format($totalCourses) }}</h4>
                    <p class="card-text text-muted">Total Courses</p>
                    <div class="small">
                        <span class="text-success">{{ $publishedCourses }} Published</span> • 
                        <span class="text-warning">{{ $draftCourses }} Draft</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <i class="bi bi-person-check text-warning fs-1 mb-2"></i>
                    <h4 class="card-title">{{ number_format($totalEnrollments) }}</h4>
                    <p class="card-text text-muted">Total Enrollments</p>
                    <div class="small">
                        <span class="text-success">{{ $activeEnrollments }} Active</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle text-danger fs-1 mb-2"></i>
                    <h4 class="card-title">{{ number_format($pendingTeachers) }}</h4>
                    <p class="card-text text-muted">Pending Approvals</p>
                    @if($pendingTeachers > 0)
                        <a href="{{ route('admin.users.index') }}?status=pending" class="btn btn-sm btn-outline-danger">
                            Review Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Health -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-heart-pulse me-2"></i>
                        System Health
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-database me-2 fs-4 
                                    {{ $systemHealth['database']['status'] === 'healthy' ? 'text-success' : 'text-danger' }}"></i>
                                <div>
                                    <div class="fw-semibold">Database</div>
                                    <small class="text-muted">{{ $systemHealth['database']['message'] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-folder me-2 fs-4 
                                    {{ $systemHealth['storage']['status'] === 'healthy' ? 'text-success' : 'text-warning' }}"></i>
                                <div>
                                    <div class="fw-semibold">Storage</div>
                                    <small class="text-muted">{{ $systemHealth['storage']['message'] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-lightning me-2 fs-4 
                                    {{ $systemHealth['cache']['status'] === 'healthy' ? 'text-success' : 'text-warning' }}"></i>
                                <div>
                                    <div class="fw-semibold">Cache</div>
                                    <small class="text-muted">{{ $systemHealth['cache']['message'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Users -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        Recent Users
                    </h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($recentUsers->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentUsers as $user)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            {{ $user->initials }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-{{ $user->role === 'student' ? 'primary' : ($user->role === 'teacher' ? 'success' : 'warning') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                        <div class="small text-muted">{{ $user->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No recent users</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-book me-2"></i>
                        Recent Courses
                    </h5>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($recentCourses->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentCourses as $course)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">{{ $course->title }}</div>
                                            <small class="text-muted">by {{ $course->teacher->name }}</small>
                                            <div class="mt-1">
                                                <span class="badge bg-{{ $course->status === 'published' ? 'success' : ($course->status === 'draft' ? 'secondary' : 'warning') }}">
                                                    {{ ucfirst($course->status) }}
                                                </span>
                                                <span class="badge bg-info">{{ ucfirst($course->level) }}</span>
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $course->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No recent courses</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Top Courses -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-trophy me-2"></i>
                        Top Performing Courses
                    </h5>
                </div>
                <div class="card-body">
                    @if($topCourses->count() > 0)
                        <div class="row">
                            @foreach($topCourses as $course)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $course->title }}</h6>
                                            <p class="card-text small text-muted">
                                                {{ Str::limit($course->description, 80) }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary">{{ $course->enrollments_count }} enrollments</span>
                                                <span class="badge bg-secondary">{{ ucfirst($course->level) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No courses available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.card {
    transition: box-shadow 0.2s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>
@endpush
@endsection
