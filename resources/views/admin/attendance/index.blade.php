@extends('layouts.admin')

@section('title', 'Student Attendance Management')

@push('styles')
<style>
    /* Prevent dropdown clipping in responsive tables */
    .table-responsive {
        overflow: visible !important;
        min-height: 350px; /* Ensures space for dropdowns in sparse tables */
    }
    
    .dropdown-menu {
        z-index: 1050; /* Ensure it stays above other content */
    }

    /* Mobile handling: keep responsive scrolling but allow overflow if possible */
    @media (max-width: 991.98px) {
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 60px; /* Space for the last row dropdown */
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 fw-bold mb-1">Attendance Management</h2>
            <p class="text-muted">Review and approve student attendance records</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.attendance.sessions.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-calendar-event"></i> Manage Sessions
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.attendance.index') }}" method="GET" class="row gx-3 gy-2 align-items-end">
                <div class="col-sm-5 col-md-4">
                    <label class="form-label fw-bold small text-muted">Date</label>
                    <div class="input-group">
                        <a href="{{ route('admin.attendance.index', ['date' => \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d')]) }}" class="btn btn-outline-secondary" title="Previous Day">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <input type="date" name="date" class="form-control text-center text-primary fw-medium" value="{{ $date }}" onchange="this.form.submit()">
                        <a href="{{ route('admin.attendance.index', ['date' => \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d')]) }}" class="btn btn-outline-secondary" title="Next Day">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-5 col-md-4">
                    <label class="form-label fw-bold small text-muted">Session</label>
                    <select name="session_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Sessions for this Date</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ $sessionId == $session->id ? 'selected' : '' }}>
                                {{ $session->title }} ({{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <noscript><button type="submit" class="btn btn-primary">Filter</button></noscript>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.attendance.bulk-approve') }}" method="POST" id="bulkApproveForm">
                @csrf
                
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <h5 class="fw-bold mb-0">
                        Records for {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                        @if($selectedSessionTitle)
                            — <span class="text-primary">{{ $selectedSessionTitle }}</span>
                        @endif
                    </h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#createSessionModal">
                            <i class="bi bi-plus-circle me-1"></i> Add Session for {{ \Carbon\Carbon::parse($date)->format('M d') }}
                        </button>
                        <button type="submit" class="btn btn-success rounded-pill btn-sm" id="bulkApproveBtn" disabled>
                            <i class="bi bi-check-all me-1"></i> Approve Selected
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Session</th>
                                <th>Date</th>
                                <th>Submitted Status</th>
                                <th>Approval Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $record)
                                <tr>
                                    <td>
                                        @if($record->approval_status === 'pending')
                                            <input type="checkbox" class="form-check-input attendance-checkbox" name="attendance_ids[]" value="{{ $record->id }}">
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar bg-primary text-white bg-opacity-75 rounded me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                                {{ $record->user->initials ?? '?' }}
                                            </div>
                                            <span class="fw-medium">{{ $record->user->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted small">{{ $record->user->email ?? '-' }}</td>
                                    <td>
                                        @if($record->session)
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                {{ $record->session->title }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</span>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($record->date)->format('l') }}</small>
                                    </td>
                                    <td>
                                        @if($record->status === 'present')
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Present</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Absent</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($record->approval_status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($record->approval_status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.attendance.status', $record->id) }}" class="m-0 p-0">
                                            @csrf
                                            <select name="approval_status" class="form-select form-select-sm shadow-none {{ $record->approval_status === 'approved' ? 'border-success text-success' : ($record->approval_status === 'rejected' ? 'border-danger text-danger' : 'border-warning text-dark') }}" onchange="this.form.submit()" style="min-width: 100px; cursor: pointer;">
                                                <option value="pending" {{ $record->approval_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ $record->approval_status === 'approved' ? 'selected' : '' }}>Approve</option>
                                                <option value="rejected" {{ $record->approval_status === 'rejected' ? 'selected' : '' }}>Reject</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                        No attendance records found for this date.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.attendance-checkbox');
        const bulkBtn = document.getElementById('bulkApproveBtn');

        function updateBtnState() {
            const checkedCount = document.querySelectorAll('.attendance-checkbox:checked').length;
            bulkBtn.disabled = checkedCount === 0;
            bulkBtn.innerHTML = `<i class="bi bi-check-all me-1"></i> Approve Selected (${checkedCount})`;
        }

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
                updateBtnState();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = Array.from(checkboxes).every(c => c.checked);
                const someChecked = Array.from(checkboxes).some(c => c.checked);
                
                if(selectAll) {
                    selectAll.checked = allChecked;
                    selectAll.indeterminate = someChecked && !allChecked;
                }
                updateBtnState();
            });
        });
    });
</script>
@endpush

<!-- Create Session Modal inline for quick access -->
<div class="modal fade" id="createSessionModal" tabindex="-1" aria-labelledby="createSessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="createSessionModalLabel">Create New Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.attendance.sessions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Session Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Morning Session" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Date</label>
                        <!-- Automatically preset to the currently filtered date -->
                        <input type="date" name="date" class="form-control" value="{{ $date }}" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="09:00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">End Time</label>
                            <input type="time" name="end_time" class="form-control" value="12:00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
