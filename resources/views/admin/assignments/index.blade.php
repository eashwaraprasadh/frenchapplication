@extends('layouts.admin')

@section('title', 'Course Assignments - Admin Panel')

@section('content')
<style>
/* Course Assignment Styles */
.assignment-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.assignment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.course-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.course-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.course-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.25rem;
}

.course-meta {
    color: #718096;
    font-size: 0.9rem;
}

.stats-row {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.stat-item {
    text-align: center;
    flex: 1;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 600;
    color: #667eea;
}

.stat-label {
    font-size: 0.8rem;
    color: #718096;
    margin-top: 0.25rem;
}

.action-buttons {
    display: flex;
    gap: 0.75rem;
}

.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.summary-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.summary-icon.courses {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.summary-icon.students {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.summary-icon.enrollments {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.summary-number {
    font-size: 2rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.summary-label {
    color: #718096;
    font-size: 0.9rem;
}

.recent-enrollments {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.enrollment-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.enrollment-item:last-child {
    border-bottom: none;
}

.enrollment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    margin-right: 1rem;
}

.enrollment-info {
    flex: 1;
}

.enrollment-name {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.25rem;
}

.enrollment-course {
    color: #718096;
    font-size: 0.9rem;
}

.enrollment-date {
    color: #a0aec0;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
        gap: 1rem;
    }

    .action-buttons {
        flex-direction: column;
    }

    .summary-cards {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Course Assignments</h1>
        <p class="text-muted">Assign courses to students and manage enrollments</p>
    </div>
    <div>
        <button class="btn btn-primary" onclick="showBulkAssignModal()">
            <i class="bi bi-people me-2"></i>Bulk Assignment
        </button>
    </div>
</div>

<!-- Summary Cards -->
<div class="summary-cards">
    <div class="summary-card">
        <div class="summary-icon courses">
            <i class="bi bi-book"></i>
        </div>
        <div class="summary-number">{{ $courses->count() }}</div>
        <div class="summary-label">Total Courses</div>
    </div>
    <div class="summary-card">
        <div class="summary-icon students">
            <i class="bi bi-people"></i>
        </div>
        <div class="summary-number">{{ $students->count() }}</div>
        <div class="summary-label">Total Students</div>
    </div>
    <div class="summary-card">
        <div class="summary-icon enrollments">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="summary-number">{{ $recentEnrollments->count() }}</div>
        <div class="summary-label">Recent Enrollments</div>
    </div>
</div>

<div class="row">
    <!-- Courses List -->
    <div class="col-lg-8">
        <h4 class="mb-3">Courses</h4>
        @forelse($courses as $course)
            <div class="assignment-card">
                <div class="course-header">
                    <div class="course-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="course-title">{{ $course->title }}</div>
                        <div class="course-meta">
                            Created {{ $course->created_at->diffForHumans() }}
                            @if($course->teacher)
                                • by {{ $course->teacher->name }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="stats-row">
                    <div class="stat-item">
                        <span class="stat-number">{{ $course->enrollments_count }}</span>
                        <div class="stat-label">Students</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $course->lessons_count }}</span>
                        <div class="stat-label">Lessons</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $course->tests_count }}</span>
                        <div class="stat-label">Tests</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.assignments.course.show', $course) }}" class="btn btn-primary">
                        <i class="bi bi-people me-2"></i>Manage Students
                    </a>
                    <a href="{{ route('admin.courses.builder', $course) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-pencil me-2"></i>Edit Course
                    </a>
                    <button class="btn btn-outline-info" onclick="viewCourseDetails({{ $course->id }})">
                        <i class="bi bi-eye me-2"></i>View Details
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-book fs-1 text-muted"></i>
                <h4 class="mt-3">No Courses Found</h4>
                <p class="text-muted">Create your first course to start assigning students.</p>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create Course
                </a>
            </div>
        @endforelse
    </div>

    <!-- Recent Enrollments -->
    <div class="col-lg-4">
        <h4 class="mb-3">Recent Enrollments</h4>
        <div class="recent-enrollments">
            @forelse($recentEnrollments as $enrollment)
                <div class="enrollment-item">
                    <div class="enrollment-avatar">
                        {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                    </div>
                    <div class="enrollment-info">
                        <div class="enrollment-name">{{ $enrollment->user->name }}</div>
                        <div class="enrollment-course">{{ $enrollment->course->title }}</div>
                        <div class="enrollment-date">{{ $enrollment->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="bi bi-clock-history fs-3 text-muted"></i>
                    <p class="text-muted mt-2">No recent enrollments</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Bulk Assignment Modal -->
<div class="modal fade" id="bulkAssignModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Course Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bulkAssignForm">
                    @csrf
                    <div class="mb-3">
                        <label for="bulk_course_id" class="form-label">Select Course</label>
                        <select class="form-select" id="bulk_course_id" name="course_id" required>
                            <option value="">Choose a course...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Students</label>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            <div class="mb-2">
                                <input type="checkbox" id="selectAllStudents" class="form-check-input">
                                <label for="selectAllStudents" class="form-check-label fw-bold">Select All Students</label>
                            </div>
                            <hr>
                            @foreach($students as $student)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input student-checkbox"
                                           id="student_{{ $student->id }}" name="student_ids[]" value="{{ $student->id }}">
                                    <label class="form-check-label" for="student_{{ $student->id }}">
                                        {{ $student->name }} ({{ $student->email }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitBulkAssignment()">
                    <i class="bi bi-check-circle me-2"></i>Assign Students
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Course Details Modal -->
<div class="modal fade" id="courseDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Course Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="courseDetailsContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Show bulk assignment modal
function showBulkAssignModal() {
    const modal = new bootstrap.Modal(document.getElementById('bulkAssignModal'));
    modal.show();
}

// Handle select all students checkbox
document.getElementById('selectAllStudents').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.student-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Submit bulk assignment
function submitBulkAssignment() {
    const form = document.getElementById('bulkAssignForm');
    const formData = new FormData(form);
    const courseId = formData.get('course_id');
    const studentIds = formData.getAll('student_ids[]');

    if (!courseId) {
        showNotification('Please select a course', 'error');
        return;
    }

    if (studentIds.length === 0) {
        showNotification('Please select at least one student', 'error');
        return;
    }

    // Show loading state
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Assigning...';
    submitBtn.disabled = true;

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
            // Close modal and refresh page
            bootstrap.Modal.getInstance(document.getElementById('bulkAssignModal')).hide();
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error assigning students', 'error');
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

// View course details
function viewCourseDetails(courseId) {
    const modal = new bootstrap.Modal(document.getElementById('courseDetailsModal'));
    const content = document.getElementById('courseDetailsContent');

    content.innerHTML = '<div class="text-center py-4"><i class="bi bi-hourglass-split"></i> Loading...</div>';
    modal.show();

    fetch(`/admin/assignments/course/${courseId}/data`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const course = data.course;
                const students = data.enrolled_students;

                content.innerHTML = `
                    <div class="course-details">
                        <h4>${course.title}</h4>
                        <p class="text-muted">${course.description || 'No description available'}</p>

                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="stat-number">${students.length}</div>
                                <div class="stat-label">Enrolled Students</div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="stat-number">${course.lessons_count}</div>
                                <div class="stat-label">Lessons</div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="stat-number">${course.tests_count}</div>
                                <div class="stat-label">Tests</div>
                            </div>
                        </div>

                        <h5>Enrolled Students</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Enrolled</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${students.map(student => `
                                        <tr>
                                            <td>${student.name}</td>
                                            <td>${student.email}</td>
                                            <td>${student.enrolled_at}</td>
                                            <td>${student.progress}%</td>
                                            <td><span class="badge bg-success">${student.status}</span></td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            } else {
                content.innerHTML = '<div class="text-center py-4 text-danger">Error loading course details</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            content.innerHTML = '<div class="text-center py-4 text-danger">Error loading course details</div>';
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
