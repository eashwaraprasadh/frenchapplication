@extends('layouts.app')

@section('title', 'My Attendance')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 fw-bold mb-1">My Attendance</h2>
            <p class="text-muted">Track your daily attendance</p>
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

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Mark Today's Attendance</h5>
                    <div class="mb-3 text-muted">
                        <i class="bi bi-calendar3 me-2"></i> {{ \Carbon\Carbon::parse($today)->format('l, F j, Y') }}
                    </div>

                    @forelse($todaySessions as $session)
                        <div class="border rounded p-3 mb-3">
                            <h6 class="fw-bold mb-1">{{ $session->title }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-clock me-1"></i> 
                                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} — {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                            </p>

                            @php
                                $now = \Carbon\Carbon::now();
                                $sessionEnd = \Carbon\Carbon::parse($session->date->format('Y-m-d') . ' ' . $session->end_time);
                                $isUpcoming = $now->lt($sessionEnd);
                            @endphp

                            @if(in_array($session->id, $markedSessionIds))
                                @php
                                    $record = auth()->user()->attendances()->where('attendance_session_id', $session->id)->first();
                                @endphp
                                @if($record)
                                    <div class="alert alert-info py-2 px-3 mb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>You marked: <strong class="text-capitalize">{{ $record->status }}</strong></span>
                                            <span class="badge bg-{{ $record->approval_status === 'approved' ? 'success' : ($record->approval_status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($record->approval_status) }}</span>
                                        </div>
                                    </div>
                                @endif
                            @elseif($isUpcoming)
                                <div class="alert alert-warning py-2 px-3 mb-0 text-center">
                                    <i class="bi bi-clock-history me-1"></i> Upcoming: Opens at {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                </div>
                            @else
                                <form action="{{ route('student.attendance.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" name="status" value="present" class="btn btn-sm btn-success flex-grow-1" onclick="return confirm('Mark Present for {{ $session->title }}?')">
                                            <i class="bi bi-check-circle-fill"></i> Present
                                        </button>
                                        <button type="submit" name="status" value="absent" class="btn btn-sm btn-outline-danger flex-grow-1" onclick="return confirm('Mark Absent for {{ $session->title }}?')">
                                            <i class="bi bi-x-circle-fill"></i> Absent
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="alert alert-light text-center py-4 text-muted">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            No sessions scheduled for today.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Attendance History</h5>
                    
                    @if($attendances->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Session</th>
                                        <th>Status</th>
                                        <th>Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $record)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded p-2 me-2 text-center" style="width: 48px">
                                                        <small class="d-block text-muted" style="font-size: 0.7rem">{{ \Carbon\Carbon::parse($record->date)->format('M') }}</small>
                                                        <strong class="d-block">{{ \Carbon\Carbon::parse($record->date)->format('d') }}</strong>
                                                    </div>
                                                    <div>
                                                        <span class="d-block fw-medium">{{ \Carbon\Carbon::parse($record->date)->format('l') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($record->session)
                                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1">
                                                        {{ $record->session->title }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->status === 'present')
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Present</span>
                                                @else
                                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Absent</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->approval_status === 'approved')
                                                    <span class="badge bg-success rounded-pill">Approved</span>
                                                @elseif($record->approval_status === 'rejected')
                                                    <span class="badge bg-danger rounded-pill">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $attendances->links() }}
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-calendar-x fs-1 mb-3 d-block opacity-50"></i>
                            <p>No attendance records found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
