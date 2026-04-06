@extends('layouts.admin')

@section('title', 'Manage Attendance Sessions')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 fw-bold mb-1">Attendance Sessions</h2>
            <p class="text-muted">Create and manage daily sessions for student attendance.</p>
        </div>
        <div>
            <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-primary">
                Back to Approvals
            </a>
            <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#createSessionModal">
                <i class="bi bi-plus-lg"></i> New Session
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $session)
                            <tr>
                                <td class="fw-medium">{{ $session->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</td>
                                <td>
                                    <form action="{{ route('admin.attendance.sessions.destroy', $session->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this session? This will NOT delete existing attendance marked for it, but will orphan them.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.attendance.index', ['session_id' => $session->id, 'date' => $session->date->format('Y-m-d')]) }}" class="btn btn-sm btn-outline-secondary ms-1">
                                        View Attendance
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No sessions found. Create a new session to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Create Session Modal -->
<div class="modal fade" id="createSessionModal" tabindex="-1" aria-labelledby="createSessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
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
                        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
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
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
