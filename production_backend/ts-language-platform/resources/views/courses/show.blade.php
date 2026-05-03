@extends('layouts.app')

@section('title', $course->title . ' - TS Language Platform')

@section('content')
<!-- Course Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-white-50">Courses</a></li>
                        <li class="breadcrumb-item active text-white">{{ $course->title }}</li>
                    </ol>
                </nav>
                
                <div class="d-flex gap-2 mb-3">
                    <span class="badge bg-{{ $course->level === 'beginner' ? 'success' : ($course->level === 'intermediate' ? 'warning' : 'danger') }} fs-6">
                        {{ ucfirst($course->level) }}
                    </span>
                    @if($course->price == 0)
                        <span class="badge bg-success fs-6">Free Course</span>
                    @else
                        <span class="badge bg-warning fs-6">${{ number_format($course->price, 2) }}</span>
                    @endif
                </div>
                
                <h1 class="display-5 fw-bold mb-3">{{ $course->title }}</h1>
                <p class="lead mb-4">{{ $course->description }}</p>
                
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="bg-white bg-opacity-10 rounded p-3">
                            <i class="bi bi-clock fs-4 mb-2 d-block"></i>
                            <strong>{{ $course->duration_hours }} Hours</strong>
                            <small class="d-block">Duration</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="bg-white bg-opacity-10 rounded p-3">
                            <i class="bi bi-play-circle fs-4 mb-2 d-block"></i>
                            <strong>{{ $course->total_lessons }}</strong>
                            <small class="d-block">Lessons</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="bg-white bg-opacity-10 rounded p-3">
                            <i class="bi bi-people fs-4 mb-2 d-block"></i>
                            <strong>{{ $course->total_enrollments }}</strong>
                            <small class="d-block">Students</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="bg-white bg-opacity-10 rounded p-3">
                            <i class="bi bi-star fs-4 mb-2 d-block"></i>
                            <strong>
                                @if($course->average_rating > 0)
                                    {{ number_format($course->average_rating, 1) }}
                                @else
                                    New
                                @endif
                            </strong>
                            <small class="d-block">Rating</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="bg-white bg-opacity-10 rounded p-4">
                    <i class="bi bi-book display-1 mb-3 d-block"></i>
                    @auth
                        @if(auth()->user()->role === 'student')
                            <div class="d-grid">
                                <button class="btn btn-warning btn-lg mb-3" onclick="enrollInCourse()">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Enroll Now
                                </button>
                                <small class="text-white-50">Start learning immediately</small>
                            </div>
                        @else
                            <p class="text-white-50">Course preview available</p>
                        @endif
                    @else
                        <div class="d-grid gap-2">
                            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-person-plus me-2"></i>
                                Sign Up to Enroll
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Sign In
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Course Description -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            About This Course
                        </h4>
                    </div>
                    <div class="card-body">
                        <p>{{ $course->description }}</p>
                        
                        <h6 class="fw-bold mt-4 mb-3">What You'll Learn:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Essential French vocabulary and phrases</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Proper pronunciation and accent training</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Grammar fundamentals and sentence structure</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Conversational skills for real-world situations</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Cultural insights and context</li>
                        </ul>
                    </div>
                </div>

                <!-- Course Curriculum -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-list-ul me-2"></i>
                            Course Curriculum
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($course->lessons->count() > 0)
                            <div class="accordion" id="curriculumAccordion">
                                @foreach($course->lessons->groupBy('folder_id') as $folderId => $lessons)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#folder{{ $folderId ?? 'main' }}">
                                                <i class="bi bi-folder me-2"></i>
                                                {{ $folderId ? 'Module ' . $folderId : 'Main Lessons' }}
                                                <span class="badge bg-primary ms-2">{{ $lessons->count() }} lessons</span>
                                            </button>
                                        </h2>
                                        <div id="folder{{ $folderId ?? 'main' }}" class="accordion-collapse collapse" data-bs-parent="#curriculumAccordion">
                                            <div class="accordion-body">
                                                @foreach($lessons as $lesson)
                                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                        <div>
                                                            <i class="bi bi-play-circle me-2 text-primary"></i>
                                                            <strong>{{ $lesson->title }}</strong>
                                                            @if($lesson->description)
                                                                <p class="text-muted small mb-0 ms-4">{{ Str::limit($lesson->description, 100) }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="text-end">
                                                            <small class="text-muted">{{ $lesson->estimated_duration }} min</small>
                                                            @auth
                                                                @if(auth()->user()->role === 'student')
                                                                    <br><small class="badge bg-secondary">Preview</small>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-book text-muted fs-1 mb-3"></i>
                                <p class="text-muted">Course curriculum is being prepared. Check back soon!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Instructor Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-person me-2"></i>
                            Your Instructor
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->teacher->name) }}&color=7F9CF5&background=EBF4FF&size=100" 
                             alt="{{ $course->teacher->name }}" class="rounded-circle mb-3" width="100" height="100">
                        <h6 class="fw-bold">{{ $course->teacher->name }}</h6>
                        @if($course->teacher->bio)
                            <p class="text-muted small">{{ Str::limit($course->teacher->bio, 150) }}</p>
                        @endif
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <strong class="d-block">{{ $course->teacher->role === 'admin' ? 'Platform' : 'Expert' }}</strong>
                                <small class="text-muted">Instructor</small>
                            </div>
                            <div class="col-6">
                                <strong class="d-block">{{ $course->teacher->created_at->diffForHumans() }}</strong>
                                <small class="text-muted">Teaching Since</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Features -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-star me-2"></i>
                            Course Features
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Interactive lessons
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Progress tracking
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Quizzes and tests
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Mobile friendly
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Lifetime access
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Certificate of completion
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function enrollInCourse() {
    // This would typically make an AJAX request to enroll the user
    alert('Enrollment functionality will be implemented in the student dashboard!');
}
</script>
@endpush
@endsection
