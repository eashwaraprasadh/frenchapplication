@extends('layouts.admin')

@section('title', 'File Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">File Management</h1>
        <p class="text-muted">Manage uploaded files and media</p>
    </div>
    <div>
        <button class="btn btn-outline-primary me-2">
            <i class="bi bi-cloud-upload me-2"></i>Upload Files
        </button>
        <button class="btn btn-primary">
            <i class="bi bi-folder-plus me-2"></i>New Folder
        </button>
    </div>
</div>

<div class="text-center py-5">
    <i class="bi bi-folder fs-1 text-muted"></i>
    <h4 class="mt-3">File Management</h4>
    <p class="text-muted">File management system will be implemented here</p>
    <button class="btn btn-outline-primary">Coming Soon</button>
</div>
@endsection
