@extends('layouts.admin')

@section('title', 'Course Builder - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Course Builder</h1>
        <p class="text-muted">Build and manage course content</p>
    </div>
    <div>
        <button class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>New Course
        </button>
    </div>
</div>

<div class="row">
    @forelse($courses as $course)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                        <span class="badge bg-secondary">{{ $course->lessons_count }} lessons</span>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.courses.builder', $course) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-tools me-1"></i>Open Builder
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-tools fs-1 text-muted"></i>
                <h4 class="mt-3">No courses available</h4>
                <p class="text-muted">Create your first course to get started</p>
                <button class="btn btn-primary">Create Course</button>
            </div>
        </div>
    @endforelse
</div>
@endsection
