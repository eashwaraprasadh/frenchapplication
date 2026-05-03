@extends('layouts.admin')

@section('title', 'Analytics - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Analytics & Reports</h1>
        <p class="text-muted">Platform performance and user insights</p>
    </div>
    <div>
        <button class="btn btn-outline-primary me-2">
            <i class="bi bi-download me-2"></i>Export Report
        </button>
        <button class="btn btn-primary">
            <i class="bi bi-graph-up me-2"></i>Generate Report
        </button>
    </div>
</div>

<!-- Key Metrics -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1 mb-2"></i>
                <h3 class="mb-0">{{ number_format($analytics['total_users']) }}</h3>
                <p class="mb-0">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card success">
            <div class="card-body text-center">
                <i class="bi bi-book fs-1 mb-2"></i>
                <h3 class="mb-0">{{ number_format($analytics['total_courses']) }}</h3>
                <p class="mb-0">Total Courses</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card warning">
            <div class="card-body text-center">
                <i class="bi bi-person-check fs-1 mb-2"></i>
                <h3 class="mb-0">{{ number_format($analytics['total_enrollments']) }}</h3>
                <p class="mb-0">Total Enrollments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card info">
            <div class="card-body text-center">
                <i class="bi bi-trophy fs-1 mb-2"></i>
                <h3 class="mb-0">{{ $analytics['completion_rate'] }}%</h3>
                <p class="mb-0">Completion Rate</p>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">User Growth</h5>
            </div>
            <div class="card-body">
                <div class="text-center py-5">
                    <i class="bi bi-graph-up fs-1 text-muted"></i>
                    <p class="text-muted mt-2">Chart will be implemented here</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">User Distribution</h5>
            </div>
            <div class="card-body">
                <div class="text-center py-4">
                    <i class="bi bi-pie-chart fs-1 text-muted"></i>
                    <p class="text-muted mt-2">Pie chart will be implemented here</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Course Performance -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top Performing Courses</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">French Basics</h6>
                            <small class="text-muted">Beginner Level</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">85% completion</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Advanced Grammar</h6>
                            <small class="text-muted">Advanced Level</small>
                        </div>
                        <span class="badge bg-success rounded-pill">78% completion</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Conversation Practice</h6>
                            <small class="text-muted">Intermediate Level</small>
                        </div>
                        <span class="badge bg-warning rounded-pill">65% completion</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">JD</div>
                            <div>
                                <h6 class="mb-1">John Doe completed French Basics</h6>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">MS</div>
                            <div>
                                <h6 class="mb-1">Mary Smith enrolled in Advanced Grammar</h6>
                                <small class="text-muted">4 hours ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">RJ</div>
                            <div>
                                <h6 class="mb-1">Robert Johnson started Conversation Practice</h6>
                                <small class="text-muted">6 hours ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Reports -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Detailed Reports</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card border">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text fs-2 text-primary mb-2"></i>
                        <h6>User Progress Report</h6>
                        <p class="text-muted small">Detailed user learning progress</p>
                        <button class="btn btn-outline-primary btn-sm">Generate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up fs-2 text-success mb-2"></i>
                        <h6>Course Performance</h6>
                        <p class="text-muted small">Course completion and engagement</p>
                        <button class="btn btn-outline-success btn-sm">Generate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check fs-2 text-warning mb-2"></i>
                        <h6>Monthly Summary</h6>
                        <p class="text-muted small">Monthly platform statistics</p>
                        <button class="btn btn-outline-warning btn-sm">Generate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
