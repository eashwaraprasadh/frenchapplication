@extends('layouts.app')

@section('title', 'Level ' . $level . ' Courses - TS Language Platform')

@section('content')
<style>
/* Shared premium card styles (reused from student/courses) */
.course-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%; }
.course-card:hover { transform: translateY(-8px); box-shadow: 0 8px 30px rgba(0,0,0,0.15); }
.course-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 1.5rem; position: relative; overflow: hidden; }
.course-header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 100%; background: rgba(255,255,255,0.1); border-radius: 50%; transform: rotate(45deg); }
.course-title { font-size: 1.25rem; font-weight: 600; margin-bottom: .5rem; position: relative; z-index: 1; }
.course-teacher { opacity: .9; font-size: .9rem; position: relative; z-index: 1; }
.course-body { padding: 1.5rem; }
.course-description { color: #6b7280; font-size: .9rem; line-height: 1.5; margin-bottom: 1.25rem; }
.progress-section { margin-bottom: 1.25rem; }
.progress-label { display: flex; justify-content: space-between; align-items: center; margin-bottom: .5rem; font-size: .9rem; font-weight: 500; }
.progress-bar-container { background: #f3f4f6; border-radius: 10px; height: 8px; overflow: hidden; }
.progress-bar { background: linear-gradient(90deg, #10b981 0%, #34d399 100%); height: 100%; border-radius: 10px; transition: width .3s ease; }
.course-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-bottom: 1.25rem; }
.stat-item { text-align: center; padding: .75rem; background: #f9fafb; border-radius: 8px; }
.stat-number { display: block; font-size: 1.25rem; font-weight: 600; color: #1f2937; }
.stat-label { font-size: .75rem; color: #6b7280; margin-top: .25rem; }
.course-actions { display: flex; gap: .75rem; }
.btn-continue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: #fff; padding: .75rem 1.5rem; border-radius: 8px; font-weight: 500; transition: all .3s ease; flex: 1; text-align: center; }
.btn-continue:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102,126,234,.4); color: #fff; }
.status-badge { position: absolute; top: 1rem; right: 1rem; padding: .25rem .75rem; border-radius: 20px; font-size: .75rem; font-weight: 500; z-index: 2; }
.status-active { background: rgba(16,185,129,.2); color: #059669; }

/* Page header styling with level-specific gradients */
.page-header { padding: 2.25rem 0; color: #fff; border-radius: 0 0 16px 16px; position: relative; overflow: hidden; background: linear-gradient(135deg, #3b82f6, #6366f1); }
.page-header::after { content: ''; position: absolute; bottom: -40px; right: -40px; width: 200px; height: 200px; background: rgba(255,255,255,.08); border-radius: 50%; }
.page-header h1 { font-weight: 700; }
.page-header p { opacity: .95; }
.page-header .btn { background: rgba(255,255,255,.2); color: #fff; border: none; }
.page-header .btn:hover { background: rgba(255,255,255,.3); color: #fff; }

/* Level-specific gradients applied to header and course cards */
.level-A1 .course-header, .level-A1.page-header { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); }
.level-A2 .course-header, .level-A2.page-header { background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%); }
.level-B1 .course-header, .level-B1.page-header { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }
.level-B2 .course-header, .level-B2.page-header { background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); }
.level-C1 .course-header, .level-C1.page-header { background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); }
.level-C2 .course-header, .level-C2.page-header { background: linear-gradient(135deg, #f43f5e 0%, #f97316 100%); }

/* Empty state */
.empty-state { text-align: center; padding: 3rem 1rem; background: #fff; border-radius: 12px; box-shadow: 0 3px 16px rgba(0,0,0,.06); }
.empty-icon { font-size: 3rem; color: #9ca3af; display: block; margin-bottom: .75rem; }
</style>

<div class="page-header level-{{ strtoupper($level) }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Level {{ strtoupper($level) }}</h1>
                <p class="mb-0 opacity-90">Your courses in this level</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('student.courses') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i>Back to Levels</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    @if($enrollments->count() > 0)
        <div class="row">
            @foreach($enrollments as $enrollment)
                @php
                    $course = $enrollment->course;
                    $totalLessons = $course->lessons->count();
                    $completedLessons = $course->lessons->where('lessonProgress.status', 'completed')->count();
                    $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
                    $status = $enrollment->status ?? 'active';
                @endphp
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-card">
                        <div class="course-header">
                            <div class="status-badge status-{{ $status }}">{{ ucfirst($status) }}</div>
                            <div class="course-title">{{ $course->title }}</div>
                            <div class="course-teacher"><i class="bi bi-person me-1"></i>{{ $course->teacher->name }}</div>
                        </div>
                        <div class="course-body">
                            <div class="course-description">{{ Str::limit($course->description, 120) }}</div>
                            <div class="progress-section">
                                <div class="progress-label d-flex justify-content-between">
                                    <span>Progress</span>
                                    <span class="fw-bold">{{ $progressPercentage }}%</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                            </div>
                            <div class="course-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ $allowedCountsByCourse[$course->id]['lessons'] ?? 0 }}</span>
                                    <div class="stat-label">Lessons</div>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $allowedCountsByCourse[$course->id]['tests'] ?? 0 }}</span>
                                    <div class="stat-label">Tests</div>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $completedLessons }}</span>
                                    <div class="stat-label">Completed</div>
                                </div>
                            </div>
                            <div class="course-actions">
                                <a href="{{ route('student.course.show', $course) }}" class="btn btn-continue w-100">
                                    <i class="bi bi-play-fill me-2"></i>{{ $progressPercentage > 0 ? 'Continue' : 'Start' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $enrollments->links() }}</div>
    @else
        <div class="empty-state">
            <i class="bi bi-book empty-icon"></i>
            <h3>No Courses in this Level</h3>
            <a href="{{ route('student.courses') }}" class="btn btn-primary mt-3"><i class="bi bi-arrow-left me-1"></i>Back to Levels</a>
        </div>
    @endif
</div>
@endsection

