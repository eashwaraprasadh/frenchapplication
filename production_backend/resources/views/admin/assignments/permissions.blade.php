@extends('layouts.admin')

@section('title', 'Permissions: ' . $course->title . ' / ' . $student->name)

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Permissions</h3>
                <div class="text-muted small">Course: <strong>{{ $course->title }}</strong> • Student:
                    <strong>{{ $student->name }}</strong>
                </div>
            </div>
            <a href="{{ route('admin.assignments.course.show', $course) }}" class="btn btn-outline-secondary"><i
                    class="bi bi-arrow-left me-1"></i>Back</a>
        </div>

        {{-- Summary Badges --}}
        <div class="alert alert-info mb-3">
            <strong><i class="bi bi-info-circle me-2"></i>Course Content Summary:</strong>
            <span class="badge bg-primary ms-2">{{ $allFolders->count() }} Folders</span>
            <span class="badge bg-success ms-1">{{ $allLessons->count() }} Lessons</span>
            <span class="badge bg-warning ms-1">{{ $allTests->count() }} Tests</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST"
            action="{{ route('admin.assignments.course.permissions.save', ['course' => $course->id, 'student_id' => $student->id]) }}">
            @csrf

            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Top-level Folders</strong>
                    <div>
                        <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('folder')">Grant
                            All</button>
                        <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('folder')">Revoke
                            All</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width:40px"></th>
                                <th>Name</th>
                                <th style="width:180px">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input select-all-toggle" type="checkbox"
                                            data-target="folder" data-section="top" id="select_all_top_folders">
                                        <label class="form-check-label" for="select_all_top_folders">Toggle All</label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topFolders as $f)
                                @php $key = 'folder:' . $f->id; @endphp
                                <tr>
                                    <td><i class="bi bi-folder2-open text-success"></i></td>
                                    <td>{{ $f->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissions[folder][{{ $f->id }}]" id="folder_allow_{{ $f->id }}"
                                                value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                            <label class="form-check-label" for="folder_allow_{{ $f->id }}">Grant access</label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No top-level folders.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Root Lessons</strong>
                            <div>
                                <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('lesson')">Grant
                                    All</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('lesson')">Revoke
                                    All</button>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse($rootLessons as $item)
                                @php $key = 'lesson:' . $item->id; @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-play-circle text-primary me-2"></i>{{ $item->title }}</div>
                                    <div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissions[lesson][{{ $item->id }}]" id="lesson_allow_{{ $item->id }}"
                                                value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lesson_allow_{{ $item->id }}">Grant
                                                access</label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">No root-level lessons.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Root Tests</strong>
                            <div>
                                <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('test')">Grant
                                    All</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('test')">Revoke
                                    All</button>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse($rootTests as $item)
                                @php $key = 'test:' . $item->id; @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-clipboard-check text-warning me-2"></i>{{ $item->title }}</div>
                                    <div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissions[test][{{ $item->id }}]" id="test_allow_{{ $item->id }}"
                                                value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                            <label class="form-check-label" for="test_allow_{{ $item->id }}">Grant
                                                access</label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">No root-level tests.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Root Files</strong>
                    <div>
                        <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('file')">Grant
                            All</button>
                        <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('file')">Revoke All</button>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($rootFiles as $item)
                        @php $key = 'file:' . $item->id; @endphp
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div><i
                                    class="bi bi-file-earmark text-secondary me-2"></i>{{ $item->filename ?? ('File #' . $item->id) }}
                            </div>
                            <div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="permissions[file][{{ $item->id }}]"
                                        id="file_allow_{{ $item->id }}" value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                    <label class="form-check-label" for="file_allow_{{ $item->id }}">Grant access</label>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-muted">No root-level files.</div>
                    @endforelse
                </div>
            </div>

            <!-- Granular: All items including nested -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>All Folders (including subfolders)</strong>
                    <div>
                        <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('folder')">Grant
                            All</button>
                        <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('folder')">Revoke
                            All</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width:40px"></th>
                                <th>Path</th>
                                <th style="width:180px">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input select-all-toggle" type="checkbox"
                                            data-target="folder" data-section="all" id="select_all_folders">
                                        <label class="form-check-label" for="select_all_folders">Toggle All</label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allFolders as $f)
                                @php
                                    $key = 'folder:' . $f->id;
                                    $path = $f->name;
                                    $p = $f->parentFolder;
                                    while ($p) {
                                        $path = $p->name . ' / ' . $path;
                                        $p = $p->parentFolder;
                                    }
                                @endphp
                                <tr>
                                    <td><i class="bi bi-folder2 text-secondary"></i></td>
                                    <td>{{ $path }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissions[folder][{{ $f->id }}]" id="f_all_allow_{{ $f->id }}" value="1"
                                                {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                            <label class="form-check-label" for="f_all_allow_{{ $f->id }}">Grant access</label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">No folders.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>All Lessons (including in folders)</strong>
                            <div>
                                <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('lesson')">Grant
                                    All</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('lesson')">Revoke
                                    All</button>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse($allLessons as $item)
                                @php
                                    $key = 'lesson:' . $item->id;
                                    $path = $item->folder ? $item->folder->name : 'Root';
                                    $p = $item->folder ? $item->folder->parentFolder : null;
                                    while ($p) {
                                        $path = $p->name . ' / ' . $path;
                                        $p = $p->parentFolder;
                                    }
                                @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-play-circle text-primary me-2"></i>{{ $item->title }} <small
                                            class="text-muted">({{ $path }})</small></div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox"
                                            name="permissions[lesson][{{ $item->id }}]" id="all_lesson_allow_{{ $item->id }}"
                                            value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                        <label class="form-check-label" for="all_lesson_allow_{{ $item->id }}">Allow</label>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">No lessons.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>All Tests (including in folders)</strong>
                            <div>
                                <button type="button" class="btn btn-sm btn-light me-2" onclick="bulkGrant('test')">Grant
                                    All</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="bulkRevoke('test')">Revoke
                                    All</button>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse($allTests as $item)
                                @php
                                    $key = 'test:' . $item->id;
                                    $path = $item->folder ? $item->folder->name : 'Root';
                                    $p = $item->folder ? $item->folder->parentFolder : null;
                                    while ($p) {
                                        $path = $p->name . ' / ' . $path;
                                        $p = $p->parentFolder;
                                    }
                                @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><i class="bi bi-clipboard-check text-warning me-2"></i>{{ $item->title }} <small
                                            class="text-muted">({{ $path }})</small></div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox"
                                            name="permissions[test][{{ $item->id }}]" id="all_test_allow_{{ $item->id }}"
                                            value="1" {{ optional($existing->get($key))->has_access ? 'checked' : '' }}>
                                        <label class="form-check-label" for="all_test_allow_{{ $item->id }}">Allow</label>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">No tests.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>Save
                    Permissions</button>
            </div>
        </form>

        {{-- Loading Spinner Overlay --}}
        <div id="loading-overlay">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status" style="width:3rem; height:3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-3 text-muted">Loading permissions...</div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Fix pagination arrow styling */
            .pagination .page-link {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            /* Hide the Previous and Next arrows completely */
            .pagination .page-item:first-child,
            .pagination .page-item:last-child {
                display: none !important;
            }

            /* Hide all SVG icons in pagination */
            .pagination svg {
                display: none !important;
            }

            /* Also hide by aria-label */
            .pagination .page-link[aria-label="Previous"],
            .pagination .page-link[aria-label="Next"] {
                display: none !important;
            }

            /* Loading overlay */
            #loading-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.9);
                z-index: 9999;
                align-items: center;
                justify-content: center;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Bulk grant/revoke functions
            function bulkGrant(type) {
                document.querySelectorAll(`input[type=\"checkbox\"][name^=\"permissions[${type}]\"]`).forEach(cb => { cb.checked = true; });
            }
            function bulkRevoke(type) {
                document.querySelectorAll(`input[type=\"checkbox\"][name^=\"permissions[${type}]\"]`).forEach(cb => { cb.checked = false; });
            }

            // Select All / Deselect All toggles
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.select-all-toggle').forEach(toggle => {
                    toggle.addEventListener('change', function () {
                        const type = this.dataset.target;
                        const section = this.dataset.section;

                        let selector;
                        if (section === 'top') {
                            // For top-level items (folders, lessons, tests)
                            selector = `input[type=\"checkbox\"][id^=\"${type}_allow_\"]`;
                        } else {
                            // For "all" sections
                            selector = `input[type=\"checkbox\"][id^=\"all_${type}_allow_\"]`;
                        }

                        document.querySelectorAll(selector).forEach(cb => {
                            cb.checked = this.checked;
                        });
                    });
                });

                // Show loading spinner when clicking pagination links
                document.addEventListener('click', function (e) {
                    if (e.target.closest('.pagination a')) {
                        document.getElementById('loading-overlay').style.display = 'flex';
                    }
                });

                // Hide loading spinner when page loads
                window.addEventListener('load', function () {
                    document.getElementById('loading-overlay').style.display = 'none';
                });
            });
        </script>
    @endpush
@endsection