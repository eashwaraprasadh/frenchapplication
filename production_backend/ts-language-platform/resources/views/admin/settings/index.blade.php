@extends('layouts.admin')

@section('title', 'Settings - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">System Settings</h1>
        <p class="text-muted">Configure platform settings and preferences</p>
    </div>
    <div>
        <button class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>Save Changes
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">General Settings</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Platform Name</label>
                        <input type="text" class="form-control" value="TS Language Platform">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Platform Description</label>
                        <textarea class="form-control" rows="3">Master French with our comprehensive online learning platform.</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-control" value="admin@tslanguage.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Default Language</label>
                        <select class="form-select">
                            <option value="en">English</option>
                            <option value="fr" selected>French</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Course Settings</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="autoEnroll" checked>
                            <label class="form-check-label" for="autoEnroll">
                                Allow automatic enrollment
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                            <label class="form-check-label" for="emailNotifications">
                                Send email notifications
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Maximum File Upload Size (MB)</label>
                        <input type="number" class="form-control" value="100">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Database</span>
                    <span class="badge bg-success">Healthy</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Storage</span>
                    <span class="badge bg-success">Healthy</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Cache</span>
                    <span class="badge bg-success">Healthy</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Mail</span>
                    <span class="badge bg-warning">Warning</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary">Clear Cache</button>
                    <button class="btn btn-outline-warning">Backup Database</button>
                    <button class="btn btn-outline-info">Update System</button>
                    <button class="btn btn-outline-danger">Maintenance Mode</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
