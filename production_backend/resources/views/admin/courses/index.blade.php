@extends('layouts.admin')

@section('title', 'Course Management - Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-1">
                                <i class="bi bi-book me-2"></i>
                                Course Management
                            </h2>
                            <p class="mb-0 opacity-75">
                                Create, edit, and manage all courses on the platform
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-plus-circle me-2"></i>
                                Create New Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="search" 
                                   value="{{ request('search') }}" placeholder="Course title or description...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="">All Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level">
                                <option value="">All Levels</option>
                                <optgroup label="Beginner">
                                    <option value="A1" {{ request('level') === 'A1' ? 'selected' : '' }}>A1</option>
                                    <option value="A2" {{ request('level') === 'A2' ? 'selected' : '' }}>A2</option>
                                </optgroup>
                                <optgroup label="Intermediate">
                                    <option value="B1" {{ request('level') === 'B1' ? 'selected' : '' }}>B1</option>
                                    <option value="B2" {{ request('level') === 'B2' ? 'selected' : '' }}>B2</option>
                                </optgroup>
                                <optgroup label="Advanced">
                                    <option value="C1" {{ request('level') === 'C1' ? 'selected' : '' }}>C1</option>
                                    <option value="C2" {{ request('level') === 'C2' ? 'selected' : '' }}>C2</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Language</label>
                            <select class="form-select" name="language">
                                <option value="">All Languages</option>
                                <option value="french" {{ request('language') === 'french' ? 'selected' : '' }}>French</option>
                                <option value="german" {{ request('language') === 'german' ? 'selected' : '' }}>German</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-1"></i>
                                    Filter
                                </button>
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-list me-2"></i>
                        All Courses ({{ $courses->total() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($courses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Teacher</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Enrollments</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>
                                                <div>
                                                    <div class="fw-semibold">{{ $course->title }}</div>
                                                    <small class="text-muted">{{ Str::limit($course->description, 60) }}</small>
                                                    <div class="mt-1">
                                                        <span class="badge bg-info">{{ ucfirst($course->language) }}</span>
                                                        @if($course->featured)
                                                            <span class="badge bg-warning">Featured</span>
                                                        @endif
                                                        @if($course->price == 0)
                                                            <span class="badge bg-success">Free</span>
                                                        @else
                                                            <span class="badge bg-primary">${{ number_format($course->price, 2) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-2">
                                                        {{ $course->teacher->initials }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $course->teacher->name }}</div>
                                                        <small class="text-muted">{{ $course->teacher->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $levelColors = [
                                                        'A1' => 'success', 'A2' => 'success',
                                                        'B1' => 'warning', 'B2' => 'warning',
                                                        'C1' => 'danger', 'C2' => 'danger'
                                                    ];
                                                    $levelDescriptions = [
                                                        'A1' => 'A1 - Breakthrough',
                                                        'A2' => 'A2 - Waystage',
                                                        'B1' => 'B1 - Threshold',
                                                        'B2' => 'B2 - Vantage',
                                                        'C1' => 'C1 - Proficiency',
                                                        'C2' => 'C2 - Mastery'
                                                    ];
                                                @endphp
                                                <span class="badge bg-{{ $levelColors[$course->level] ?? 'secondary' }}"
                                                      title="{{ $levelDescriptions[$course->level] ?? $course->level }}">
                                                    {{ $course->level }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $course->status === 'published' ? 'success' : ($course->status === 'draft' ? 'secondary' : 'warning') }}">
                                                    {{ ucfirst($course->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ number_format($course->total_enrollments) }}</strong>
                                                <small class="text-muted d-block">students</small>
                                            </td>
                                            <td>
                                                <div>{{ $course->created_at->format('M j, Y') }}</div>
                                                <small class="text-muted">{{ $course->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.courses.show', $course) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="View Course">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.courses.edit', $course) }}" 
                                                       class="btn btn-sm btn-outline-warning" title="Edit Course">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.courses.builder', $course) }}" 
                                                       class="btn btn-sm btn-outline-success" title="Course Builder">
                                                        <i class="bi bi-tools"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="deleteCourse({{ $course->id }})" title="Delete Course">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $courses->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-book display-1 text-muted mb-4"></i>
                            <h4 class="text-muted">No courses found</h4>
                            <p class="text-muted">Create your first course to get started.</p>
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>
                                Create Course
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteCourse(courseId) {
    if (confirm('Are you sure you want to delete this course? This action cannot be undone.')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/courses/${courseId}`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush

@push('styles')
<style>
.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.btn-group .btn {
    border-radius: 0.375rem;
    margin-right: 2px;
}
</style>
@endpush
@endsection
