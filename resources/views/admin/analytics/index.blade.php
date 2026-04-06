@extends('layouts.admin')

@section('title', 'Analytics & Reports - Admin Panel')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-1">Analytics & Reports</h2>
            <p class="text-muted mb-0">Platform performance and user insights</p>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($totalUsers) }}</h2>
                    <div class="text-muted small">Total Users</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="bi bi-book-fill fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($totalCourses) }}</h2>
                    <div class="text-muted small">Total Courses</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="bi bi-mortarboard-fill fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($totalEnrollments) }}</h2>
                    <div class="text-muted small">Total Enrollments</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-3">
                            <i class="bi bi-graph-up-arrow fs-4"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $completionRate }}%</h2>
                    <div class="text-muted small">Completion Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- User Growth Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">User Growth</h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="userGrowthChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- User Distribution Chart -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">User Distribution</h5>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <div style="width: 250px;">
                        <canvas id="userDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Top Courses -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">Top Performing Courses</h5>
                </div>
                <div class="card-body p-4">
                    @if($topCourses->count() > 0)
                        <div class="d-flex flex-column gap-4">
                            @foreach($topCourses as $course)
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-semibold text-dark">{{ $course->title }}</span>
                                        <small class="text-muted">{{ $course->completion_rate }}% completion</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="small text-muted">{{ ucfirst($course->level) }} Level</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                            style="width: {{ $course->completion_rate }}%"
                                            aria-valuenow="{{ $course->completion_rate }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No data available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">Recent Activity</h5>
                </div>
                <div class="card-body p-4">
                    @if($recentActivity->count() > 0)
                        <div class="d-flex flex-column gap-3">
                            @foreach($recentActivity as $activity)
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-circle-sm bg-{{ $activity['color'] }} bg-opacity-10 text-{{ $activity['color'] }} fw-bold rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            {{ $activity['initials'] }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 text-dark">{{ $activity['message'] }}</p>
                                        <small class="text-muted">{{ $activity['time']->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports Section -->
    <div class="row mt-4">
        <div class="col-12">
            <h4 class="fw-bold mb-3">Detailed Reports</h4>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3 d-inline-block">
                        <i class="bi bi-person-lines-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold">User Progress Report</h5>
                    <p class="text-muted small">Detailed user learning progress and completion stats.</p>
                    <a href="#" class="btn btn-sm btn-outline-primary stretched-link">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3 mb-3 d-inline-block">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                    <h5 class="fw-bold">Course Performance</h5>
                    <p class="text-muted small">Course completion rates and engagement metrics.</p>
                    <a href="#" class="btn btn-sm btn-outline-success stretched-link">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-3 mb-3 d-inline-block">
                        <i class="bi bi-calendar-range fs-4"></i>
                    </div>
                    <h5 class="fw-bold">Monthly Summary</h5>
                    <p class="text-muted small">Monthly platform statistics and growth analysis.</p>
                    <a href="#" class="btn btn-sm btn-outline-info stretched-link">View Report</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // User Growth Chart
            const ctxGrowth = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(ctxGrowth, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'New Users',
                        data: {!! json_encode($userGrowthData) !!},
                        borderColor: '#4F46E5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4F46E5',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [2, 4], color: '#f0f0f0' },
                            ticks: { stepSize: 1 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });

            // User Distribution Chart
            const ctxDist = document.getElementById('userDistributionChart').getContext('2d');
            new Chart(ctxDist, {
                type: 'doughnut',
                data: {
                    labels: ['Students', 'Teachers', 'Admins'],
                    datasets: [{
                        data: [{{ $studentCount }}, {{ $teacherCount }}, {{ $adminCount }}],
                        backgroundColor: ['#4F46E5', '#10B981', '#F59E0B'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
@endsection