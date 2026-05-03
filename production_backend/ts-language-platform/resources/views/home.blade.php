@extends('layouts.app')

@section('title', 'TS Language Learning Platform - Master French Online')

@section('content')
<!-- Hero Section -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Master French with 
                    <span class="text-warning">TS Language Platform</span>
                </h1>
                <p class="lead mb-4">
                    Join thousands of learners on an interactive journey to fluency. 
                    Learn French with expert teachers, engaging lessons, and personalized progress tracking.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Start Learning Free
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-book me-2"></i>
                        Browse Courses
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative">
                    <!-- 3D Globe Animation Placeholder -->
                    <div class="globe-container">
                        <div class="globe">
                            <div class="globe-inner">
                                <div class="word-orbit">
                                    <span class="word word-1">Bonjour</span>
                                    <span class="word word-2">Merci</span>
                                    <span class="word word-3">Salut</span>
                                    <span class="word word-4">Au revoir</span>
                                    <span class="word word-5">Français</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-people text-primary fs-1 mb-3"></i>
                        <h3 class="fw-bold">{{ number_format($stats['total_students']) }}+</h3>
                        <p class="text-muted">Active Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-book text-success fs-1 mb-3"></i>
                        <h3 class="fw-bold">{{ number_format($stats['total_courses']) }}+</h3>
                        <p class="text-muted">French Courses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-play-circle text-warning fs-1 mb-3"></i>
                        <h3 class="fw-bold">{{ number_format($stats['total_lessons']) }}+</h3>
                        <p class="text-muted">Interactive Lessons</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-trophy text-danger fs-1 mb-3"></i>
                        <h3 class="fw-bold">{{ number_format($stats['total_enrollments']) }}+</h3>
                        <p class="text-muted">Course Completions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
@if($featuredCourses->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Courses</h2>
            <p class="text-muted">Start your French learning journey with our most popular courses</p>
        </div>
        <div class="row">
            @foreach($featuredCourses as $course)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                                @if($course->price == 0)
                                    <span class="badge bg-success">Free</span>
                                @else
                                    <span class="badge bg-warning">${{ $course->price }}</span>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $course->teacher->name }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $course->duration_hours }}h
                                </small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary w-100">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-lg">
                View All Courses
            </a>
        </div>
    </div>
</section>
@endif

<!-- How It Works -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">How It Works</h2>
            <p class="text-muted">Your path to French fluency in three simple steps</p>
        </div>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-plus fs-2"></i>
                    </div>
                </div>
                <h4>1. Sign Up</h4>
                <p class="text-muted">Create your account and choose your learning goals. Tell us your current French level.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="mb-4">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-book fs-2"></i>
                    </div>
                </div>
                <h4>2. Learn</h4>
                <p class="text-muted">Access interactive lessons, practice with native speakers, and track your progress.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="mb-4">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-trophy fs-2"></i>
                    </div>
                </div>
                <h4>3. Master</h4>
                <p class="text-muted">Achieve fluency through consistent practice and earn certificates for your accomplishments.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Students Say</h2>
            <p class="text-muted">Join thousands of satisfied learners</p>
        </div>
        <div class="row">
            @foreach($testimonials as $testimonial)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="rounded-circle mb-3" width="80" height="80">
                            <div class="mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $testimonial['rating'] ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </div>
                            <p class="card-text">"{{ $testimonial['content'] }}"</p>
                            <h6 class="fw-bold">{{ $testimonial['name'] }}</h6>
                            <small class="text-muted">{{ $testimonial['role'] }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to Start Your French Journey?</h2>
        <p class="lead mb-4">Join our community of learners and start speaking French with confidence.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Get Started Free
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Sign In
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
.min-vh-50 {
    min-height: 50vh;
}

/* 3D Globe Animation */
.globe-container {
    perspective: 1000px;
    width: 300px;
    height: 300px;
    margin: 0 auto;
}

.globe {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    animation: rotate 20s infinite linear;
}

.globe-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(45deg, #007bff, #0056b3);
    position: relative;
    box-shadow: 0 0 50px rgba(0, 123, 255, 0.3);
}

.word-orbit {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.word {
    position: absolute;
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
    animation: float 3s ease-in-out infinite;
}

.word-1 { top: 10%; left: 50%; transform: translateX(-50%); animation-delay: 0s; }
.word-2 { top: 30%; right: 10%; animation-delay: 0.6s; }
.word-3 { top: 50%; left: 10%; animation-delay: 1.2s; }
.word-4 { bottom: 30%; right: 20%; animation-delay: 1.8s; }
.word-5 { bottom: 10%; left: 50%; transform: translateX(-50%); animation-delay: 2.4s; }

@keyframes rotate {
    0% { transform: rotateY(0deg); }
    100% { transform: rotateY(360deg); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>
@endpush
@endsection
