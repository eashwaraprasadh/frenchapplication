@extends('layouts.admin')

@section('title', 'System Settings - Admin Panel')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-1">System Settings</h2>
            <p class="text-muted mb-0">Configure platform settings and preferences</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="row g-4">
            <!-- Main Settings -->
            <div class="col-lg-8">
                <!-- General -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-sliders me-2 text-primary"></i>General Settings
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Platform Name</label>
                            <input type="text" name="platform_name" class="form-control form-control-lg bg-light border-0"
                                value="{{ $settings['platform_name'] ?? 'TS Language Platform' }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Platform Description</label>
                            <textarea name="platform_description" class="form-control bg-light border-0"
                                rows="3">{{ $settings['platform_description'] ?? 'Master French with our comprehensive online learning platform.' }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control form-control-lg bg-light border-0"
                                value="{{ $settings['contact_email'] ?? 'admin@tslanguage.com' }}">
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-medium text-secondary">Default Language</label>
                            <select name="default_language" class="form-select form-select-lg bg-light border-0">
                                <option value="en" {{ ($settings['default_language'] ?? 'en') === 'en' ? 'selected' : '' }}>
                                    English</option>
                                <option value="fr" {{ ($settings['default_language'] ?? 'en') === 'fr' ? 'selected' : '' }}>
                                    French</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Course Settings -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-book me-2 text-primary"></i>Course Settings
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <div class="form-check form-switch ps-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-check-label fw-medium text-dark ms-0" for="autoEnroll">
                                        Allow automatic enrollment
                                        <div class="small text-muted fw-normal">Students join courses immediately after
                                            payment</div>
                                    </label>
                                    <input class="form-check-input ms-3" type="checkbox" id="autoEnroll"
                                        name="allow_auto_enroll" value="1" {{ ($settings['allow_auto_enroll'] ?? '1') == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-check form-switch ps-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-check-label fw-medium text-dark ms-0" for="emailNotifications">
                                        Send email notifications
                                        <div class="small text-muted fw-normal">Notify students about new lessons and
                                            quizzes</div>
                                    </label>
                                    <input class="form-check-input ms-3" type="checkbox" id="emailNotifications"
                                        name="send_email_notifications" value="1" {{ ($settings['send_email_notifications'] ?? '1') == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-medium text-secondary">Maximum File Upload Size (MB)</label>
                            <input type="number" name="max_upload_size"
                                class="form-control form-control-lg bg-light border-0"
                                value="{{ $settings['max_upload_size'] ?? '100' }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm hover-scale">
                        <i class="bi bi-check-lg me-2"></i>Save Changes
                    </button>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="col-lg-4">
                <!-- System Status -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">System Status</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-database me-2 text-muted"></i>
                                <span class="text-dark">Database</span>
                            </div>
                            <span
                                class="badge {{ $systemHealth['database']['status'] === 'healthy' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $systemHealth['database']['status'] === 'healthy' ? 'success' : 'danger' }} rounded-pill px-3">
                                {{ ucfirst($systemHealth['database']['status']) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-hdd me-2 text-muted"></i>
                                <span class="text-dark">Storage</span>
                            </div>
                            <span
                                class="badge {{ $systemHealth['storage']['status'] === 'healthy' ? 'bg-success' : 'bg-warning' }} bg-opacity-10 text-{{ $systemHealth['storage']['status'] === 'healthy' ? 'success' : 'warning' }} rounded-pill px-3">
                                {{ ucfirst($systemHealth['storage']['status']) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-lightning me-2 text-muted"></i>
                                <span class="text-dark">Cache</span>
                            </div>
                            <span
                                class="badge {{ $systemHealth['cache']['status'] === 'healthy' ? 'bg-success' : 'bg-warning' }} bg-opacity-10 text-{{ $systemHealth['cache']['status'] === 'healthy' ? 'success' : 'warning' }} rounded-pill px-3">
                                {{ ucfirst($systemHealth['cache']['status']) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope me-2 text-muted"></i>
                                <span class="text-dark">Mail</span>
                            </div>
                            <span
                                class="badge {{ $systemHealth['mail']['status'] === 'healthy' ? 'bg-success' : 'bg-warning' }} bg-opacity-10 text-{{ $systemHealth['mail']['status'] === 'healthy' ? 'success' : 'warning' }} rounded-pill px-3">
                                {{ ucfirst($systemHealth['mail']['status']) }}
                            </span>
                        </div>
                    </div>
                </div>
    </form>

    <!-- Quick Actions -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-gradient-primary text-white border-0 p-4 rounded-top-4">
            <h5 class="fw-bold mb-0 text-dark">Quick Actions</h5>
        </div>
        <div class="card-body p-4">
            <div class="d-grid gap-3">
                <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="btn btn-outline-primary w-100 text-start p-3 rounded-3 d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-2 me-3 p-2">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Clear System Cache</div>
                            <div class="small text-muted">Fix common display issues</div>
                        </div>
                    </button>
                </form>

                <button class="btn btn-outline-success w-100 text-start p-3 rounded-3 d-flex align-items-center" disabled>
                    <div class="icon-box bg-success bg-opacity-10 text-success rounded-2 me-3 p-2">
                        <i class="bi bi-database-down"></i>
                    </div>
                    <div>
                        <div class="fw-bold">Backup Database</div>
                        <div class="small text-muted">Download SQL dump</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
    </div>
    </div>

    <style>
        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .form-check-input {
            width: 3em;
            height: 1.5em;
            cursor: pointer;
        }
    </style>
@endsection