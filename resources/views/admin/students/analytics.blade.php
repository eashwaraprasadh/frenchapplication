@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Student Analytics - ' . $student->name)

@section('content')
    <style>
        .analytics-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.2);
            position: relative;
            overflow: hidden;
        }

        .analytics-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
        }

        .analytics-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            position: relative;
            z-index: 1;
        }

        .analytics-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .filter-card {
            background: white;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin-bottom: 2rem;
        }

        .form-label-custom {
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .form-control-custom {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.primary { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
        .stat-icon.success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .stat-icon.info { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
        .stat-icon.warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .stat-icon.danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1.2;
        }
        
        .stat-subtext {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header-styled {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid #f1f5f9;
            background: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title-styled {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .custom-table {
            width: 100%;
            margin: 0;
        }

        .custom-table th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            border-top: none;
        }

        .custom-table td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
        }

        .custom-table tbody tr {
            transition: background-color 0.2s;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge-soft {
            padding: 0.4em 0.8em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        
        .badge-soft-success { background: rgba(16, 185, 129, 0.1); color: #059669; }
        .badge-soft-danger { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
        .badge-soft-warning { background: rgba(245, 158, 11, 0.1); color: #d97706; }

        .action-btn {
            border-radius: 8px;
            padding: 0.4rem 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-icon {
            font-size: 3.5rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }
    </style>

    <div class="container-fluid py-4 pb-5">
        {{-- Header --}}
        <div class="analytics-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="analytics-title">Student Analytics</h1>
                <div class="analytics-subtitle"><i class="bi bi-person me-2"></i>{{ $student->name }} &bull; {{ $student->email }}</div>
            </div>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill px-4 fw-bold" style="z-index: 1;">
                    <i class="bi bi-arrow-left me-2"></i>Back to Users
                </a>
            @endif
        </div>

        {{-- Filters --}}
        <div class="filter-card">
            <form method="GET" action="{{ request()->url() }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="date_from" class="form-label form-label-custom">From Date</label>
                    <input type="date" class="form-control form-control-custom" id="date_from" name="date_from" value="{{ $dateFrom }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label form-label-custom">To Date</label>
                    <input type="date" class="form-control form-control-custom" id="date_to" name="date_to" value="{{ $dateTo }}">
                </div>
                <div class="col-md-4">
                    <label for="course_id" class="form-label form-label-custom">Course</label>
                    <select class="form-select form-control-custom" id="course_id" name="course_id">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold" style="padding: 0.6rem;">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- Performance Overview Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Average Score</div>
                        <div class="stat-icon primary"><i class="bi bi-bullseye"></i></div>
                    </div>
                    <div class="stat-value">{{ $metrics['avg_score'] }}%</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Tests Completed</div>
                        <div class="stat-icon success"><i class="bi bi-check2-square"></i></div>
                    </div>
                    <div class="stat-value">{{ $metrics['tests_completed'] }}</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Study Time</div>
                        <div class="stat-icon info"><i class="bi bi-clock-history"></i></div>
                    </div>
                    <div class="stat-value">{{ $metrics['total_time'] }}<span style="font-size:1.25rem;">h</span></div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Current Streak</div>
                        <div class="stat-icon warning"><i class="bi bi-fire"></i></div>
                    </div>
                    <div>
                        <span class="stat-value">{{ $metrics['current_streak'] }}</span>
                        <span class="stat-subtext ms-1">days</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Pass Rate</div>
                        <div class="stat-icon success"><i class="bi bi-award"></i></div>
                    </div>
                    <div class="stat-value">{{ $metrics['pass_rate'] }}%</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label">Improvement</div>
                        @if($metrics['improvement'] >= 0)
                            <div class="stat-icon success"><i class="bi bi-graph-up-arrow"></i></div>
                        @else
                            <div class="stat-icon danger"><i class="bi bi-graph-down-arrow"></i></div>
                        @endif
                    </div>
                    <div>
                        <span class="stat-value {{ $metrics['improvement'] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $metrics['improvement'] > 0 ? '+' : '' }}{{ $metrics['improvement'] }}%
                        </span>
                        <div class="stat-subtext">vs previous 5</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Score Progression Chart --}}
        <div class="content-card">
            <div class="card-header-styled">
                <div class="stat-icon primary" style="width:32px;height:32px;font-size:1rem;"><i class="bi bi-graph-up"></i></div>
                <h3 class="card-title-styled">Score Progression</h3>
            </div>
            <div class="card-body p-4">
                <canvas id="scoreChart" height="70"></canvas>
            </div>
        </div>

        {{-- Test History Table --}}
        <div class="content-card">
            <div class="card-header-styled">
                <div class="stat-icon info" style="width:32px;height:32px;font-size:1rem;"><i class="bi bi-list-check"></i></div>
                <h3 class="card-title-styled">Test History Logs</h3>
            </div>
            <div class="table-responsive">
                <table class="table custom-table mb-0">
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Score</th>
                            <th>Status</th>
                            <th>Time Spent</th>
                            <th>Attempt</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testHistory as $attempt)
                            <tr>
                                <td class="fw-bold text-dark">{{ $attempt->test->title }}</td>
                                <td>{{ $attempt->test->course->title ?? 'N/A' }}</td>
                                <td>{{ $attempt->completed_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge-soft {{ $attempt->score >= 70 ? 'badge-soft-success' : ($attempt->score >= 50 ? 'badge-soft-warning' : 'badge-soft-danger') }}">
                                        {{ $attempt->score }}%
                                    </span>
                                </td>
                                <td>
                                    @if($attempt->passed)
                                        <span class="badge-soft badge-soft-success"><i class="bi bi-check-circle-fill me-1"></i>Passed</span>
                                    @else
                                        <span class="badge-soft badge-soft-danger"><i class="bi bi-x-circle-fill me-1"></i>Failed</span>
                                    @endif
                                </td>
                                <td><i class="bi bi-stopwatch text-muted me-1"></i> {{ $attempt->time_taken ? gmdate('H:i:s', $attempt->time_taken) : '--:--:--' }}</td>
                                <td>{{ $attempt->attempt_number }}</td>
                                <td class="text-end">
                                    @php
                                        $submission = \App\Models\TestSubmission::where('student_id', $student->id)
                                            ->where('test_id', $attempt->test_id)
                                            ->where('attempt_number', $attempt->attempt_number)
                                            ->first();
                                    @endphp

                                    @if($submission && auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.test-submissions.show', $submission->id) }}"
                                            class="btn btn-outline-primary action-btn" title="View Submission">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    @elseif(auth()->user()->role === 'student')
                                        <a href="{{ route('student.test.results', ['test' => $attempt->test_id, 'attempt' => $attempt->id]) }}"
                                            class="btn btn-outline-primary action-btn" title="View Review">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    @else
                                        <span class="text-muted small">Not available</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="bi bi-folder-x empty-icon"></i>
                                        <h4 class="text-secondary fw-bold">No test attempts found</h4>
                                        <p class="text-muted mb-0">Complete a test to see your history and progression here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Fetch chart data and render
            const chartUrl = '{{ auth()->user()->role === "admin" ? route("admin.students.analytics.chart-data", $student) : route("student.analytics.chart-data") }}';
            const urlParams = new URLSearchParams(window.location.search);

            fetch(chartUrl + '?' + urlParams.toString())
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('scoreChart').getContext('2d');

                    // Color logic: Green for Pass (true), Red for Fail (false)
                    const pointColors = data.passed.map(p => p ? '#198754' : '#dc3545'); // Bootstrap success/danger
                    const pointRadiuses = data.passed.map(p => 6);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Test Scores (%)',
                                data: data.scores,
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                                pointBackgroundColor: pointColors,
                                pointBorderColor: pointColors,
                                pointRadius: pointRadiuses,
                                pointHoverRadius: 8,
                                tension: 0.3,
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    title: {
                                        display: true,
                                        text: 'Score (%)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Test Date'
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        title: function (context) {
                                            const idx = context[0].dataIndex;
                                            return `${data.testNames[idx]} (Attempt ${data.attempts[idx]})`;
                                        },
                                        label: function (context) {
                                            const idx = context.dataIndex;
                                            const course = data.courseNames[idx];
                                            const score = context.parsed.y;
                                            return [`Score: ${score}%`, `Course: ${course}`];
                                        }
                                    }
                                },
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        generateLabels: function (chart) {
                                            // Custom legend to explain colors
                                            return [
                                                {
                                                    text: 'Passed',
                                                    fillStyle: '#198754',
                                                    strokeStyle: '#198754',
                                                    lineWidth: 0,
                                                    hidden: false,
                                                    index: 0
                                                },
                                                {
                                                    text: 'Failed',
                                                    fillStyle: '#dc3545',
                                                    strokeStyle: '#dc3545',
                                                    lineWidth: 0,
                                                    hidden: false,
                                                    index: 1
                                                },
                                                {
                                                    text: 'Score Trend',
                                                    fillStyle: 'rgba(75, 192, 192, 0.1)',
                                                    strokeStyle: 'rgb(75, 192, 192)',
                                                    lineWidth: 2,
                                                    hidden: false,
                                                    index: 2
                                                }
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error loading chart data:', error);
                    document.getElementById('scoreChart').parentElement.innerHTML =
                        '<div class="alert alert-warning">Unable to load chart data</div>';
                });
        </script>
    @endpush
@endsection