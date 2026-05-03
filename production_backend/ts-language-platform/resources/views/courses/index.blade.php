@extends('layouts.app')

@section('title', 'French Courses - TS Language Platform')

@section('content')
<!-- Hero Section -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">French Courses</h1>
                <p class="lead mb-4">
                    Discover our comprehensive collection of French language courses designed for all skill levels.
                    From beginner basics to advanced conversation, find the perfect course for your learning journey.
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="bi bi-book display-1 opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">{{ $courses->total() }} courses available</h5>
            </div>
            <div class="col-md-6">
                <div class="row g-2">
                    <div class="col-md-6">
                        <select class="form-select" id="levelFilter">
                            <option value="">All Levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" id="priceFilter">
                            <option value="">All Prices</option>
                            <option value="free">Free</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="py-5">
    <div class="container">
        @if($courses->count() > 0)
            <div class="row" id="coursesGrid">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4 course-card" 
                         data-level="{{ $course->level }}" 
                         data-price="{{ $course->price == 0 ? 'free' : 'paid' }}">
                        <div class="card h-100 shadow-sm course-item">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $course->level === 'beginner' ? 'success' : ($course->level === 'intermediate' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                    @if($course->price == 0)
                                        <span class="badge bg-success">Free</span>
                                    @else
                                        <span class="badge bg-primary">${{ number_format($course->price, 2) }}</span>
                                    @endif
                                </div>
                                
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($course->description, 120) }}</p>
                                
                                <div class="row text-center mb-3">
                                    <div class="col-4">
                                        <small class="text-muted d-block">Duration</small>
                                        <strong>{{ $course->duration_hours }}h</strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Lessons</small>
                                        <strong>{{ $course->total_lessons }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Rating</small>
                                        <strong>
                                            @if($course->average_rating > 0)
                                                {{ number_format($course->average_rating, 1) }}
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @else
                                                <span class="text-muted">New</span>
                                            @endif
                                        </strong>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $course->teacher->name }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $course->total_enrollments }} students
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-grid">
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-primary">
                                        <i class="bi bi-eye me-2"></i>
                                        View Course
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $courses->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted mb-4"></i>
                <h3 class="text-muted">No courses found</h3>
                <p class="text-muted">Check back later for new courses or adjust your filters.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to Start Learning?</h2>
        <p class="lead mb-4">Join thousands of students already learning French with our expert instructors.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-person-plus me-2"></i>
                    Sign Up Free
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Sign In
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Go to Dashboard
                </a>
            @endguest
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const levelFilter = document.getElementById('levelFilter');
    const priceFilter = document.getElementById('priceFilter');
    const courseCards = document.querySelectorAll('.course-card');

    function filterCourses() {
        const selectedLevel = levelFilter.value;
        const selectedPrice = priceFilter.value;

        courseCards.forEach(card => {
            const cardLevel = card.dataset.level;
            const cardPrice = card.dataset.price;

            const levelMatch = !selectedLevel || cardLevel === selectedLevel;
            const priceMatch = !selectedPrice || cardPrice === selectedPrice;

            if (levelMatch && priceMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    levelFilter.addEventListener('change', filterCourses);
    priceFilter.addEventListener('change', filterCourses);
});
</script>
@endpush

@push('styles')
<style>
.course-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush
@endsection
