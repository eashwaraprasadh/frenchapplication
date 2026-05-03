@extends('layouts.admin')

@section('title', 'Test Submissions - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Test Submissions</h1>
        <p class="text-muted">Review and grade test submissions</p>
    </div>
    <div>
        <button class="btn btn-outline-primary me-2">
            <i class="bi bi-download me-2"></i>Export Results
        </button>
        <button class="btn btn-primary">
            <i class="bi bi-file-earmark-text me-2"></i>Grade All
        </button>
    </div>
</div>

<div class="text-center py-5">
    <i class="bi bi-file-earmark-text fs-1 text-muted"></i>
    <h4 class="mt-3">Test Submissions</h4>
    <p class="text-muted">Test submission management system will be implemented here</p>
    <button class="btn btn-outline-primary">Coming Soon</button>
</div>
@endsection
