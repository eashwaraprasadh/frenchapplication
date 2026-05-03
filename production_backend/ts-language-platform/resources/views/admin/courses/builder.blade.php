@extends('layouts.admin')

@section('title', 'Course Builder - ' . $course->title)

@push('styles')
<style>
.file-manager {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    min-height: 600px;
}

.file-manager-toolbar {
    background: white;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem;
    border-radius: 0.5rem 0.5rem 0 0;
}

.file-manager-sidebar {
    background: white;
    border-right: 1px solid #dee2e6;
    min-height: 550px;
    padding: 1rem;
}

.file-manager-content {
    background: white;
    min-height: 550px;
    padding: 1rem;
}

.breadcrumb-nav {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-bottom: 1px solid #dee2e6;
    font-size: 0.9rem;
}

.file-item {
    padding: 0.75rem;
    border: 1px solid transparent;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-bottom: 0.5rem;
}

.file-item:hover {
    background: #f8f9fa;
    border-color: #dee2e6;
}

.file-item.selected {
    background: #e3f2fd;
    border-color: #2196f3;
}

.file-item.folder {
    background: #fff3e0;
    border-color: #ffb74d;
}

.file-item.lesson {
    background: #e8f5e8;
    border-color: #4caf50;
}

.file-item.test {
    background: #fce4ec;
    border-color: #e91e63;
}

.file-icon {
    width: 24px;
    height: 24px;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.folder-tree {
    list-style: none;
    padding-left: 0;
}

.folder-tree li {
    margin: 0.25rem 0;
}

.folder-tree .folder-item {
    padding: 0.5rem;
    border-radius: 0.25rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background 0.2s ease;
}

.folder-tree .folder-item:hover {
    background: #f8f9fa;
}

.folder-tree .folder-item.active {
    background: #e3f2fd;
    color: #1976d2;
}

.folder-tree .nested {
    padding-left: 1.5rem;
}

.context-menu {
    position: absolute;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    z-index: 1000;
    min-width: 150px;
}

.context-menu-item {
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-bottom: 1px solid #f8f9fa;
    transition: background 0.2s ease;
}

.context-menu-item:hover {
    background: #f8f9fa;
}

.context-menu-item:last-child {
    border-bottom: none;
}

.view-toggle {
    display: flex;
    background: #f8f9fa;
    border-radius: 0.375rem;
    padding: 0.25rem;
}

.view-toggle button {
    border: none;
    background: transparent;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
}

.view-toggle button.active {
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.grid-view .file-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1rem;
    min-height: 120px;
}

.grid-view .file-icon {
    width: 48px;
    height: 48px;
    margin-right: 0;
    margin-bottom: 0.5rem;
}

.list-view .file-item {
    display: flex;
    align-items: center;
}

.properties-panel {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    margin-top: 1rem;
}
</style>
@endpush

@section('content')
<!-- Course Builder Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">
            <i class="bi bi-tools me-2"></i>
            Course Builder: {{ $course->title }}
        </h1>
        <p class="text-muted">
            {{ ucfirst($course->language) }} • {{ ucfirst($course->level) }} •
            <span class="badge bg-{{ $course->status === 'published' ? 'success' : ($course->status === 'draft' ? 'warning' : 'secondary') }}">
                {{ ucfirst($course->status) }}
            </span>
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Courses
        </a>
        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary" target="_blank">
            <i class="bi bi-eye me-1"></i>
            Preview Course
        </a>
    </div>
</div>

<!-- File Manager Interface -->
<div class="file-manager">
    <!-- Toolbar -->
    <div class="file-manager-toolbar">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-sm" onclick="createFolder()">
                        <i class="bi bi-folder-plus me-1"></i>
                        New Folder
                    </button>
                    <button class="btn btn-success btn-sm" onclick="createLesson()">
                        <i class="bi bi-file-earmark-text-fill me-1"></i>
                        New Lesson
                    </button>
                    <button class="btn btn-warning btn-sm" onclick="createTest()">
                        <i class="bi bi-clipboard-check-fill me-1"></i>
                        New Test
                    </button>
                    <div class="vr mx-2"></div>
                    <button class="btn btn-outline-secondary btn-sm" onclick="uploadFile()">
                        <i class="bi bi-cloud-upload me-1"></i>
                        Upload
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <div class="view-toggle">
                        <button class="active" onclick="setView('list')">
                            <i class="bi bi-list"></i>
                        </button>
                        <button onclick="setView('grid')">
                            <i class="bi bi-grid"></i>
                        </button>
                    </div>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Search files..." id="searchInput">
                        <button class="btn btn-outline-secondary btn-sm" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-nav">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="#" onclick="navigateToRoot()">
                        <i class="bi bi-house me-1"></i>
                        {{ $course->title }}
                    </a>
                </li>
                <li class="breadcrumb-item active" id="currentPath">Root</li>
            </ol>
        </nav>
    </div>

    <div class="row g-0">
        <!-- Sidebar - Folder Tree -->
        <div class="col-md-3">
            <div class="file-manager-sidebar">
                <h6 class="mb-3">
                    <i class="bi bi-folder-fill me-2"></i>
                    Course Structure
                </h6>
                <ul class="folder-tree" id="folderTree">
                    <li>
                        <div class="folder-item active" onclick="selectFolder('root')">
                            <i class="bi bi-house me-2"></i>
                            {{ $course->title }}
                        </div>
                        <ul class="nested">
                            @foreach($course->folders as $folder)
                                <li>
                                    <div class="folder-item" onclick="selectFolder('{{ $folder->id }}')">
                                        <i class="bi bi-folder me-2"></i>
                                        {{ $folder->name }}
                                    </div>
                                    @if($folder->subfolders->count() > 0)
                                        <ul class="nested">
                                            @foreach($folder->subfolders as $subfolder)
                                                <li>
                                                    <div class="folder-item" onclick="selectFolder('{{ $subfolder->id }}')">
                                                        <i class="bi bi-folder me-2"></i>
                                                        {{ $subfolder->name }}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <div class="file-manager-content">
                <div id="fileList" class="list-view">
                    <!-- Root Level Items -->
                    @foreach($course->folders as $folder)
                        <div class="file-item folder" data-type="folder" data-id="{{ $folder->id }}" ondblclick="openFolder('{{ $folder->id }}')" oncontextmenu="showContextMenu(event, 'folder', '{{ $folder->id }}')">
                            <i class="bi bi-folder-fill file-icon text-warning"></i>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $folder->name }}</div>
                                <small class="text-muted">
                                    {{ $folder->subfolders->count() + $folder->lessons->count() + $folder->tests->count() }} items
                                    • Modified {{ $folder->updated_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="file-actions">
                                <button class="btn btn-sm btn-outline-secondary" onclick="editItem('folder', '{{ $folder->id }}')">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('folder', '{{ $folder->id }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @foreach($course->lessons->where('folder_id', null) as $lesson)
                        <div class="file-item lesson" data-type="lesson" data-id="{{ $lesson->id }}" ondblclick="openLesson('{{ $lesson->id }}')" oncontextmenu="showContextMenu(event, 'lesson', '{{ $lesson->id }}')">
                            <i class="bi bi-file-earmark-text-fill file-icon text-success"></i>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $lesson->title }}</div>
                                <small class="text-muted">
                                    Lesson • {{ $lesson->duration ?? 'No duration set' }}
                                    • Modified {{ $lesson->updated_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="file-actions">
                                <button class="btn btn-sm btn-outline-info" onclick="previewItem('lesson', '{{ $lesson->id }}')" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="editItem('lesson', '{{ $lesson->id }}')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('lesson', '{{ $lesson->id }}')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @foreach($course->tests as $test)
                        <div class="file-item test" data-type="test" data-id="{{ $test->id }}" ondblclick="openTest('{{ $test->id }}')" oncontextmenu="showContextMenu(event, 'test', '{{ $test->id }}')">
                            <i class="bi bi-clipboard-check-fill file-icon text-danger"></i>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $test->title }}</div>
                                <small class="text-muted">
                                    Test • {{ $test->questions->count() ?? 0 }} questions
                                    • Modified {{ $test->updated_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="file-actions">
                                <button class="btn btn-sm btn-outline-info" onclick="previewItem('test', '{{ $test->id }}')" title="Preview">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="editItem('test', '{{ $test->id }}')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('test', '{{ $test->id }}')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @if($course->folders->count() == 0 && $course->lessons->where('folder_id', null)->count() == 0 && $course->tests->count() == 0)
                        <div class="text-center py-5">
                            <i class="bi bi-folder2-open text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 text-muted">This course is empty</h5>
                            <p class="text-muted">Start building your course by creating folders, lessons, or tests.</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="btn btn-primary" onclick="createFolder()">
                                    <i class="bi bi-folder-plus me-1"></i>
                                    Create Folder
                                </button>
                                <button class="btn btn-success" onclick="createLesson()">
                                    <i class="bi bi-file-earmark-text-fill me-1"></i>
                                    Create Lesson
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

<!-- Properties Panel -->
<div class="properties-panel" id="propertiesPanel" style="display: none;">
    <h6 class="mb-3">
        <i class="bi bi-info-circle me-2"></i>
        Properties
    </h6>
    <div id="propertiesContent">
        <p class="text-muted">Select an item to view its properties</p>
    </div>
</div>

<!-- Context Menu -->
<div class="context-menu" id="contextMenu" style="display: none;">
    <div class="context-menu-item" onclick="editSelectedItem()">
        <i class="bi bi-pencil me-2"></i>
        Edit
    </div>
    <div class="context-menu-item" onclick="duplicateSelectedItem()">
        <i class="bi bi-files me-2"></i>
        Duplicate
    </div>
    <div class="context-menu-item" onclick="moveSelectedItem()">
        <i class="bi bi-arrow-right me-2"></i>
        Move
    </div>
    <div class="context-menu-item text-danger" onclick="deleteSelectedItem()">
        <i class="bi bi-trash me-2"></i>
        Delete
    </div>
</div>

<!-- Modals -->
<!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-folder-plus me-2"></i>
                    Create New Folder
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createFolderForm">
                    <div class="mb-3">
                        <label for="folderName" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="folderName" required>
                    </div>
                    <div class="mb-3">
                        <label for="folderDescription" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="folderDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitCreateFolder()">Create Folder</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Lesson Modal -->
<div class="modal fade" id="createLessonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>
                    Create New Lesson
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createLessonForm">
                    <div class="mb-3">
                        <label for="lessonTitle" class="form-label">Lesson Title</label>
                        <input type="text" class="form-control" id="lessonTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="lessonDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="lessonDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lessonDuration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control" id="lessonDuration" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitCreateLesson()">Create Lesson</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Test Modal -->
<div class="modal fade" id="createTestModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clipboard-check-fill me-2"></i>
                    Create New Test
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createTestForm">
                    <div class="mb-3">
                        <label for="testTitle" class="form-label">Test Title</label>
                        <input type="text" class="form-control" id="testTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="testDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="testDescription" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="testDuration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="testDuration" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="testPassingScore" class="form-label">Passing Score (%)</label>
                                <input type="number" class="form-control" id="testPassingScore" min="0" max="100" value="70">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="submitCreateTest()">Create Test</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
let currentFolder = 'root';
let selectedItems = [];
let currentView = 'list';

// Initialize the file manager
document.addEventListener('DOMContentLoaded', function() {
    // Hide context menu when clicking elsewhere
    document.addEventListener('click', function() {
        hideContextMenu();
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        filterFiles(this.value);
    });
});

// View Management
function setView(view) {
    currentView = view;
    const fileList = document.getElementById('fileList');
    const buttons = document.querySelectorAll('.view-toggle button');

    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    fileList.className = view + '-view';
}

// Navigation
function navigateToRoot() {
    currentFolder = 'root';
    updateBreadcrumb('Root');
    loadFolderContent('root');
}

function selectFolder(folderId) {
    console.log('selectFolder called with:', folderId);
    currentFolder = folderId;
    console.log('currentFolder set to:', currentFolder);

    const folderItems = document.querySelectorAll('.folder-item');
    folderItems.forEach(item => item.classList.remove('active'));

    // Find and activate the clicked folder item
    const clickedItem = document.querySelector(`[onclick="selectFolder('${folderId}')"]`);
    if (clickedItem) {
        clickedItem.classList.add('active');
    }

    if (folderId === 'root') {
        updateBreadcrumb('{{ $course->title }}');
    } else {
        // Get folder name from the clicked element
        const folderName = clickedItem ? clickedItem.textContent.trim() : 'Folder';
        updateBreadcrumb(folderName);
    }

    loadFolderContent(folderId);
}

function updateBreadcrumb(path) {
    document.getElementById('currentPath').textContent = path;
}

// File Operations
function createFolder() {
    const modal = new bootstrap.Modal(document.getElementById('createFolderModal'));
    modal.show();
}

function createLesson() {
    const modal = new bootstrap.Modal(document.getElementById('createLessonModal'));
    modal.show();
}

function createTest() {
    const modal = new bootstrap.Modal(document.getElementById('createTestModal'));
    modal.show();
}

function uploadFile() {
    // Create a file input dynamically
    const input = document.createElement('input');
    input.type = 'file';
    input.multiple = true;
    input.accept = '.pdf,.doc,.docx,.ppt,.pptx,.mp4,.mp3,.jpg,.jpeg,.png,.gif';
    input.onchange = function(e) {
        handleFileUpload(e.target.files);
    };
    input.click();
}

// Item Actions
function openFolder(folderId) {
    selectFolder(folderId);
    loadFolderContent(folderId);
}

function openLesson(lessonId) {
    window.open(`/admin/lessons/${lessonId}/edit`, '_blank');
}

function openTest(testId) {
    window.open(`/admin/tests/${testId}/edit`, '_blank');
}

function editItem(type, id) {
    switch(type) {
        case 'folder':
            editFolder(id);
            break;
        case 'lesson':
            editLesson(id);
            break;
        case 'test':
            editTest(id);
            break;
    }
}

// Edit lesson function
function editLesson(lessonId) {
    window.open(`/admin/lessons/${lessonId}/edit`, '_blank');
}

// Edit test function
function editTest(testId) {
    window.open(`/admin/tests/${testId}/edit`, '_blank');
}

// Preview item function
function previewItem(type, id) {
    if (type === 'lesson') {
        window.open(`/student/lesson/${id}/preview`, '_blank');
    } else if (type === 'test') {
        window.open(`/student/test/${id}/preview`, '_blank');
    }
}

function deleteItem(type, id) {
    if (confirm(`Are you sure you want to delete this ${type}?`)) {
        // Make AJAX request to delete
        fetch(`/admin/${type}s/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh the page
            } else {
                alert('Error deleting item');
            }
        });
    }
}

// Context Menu
function showContextMenu(event, type, id) {
    event.preventDefault();
    const contextMenu = document.getElementById('contextMenu');
    contextMenu.style.display = 'block';
    contextMenu.style.left = event.pageX + 'px';
    contextMenu.style.top = event.pageY + 'px';

    // Store selected item info
    contextMenu.dataset.type = type;
    contextMenu.dataset.id = id;
}

function hideContextMenu() {
    document.getElementById('contextMenu').style.display = 'none';
}

// Form Submissions
function submitCreateFolder() {
    const name = document.getElementById('folderName').value;
    const description = document.getElementById('folderDescription').value;

    if (!name) {
        alert('Please enter a folder name');
        return;
    }

    console.log('Creating folder:', name, description);

    fetch('/admin/folders', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            description: description,
            course_id: {{ $course->id }},
            parent_folder_id: currentFolder === 'root' ? null : currentFolder
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        if (data.success) {
            alert('Folder created successfully!');
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('createFolderModal'));
            modal.hide();
            // Clear form
            document.getElementById('folderName').value = '';
            document.getElementById('folderDescription').value = '';
            // Refresh current folder content
            loadFolderContent(currentFolder);
        } else {
            alert('Error creating folder: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Network error creating folder');
    });
}

function submitCreateLesson() {
    const title = document.getElementById('lessonTitle').value;
    const description = document.getElementById('lessonDescription').value;
    const duration = document.getElementById('lessonDuration').value;

    console.log('Creating lesson in folder:', currentFolder);

    if (!title) {
        alert('Please enter a lesson title');
        return;
    }

    fetch('/admin/lessons', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: title,
            description: description,
            duration: duration,
            course_id: {{ $course->id }},
            folder_id: currentFolder === 'root' ? null : currentFolder
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Lesson creation response:', data);
        if (data.success) {
            alert('Lesson created successfully!');
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('createLessonModal'));
            modal.hide();
            // Clear form
            document.getElementById('lessonTitle').value = '';
            document.getElementById('lessonDescription').value = '';
            document.getElementById('lessonDuration').value = '';
            // Refresh current folder content
            loadFolderContent(currentFolder);
        } else {
            alert('Error creating lesson: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Network error creating lesson');
    });
}

function submitCreateTest() {
    const title = document.getElementById('testTitle').value;
    const description = document.getElementById('testDescription').value;
    const duration = document.getElementById('testDuration').value;
    const passingScore = document.getElementById('testPassingScore').value;

    console.log('Creating test in folder:', currentFolder);

    if (!title) {
        alert('Please enter a test title');
        return;
    }

    fetch('/admin/tests', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: title,
            description: description,
            duration: duration,
            passing_score: passingScore,
            course_id: {{ $course->id }},
            folder_id: currentFolder === 'root' ? null : currentFolder
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Test creation response:', data);
        if (data.success) {
            alert('Test created successfully!');
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('createTestModal'));
            modal.hide();
            // Clear form
            document.getElementById('testTitle').value = '';
            document.getElementById('testDescription').value = '';
            document.getElementById('testDuration').value = '';
            document.getElementById('testPassingScore').value = '';
            // Refresh current folder content
            loadFolderContent(currentFolder);
        } else {
            alert('Error creating test: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Network error creating test');
    });
}

// Search and Filter
function filterFiles(searchTerm) {
    const fileItems = document.querySelectorAll('.file-item');
    fileItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm.toLowerCase())) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// File Upload Handler
function handleFileUpload(files) {
    const formData = new FormData();
    for (let file of files) {
        formData.append('files[]', file);
    }
    formData.append('course_id', {{ $course->id }});
    formData.append('folder_id', currentFolder === 'root' ? '' : currentFolder);

    fetch('/admin/files/upload', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error uploading files');
        }
    });
}

// Load folder content dynamically
function loadFolderContent(folderId) {
    const contentArea = document.getElementById('fileList');

    if (folderId === 'root') {
        // For root, reload the page to show the server-rendered content
        window.location.href = window.location.pathname;
        return;
    }

    // Show loading state
    contentArea.innerHTML = '<div class="text-center py-5"><i class="bi bi-hourglass-split"></i> Loading...</div>';

    // Make AJAX request to get folder contents
    fetch(`/admin/courses/{{ $course->id }}/folder/${folderId}/contents`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderFolderContents(data.contents, folderId);
            } else {
                contentArea.innerHTML = '<div class="text-center py-5 text-danger"><i class="bi bi-exclamation-triangle"></i> Error loading folder contents</div>';
            }
        })
        .catch(error => {
            console.error('Error loading folder:', error);
            contentArea.innerHTML = '<div class="text-center py-5 text-danger"><i class="bi bi-exclamation-triangle"></i> Error loading folder contents</div>';
        });
}

// Render folder contents in the main area
function renderFolderContents(contents, folderId) {
    const contentArea = document.getElementById('fileList');

    if (!contents || (contents.folders.length === 0 && contents.lessons.length === 0 && contents.tests.length === 0)) {
        contentArea.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-folder-x fs-1 text-muted mb-3"></i>
                <h5 class="text-muted">This folder is empty</h5>
                <p class="text-muted">Add folders, lessons, or tests to get started.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-primary btn-sm" onclick="createFolder()">
                        <i class="bi bi-folder-plus me-1"></i> New Folder
                    </button>
                    <button class="btn btn-success btn-sm" onclick="createLesson()">
                        <i class="bi bi-file-earmark-text-fill me-1"></i> New Lesson
                    </button>
                    <button class="btn btn-warning btn-sm" onclick="createTest()">
                        <i class="bi bi-clipboard-check-fill me-1"></i> New Test
                    </button>
                </div>
            </div>
        `;
        return;
    }

    let html = '';

    // Add back navigation if not in root
    if (folderId !== 'root') {
        html += `
            <div class="file-item folder" onclick="goBack()" style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px;">
                <i class="bi bi-arrow-left file-icon text-secondary"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">.. (Go Back)</div>
                    <small class="text-muted">Return to parent folder</small>
                </div>
            </div>
        `;
    }

    // Render folders
    contents.folders.forEach(folder => {
        html += `
            <div class="file-item folder" data-type="folder" data-id="${folder.id}"
                 ondblclick="openFolder('${folder.id}')"
                 oncontextmenu="showContextMenu(event, 'folder', '${folder.id}')">
                <i class="bi bi-folder-fill file-icon text-warning"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">${folder.name}</div>
                    <small class="text-muted">
                        ${folder.items_count || 0} items • Modified ${folder.updated_at}
                    </small>
                </div>
                <div class="file-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="editFolder('${folder.id}')" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteFolder('${folder.id}')" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });

    // Render lessons
    contents.lessons.forEach(lesson => {
        html += `
            <div class="file-item lesson" data-type="lesson" data-id="${lesson.id}"
                 ondblclick="openLesson('${lesson.id}')"
                 oncontextmenu="showContextMenu(event, 'lesson', '${lesson.id}')">
                <i class="bi bi-file-earmark-text-fill file-icon text-success"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">${lesson.title}</div>
                    <small class="text-muted">
                        ${lesson.duration || 'No duration'} min • ${lesson.status} • Modified ${lesson.updated_at}
                    </small>
                </div>
                <div class="file-actions">
                    <button class="btn btn-sm btn-outline-info" onclick="previewItem('lesson', '${lesson.id}')" title="Preview">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" onclick="openLesson('${lesson.id}')" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteLesson('${lesson.id}')" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });

    // Render tests
    contents.tests.forEach(test => {
        html += `
            <div class="file-item test" data-type="test" data-id="${test.id}"
                 ondblclick="openTest('${test.id}')"
                 oncontextmenu="showContextMenu(event, 'test', '${test.id}')">
                <i class="bi bi-clipboard-check-fill file-icon text-danger"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">${test.title}</div>
                    <small class="text-muted">
                        ${test.duration || 'No duration'} min • ${test.passing_score}% pass • ${test.status} • Modified ${test.updated_at}
                    </small>
                </div>
                <div class="file-actions">
                    <button class="btn btn-sm btn-outline-info" onclick="previewItem('test', '${test.id}')" title="Preview">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" onclick="openTest('${test.id}')" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteTest('${test.id}')" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });

    contentArea.innerHTML = html;
}

// Go back to parent folder
function goBack() {
    // For now, go back to root - in a full implementation, you'd track the folder hierarchy
    selectFolder('root');
    loadFolderContent('root');
}
</script>
@endpush

@endsection
