@extends('layouts.admin')

@section('title', 'Manage Course Assignment - ' . $course->title)

@section('content')
    <style>
        /* Course Assignment Management Styles */
        .course-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .course-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .course-meta {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.enrolled {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.available {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-icon.lessons {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-icon.tests {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #718096;
            font-size: 0.9rem;
        }

        .students-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .student-card {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .student-card:hover {
            border-color: #cbd5e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .student-info {
            flex: 1;
        }

        .student-name {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .student-email {
            color: #718096;
            font-size: 0.9rem;
        }

        .student-meta {
            color: #a0aec0;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .student-card {
                flex-direction: column;
                text-align: center;
            }

            .student-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .action-buttons {
                margin-top: 1rem;
                justify-content: center;
            }
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.assignments.index') }}">Assignments</a></li>
                    <li class="breadcrumb-item active">{{ $course->title }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.assignments.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Assignments
            </a>
        </div>
    </div>

    <!-- Course Header -->
    <div class="course-header">
        <div class="course-title">{{ $course->title }}</div>
        <div class="course-meta">
            @if($course->description)
                {{ $course->description }}
            @else
                Manage student assignments for this course
            @endif
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon enrolled">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $enrolledStudents->count() }}</div>
            <div class="stat-label">Enrolled Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon available">
                <i class="bi bi-person-plus"></i>
            </div>
            <div class="stat-number">{{ $availableStudents->count() }}</div>
            <div class="stat-label">Available Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon lessons">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-number">{{ $course->lessons->count() }}</div>
            <div class="stat-label">Lessons</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon tests">
                <i class="bi bi-clipboard-check"></i>
            </div>
            <div class="stat-number">{{ $course->tests->count() }}</div>
            <div class="stat-label">Tests</div>
        </div>
    </div>

    <div class="row">
        <!-- Enrolled Students -->
        <div class="col-lg-6">
            <div class="students-section">
                <div class="section-header">
                    <h4 class="mb-0">Enrolled Students ({{ $enrolledStudents->count() }})</h4>
                </div>

                @forelse($enrolledStudents as $student)
                    <div class="student-card">
                        <div class="student-avatar">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div class="student-info">
                            <div class="student-name">{{ $student->name }}</div>
                            <div class="student-email">{{ $student->email }}</div>
                            <div class="student-meta">
                                Enrolled {{ $student->pivot->created_at->diffForHumans() }}
                                • Progress: {{ $student->pivot->progress_percentage ?? 0 }}%
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a class="btn btn-sm btn-outline-primary"
                                href="{{ route('admin.assignments.course.permissions', ['course' => $course->id, 'student_id' => $student->id]) }}"
                                title="Permissions">
                                <i class="bi bi-key"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="removeStudent({{ $student->id }}, '{{ $student->name }}')">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-people fs-3 text-muted"></i>
                        <p class="text-muted mt-2">No students enrolled yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Available Students -->
        <div class="col-lg-6">
            <div class="students-section">
                <div class="section-header">
                    <h4 class="mb-0">Available Students ({{ $availableStudents->count() }})</h4>
                    @if($availableStudents->count() > 0)
                        <button class="btn btn-sm btn-primary" onclick="assignAllStudents()">
                            <i class="bi bi-plus-circle me-2"></i>Assign All
                        </button>
                    @endif
                </div>

                @forelse($availableStudents as $student)
                    <div class="student-card">
                        <div class="student-avatar">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div class="student-info">
                            <div class="student-name">{{ $student->name }}</div>
                            <div class="student-email">{{ $student->email }}</div>
                            <div class="student-meta">
                                Joined {{ $student->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-success"
                                onclick="assignStudent({{ $student->id }}, '{{ $student->name }}')">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle fs-3 text-success"></i>
                        <p class="text-muted mt-2">All students are enrolled!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const courseId = {{ $course->id }};

            // Assign single student
            function assignStudent(studentId, studentName) {
                if (!confirm(`Assign ${studentName} to this course?`)) return;

                fetch(`/admin/assignments/course/${courseId}/assign`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        student_ids: [studentId]
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error assigning student', 'error');
                    });
            }

            // Remove student
            function removeStudent(studentId, studentName) {
                if (!confirm(`Remove ${studentName} from this course?`)) return;

                fetch(`/admin/assignments/course/${courseId}/unassign`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        student_id: studentId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error removing student', 'error');
                    });
            }

            // Assign all available students
            function assignAllStudents() {
                const availableCount = {{ $availableStudents->count() }};
                if (availableCount === 0) return;

                if (!confirm(`Assign all ${availableCount} available students to this course?`)) return;

                const studentIds = @json($availableStudents->pluck('id'));

                fetch(`/admin/assignments/course/${courseId}/assign`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        student_ids: studentIds
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error assigning students', 'error');
                    });
            }

            // Notification function
            function showNotification(message, type = 'info') {
                const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-info';
                const notification = document.createElement('div');
                notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }
        </script>
    @endpush
@endsection