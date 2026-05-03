@extends('layouts.admin')

@section('title', 'Edit Lesson - Admin Dashboard')

@push('styles')
<style>
/* Google Forms-like Lesson Editor Styles */
.lesson-editor {
    background: #f8f9fa;
    min-height: 100vh;
    font-family: 'Google Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    display: flex;
    position: relative;
}

/* Left Sidebar */
.lesson-sidebar {
    width: 280px;
    background: white;
    border-right: 1px solid #e8eaed;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    z-index: 100;
    box-shadow: 2px 0 8px rgba(0,0,0,0.1);
    flex-shrink: 0;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e8eaed;
    background: #f8f9fa;
}

.sidebar-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: #202124;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sidebar-subtitle {
    font-size: 0.875rem;
    color: #5f6368;
    margin-top: 0.25rem;
}

.content-types-section {
    padding: 1.5rem;
}

.section-title {
    font-size: 0.875rem;
    font-weight: 500;
    color: #5f6368;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.content-type-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.content-type-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    border: 1px solid #dadce0;
    background: white;
    border-radius: 8px;
    color: #5f6368;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.content-type-btn:hover {
    background: #f8f9fa;
    border-color: #4285f4;
    color: #1a73e8;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.content-type-btn i {
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

/* Main Content Area */
.lesson-main {
    flex: 1;
    padding: 2rem;
    max-width: 800px;
    margin: 0 auto;
    min-height: 100vh;
}

.lesson-header {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.lesson-title-input {
    font-size: 2rem;
    font-weight: 400;
    border: none;
    background: transparent;
    color: #202124;
    width: 100%;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.lesson-title-input:focus {
    outline: none;
    background: #f8f9fa;
    box-shadow: 0 0 0 2px #4285f4;
}

.lesson-description-input {
    font-size: 1rem;
    border: none;
    background: transparent;
    color: #5f6368;
    width: 100%;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    resize: vertical;
    min-height: 60px;
}

.lesson-description-input:focus {
    outline: none;
    background: #f8f9fa;
    box-shadow: 0 0 0 2px #4285f4;
}

.lesson-meta {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e8eaed;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #5f6368;
}

/* Content Blocks */
.content-blocks-container {
    min-height: 400px;
}

.content-block {
    background: white;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.content-block:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.content-block.editing {
    box-shadow: 0 0 0 2px #4285f4;
}

.content-block.dragging {
    opacity: 0.5;
    transform: rotate(2deg);
}

.block-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e8eaed;
    background: #f8f9fa;
}

.block-type {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #5f6368;
}

.block-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.drag-handle {
    cursor: grab;
    padding: 0.25rem;
    color: #9aa0a6;
    font-size: 1.1rem;
}

.drag-handle:hover {
    color: #5f6368;
}

.drag-handle:active {
    cursor: grabbing;
}

.block-btn {
    padding: 0.375rem 0.75rem;
    border: 1px solid #dadce0;
    background: white;
    border-radius: 6px;
    color: #5f6368;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.block-btn:hover {
    background: #f8f9fa;
    border-color: #4285f4;
    color: #1a73e8;
}

.block-btn.btn-danger:hover {
    background: #fce8e6;
    border-color: #ea4335;
    color: #ea4335;
}

.block-btn.btn-primary {
    background: #4285f4;
    border-color: #4285f4;
    color: white;
}

.block-btn.btn-primary:hover {
    background: #1a73e8;
    border-color: #1a73e8;
}

.block-content {
    padding: 1.5rem;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #5f6368;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 400;
    margin-bottom: 1rem;
    color: #202124;
}

.empty-state p {
    font-size: 1rem;
    margin-bottom: 2rem;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.5;
}

/* Content Type Icons */
.content-type-title { color: #4285f4; }
.content-type-text { color: #34a853; }
.content-type-image { color: #ea4335; }
.content-type-video { color: #ff9800; }
.content-type-audio { color: #9c27b0; }
.content-type-exercise { color: #f4b400; }

/* Upload Areas */
.upload-area {
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #28a745 !important;
    background-color: #f8fff9 !important;
}

.upload-area.dragover {
    border-color: #28a745 !important;
    background-color: #f8fff9 !important;
}

/* Exercise Options */
.option-item .input-group-text {
    background: white;
    border-right: none;
}

.option-item .form-control {
    border-left: none;
}

.option-item .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}

/* Quill Editor Styling */
.ql-toolbar {
    border-top: 1px solid #dee2e6;
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    border-radius: 8px 8px 0 0;
}

.ql-container {
    border-bottom: 1px solid #dee2e6;
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    border-radius: 0 0 8px 8px;
}

/* Mobile toggle button */
.mobile-sidebar-toggle {
    display: none;
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 60;
    background: white;
    border: 1px solid #e8eaed;
    border-radius: 8px;
    padding: 0.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .mobile-sidebar-toggle {
        display: block;
    }

    .lesson-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        width: 100%;
        z-index: 55;
    }

    .lesson-sidebar.open {
        transform: translateX(0);
    }

    .lesson-main {
        margin-left: 0;
        padding: 1rem;
        padding-top: 4rem; /* Account for mobile toggle button */
    }
}
</style>
@endpush

@section('content')
<div class="lesson-editor">
    <!-- Mobile Sidebar Toggle -->
    <button class="mobile-sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- Left Sidebar -->
    <div class="lesson-sidebar" id="lessonSidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="sidebar-title mb-0">
                    <i class="bi bi-journal-text"></i>
                    Lesson Editor
                </h2>
                <a href="{{ route('admin.courses.builder', $lesson->course_id) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <p class="sidebar-subtitle">Add content blocks to build your lesson</p>
        </div>
        
        <div class="content-types-section">
            <h3 class="section-title">Content Types</h3>
            <div class="content-type-list">
                <button class="content-type-btn" onclick="addContentBlock('title')">
                    <i class="bi bi-type content-type-title"></i>
                    <span>Title/Heading</span>
                </button>
                <button class="content-type-btn" onclick="addContentBlock('text')">
                    <i class="bi bi-text-paragraph content-type-text"></i>
                    <span>Text</span>
                </button>
                <button class="content-type-btn" onclick="addContentBlock('image')">
                    <i class="bi bi-image content-type-image"></i>
                    <span>Image</span>
                </button>
                <button class="content-type-btn" onclick="addContentBlock('video')">
                    <i class="bi bi-play-circle content-type-video"></i>
                    <span>Video</span>
                </button>
                <button class="content-type-btn" onclick="addContentBlock('audio')">
                    <i class="bi bi-music-note content-type-audio"></i>
                    <span>Audio</span>
                </button>
                <button class="content-type-btn" onclick="addContentBlock('exercise')">
                    <i class="bi bi-puzzle content-type-exercise"></i>
                    <span>Exercise</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="lesson-main">
        <!-- Lesson Header -->
        <div class="lesson-header">
            <input type="text" class="lesson-title-input" placeholder="Untitled lesson" 
                   value="{{ $lesson->title }}" id="lessonTitle">
            <textarea class="lesson-description-input" placeholder="Add a description for your lesson..." 
                      id="lessonDescription">{{ $lesson->description }}</textarea>
            
            <div class="lesson-meta">
                <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    <span>{{ $lesson->duration ?? 0 }} minutes</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-list-ol"></i>
                    <span>{{ $lesson->contentBlocks->count() }} content blocks</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-eye"></i>
                    <span>{{ ucfirst($lesson->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Content Blocks Container -->
        <div class="content-blocks-container" id="contentBlocksContainer">
            @if($lesson->contentBlocks->count() > 0)
                @foreach($lesson->contentBlocks->sortBy('order') as $block)
                    @include('admin.lessons.partials.content-block-inline', ['block' => $block])
                @endforeach
            @else
                <div class="empty-state" id="emptyState">
                    <i class="bi bi-journal-plus"></i>
                    <h3>Start building your lesson</h3>
                    <p>Click on any content type in the sidebar to add your first content block. You can add text, images, videos, audio, and interactive exercises.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<!-- Quill Rich Text Editor -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- SortableJS for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
// Global variables
let lessonId = {{ $lesson->id }};
let quillEditor = null;
let blockCounter = 0;

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeSortable();
    initializeAutoSave();
});

// Initialize drag and drop sorting
function initializeSortable() {
    const container = document.getElementById('contentBlocksContainer');
    if (container) {
        new Sortable(container, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function(evt) {
                reorderBlocks();
            }
        });
    }
}

// Add new content block
function addContentBlock(type) {
    const container = document.getElementById('contentBlocksContainer');
    const emptyState = document.getElementById('emptyState');

    // Hide empty state if it exists
    if (emptyState) {
        emptyState.style.display = 'none';
    }

    // Create new block HTML
    const blockHtml = createNewBlockHtml(type);

    // Insert at the end
    container.insertAdjacentHTML('beforeend', blockHtml);

    // Initialize editor for text blocks
    if (type === 'text') {
        initializeTextEditor(`textEditor${blockCounter}`);
    }

    // Setup file upload handlers
    setupFileUploadHandlers();

    // Scroll to new block
    const newBlock = container.lastElementChild;
    newBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // Add editing class
    newBlock.classList.add('editing');
}

// Create HTML for new content block
function createNewBlockHtml(type) {
    blockCounter++;

    const typeIcons = {
        'title': 'bi-type content-type-title',
        'text': 'bi-text-paragraph content-type-text',
        'image': 'bi-image content-type-image',
        'video': 'bi-play-circle content-type-video',
        'audio': 'bi-music-note content-type-audio',
        'exercise': 'bi-puzzle content-type-exercise'
    };

    const typeNames = {
        'title': 'Title/Heading',
        'text': 'Text',
        'image': 'Image',
        'video': 'Video',
        'audio': 'Audio',
        'exercise': 'Exercise'
    };

    const contentTemplates = {
        'title': `
            <div class="title-edit">
                <input type="text" class="form-control form-control-lg"
                       placeholder="Enter your title or heading..."
                       style="border: none; font-size: 1.5rem; font-weight: 500;">
            </div>
        `,
        'text': `
            <div class="text-edit">
                <div id="textEditor${blockCounter}" style="min-height: 150px; border: 1px solid #dee2e6; border-radius: 8px;"></div>
            </div>
        `,
        'image': `
            <div class="image-edit">
                <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;">
                    <i class="bi bi-cloud-upload" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem;"></i>
                    <p class="mb-2">Click to upload or drag and drop</p>
                    <small class="text-muted">PNG, JPG, GIF up to 10MB</small>
                    <input type="file" class="d-none" accept="image/*">
                </div>
                <div class="mt-3">
                    <input type="text" class="form-control mb-2" placeholder="Alt text (for accessibility)">
                    <input type="text" class="form-control" placeholder="Caption (optional)">
                </div>
            </div>
        `,
        'video': `
            <div class="video-edit">
                <div class="mb-3">
                    <label class="form-label">Video Source</label>
                    <select class="form-select mb-2" onchange="toggleVideoInput(this)">
                        <option value="url">YouTube/Vimeo URL</option>
                        <option value="upload">Upload File</option>
                    </select>
                    <div class="video-url-input">
                        <input type="url" class="form-control" placeholder="Enter video URL...">
                    </div>
                    <div class="video-upload-area d-none">
                        <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;">
                            <i class="bi bi-play-circle" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem;"></i>
                            <p class="mb-2">Click to upload video file</p>
                            <small class="text-muted">MP4, WebM up to 50MB</small>
                            <input type="file" class="d-none" accept="video/*">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Caption (optional)">
                </div>
            </div>
        `,
        'audio': `
            <div class="audio-edit">
                <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;">
                    <i class="bi bi-music-note" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem;"></i>
                    <p class="mb-2">Click to upload audio file</p>
                    <small class="text-muted">MP3, WAV up to 50MB</small>
                    <input type="file" class="d-none" accept="audio/*">
                </div>
                <div class="mt-3">
                    <input type="text" class="form-control mb-2" placeholder="Audio title">
                    <textarea class="form-control" rows="3" placeholder="Transcript (optional)"></textarea>
                </div>
            </div>
        `,
        'exercise': `
            <div class="exercise-edit">
                <div class="mb-3">
                    <label class="form-label">Exercise Type</label>
                    <select class="form-select mb-3">
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="fill_blanks">Fill in the Blanks</option>
                        <option value="matching">Matching</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <textarea class="form-control" rows="2" placeholder="Enter your question..."></textarea>
                </div>
                <div class="options-container">
                    <label class="form-label">Options</label>
                    <div class="option-item mb-2">
                        <div class="input-group">
                            <span class="input-group-text">
                                <input type="radio" name="correct_answer_${blockCounter}" value="0">
                            </span>
                            <input type="text" class="form-control" placeholder="Option 1">
                        </div>
                    </div>
                    <div class="option-item mb-2">
                        <div class="input-group">
                            <span class="input-group-text">
                                <input type="radio" name="correct_answer_${blockCounter}" value="1">
                            </span>
                            <input type="text" class="form-control" placeholder="Option 2">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
            </div>
        `
    };

    return `
        <div class="content-block editing" data-block-id="new" data-block-type="${type}">
            <div class="block-header">
                <div class="block-type">
                    <i class="bi ${typeIcons[type]}"></i>
                    <span>${typeNames[type]}</span>
                </div>
                <div class="block-actions">
                    <span class="drag-handle">
                        <i class="bi bi-grip-vertical"></i>
                    </span>
                    <button class="block-btn btn-primary" onclick="saveNewBlock(this)">Save</button>
                    <button class="block-btn" onclick="cancelNewBlock(this)">Cancel</button>
                </div>
            </div>
            <div class="block-content">
                ${contentTemplates[type]}
            </div>
        </div>
    `;
}

// Initialize Quill text editor
function initializeTextEditor(editorId = 'textEditor') {
    const editorElement = document.querySelector(`#${editorId}`);
    if (editorElement && !editorElement.classList.contains('ql-container')) {
        const editor = new Quill(`#${editorId}`, {
            theme: 'snow',
            placeholder: 'Start writing your content...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Store reference for later use
        if (editorId.includes('textEditor')) {
            quillEditor = editor;
        }

        return editor;
    }
}

// Setup file upload handlers
function setupFileUploadHandlers() {
    const uploadAreas = document.querySelectorAll('.upload-area');
    uploadAreas.forEach(area => {
        const fileInput = area.querySelector('input[type="file"]');

        // Click to upload
        area.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop
        area.addEventListener('dragover', (e) => {
            e.preventDefault();
            area.classList.add('dragover');
        });

        area.addEventListener('dragleave', () => {
            area.classList.remove('dragover');
        });

        area.addEventListener('drop', (e) => {
            e.preventDefault();
            area.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileUpload(files[0], area);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0], area);
            }
        });
    });
}

// Handle file upload
function handleFileUpload(file, uploadArea) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // Show upload progress
    uploadArea.innerHTML = `
        <i class="bi bi-arrow-clockwise" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem; animation: spin 1s linear infinite;"></i>
        <p class="mb-0">Uploading...</p>
    `;

    fetch('/admin/files/upload-content', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Show preview
            if (file.type.startsWith('image/')) {
                uploadArea.innerHTML = `
                    <img src="${data.url}" alt="Uploaded image" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                    <p class="mt-2 mb-0 text-success">Image uploaded successfully</p>
                `;
            } else if (file.type.startsWith('audio/')) {
                uploadArea.innerHTML = `
                    <audio controls class="w-100">
                        <source src="${data.url}" type="${file.type}">
                    </audio>
                    <p class="mt-2 mb-0 text-success">Audio uploaded successfully</p>
                `;
            } else if (file.type.startsWith('video/')) {
                uploadArea.innerHTML = `
                    <video controls class="w-100" style="max-height: 200px;">
                        <source src="${data.url}" type="${file.type}">
                    </video>
                    <p class="mt-2 mb-0 text-success">Video uploaded successfully</p>
                `;
            }

            // Store URL for saving
            uploadArea.dataset.fileUrl = data.url;
        } else {
            uploadArea.innerHTML = `
                <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #dc3545; margin-bottom: 1rem;"></i>
                <p class="mb-0 text-danger">Upload failed. Please try again.</p>
            `;
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        uploadArea.innerHTML = `
            <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #dc3545; margin-bottom: 1rem;"></i>
            <p class="mb-0 text-danger">Upload failed. Please try again.</p>
        `;
    });
}

// Save new content block
function saveNewBlock(button) {
    const block = button.closest('.content-block');
    const blockType = block.dataset.blockType;
    const blockData = collectBlockData(block, blockType);

    if (!validateBlockData(blockData, blockType)) {
        return;
    }

    // Show saving state
    button.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Saving...';
    button.disabled = true;

    // Prepare the data to send
    const requestData = {
        type: blockType,
        content: blockData,
        order: getNextOrder()
    };

    let requestBody;
    try {
        requestBody = JSON.stringify(requestData);
    } catch (error) {
        console.error('JSON stringify error:', error);
        showNotification('Error preparing data: ' + error.message, 'error');
        button.innerHTML = 'Save';
        button.disabled = false;
        return;
    }

    fetch(`/admin/lessons/${lessonId}/content-blocks`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: requestBody
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Replace with saved block
            block.outerHTML = data.blockHtml;
            showNotification('Content block saved successfully', 'success');

            // Re-initialize sortable
            initializeSortable();
        } else {
            showNotification('Error saving content block: ' + data.message, 'error');
            button.innerHTML = 'Save';
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Save error:', error);
        showNotification('Error saving content block', 'error');
        button.innerHTML = 'Save';
        button.disabled = false;
    });
}

// Cancel new content block
function cancelNewBlock(button) {
    const block = button.closest('.content-block');
    block.remove();

    // Show empty state if no blocks left
    const container = document.getElementById('contentBlocksContainer');
    if (container.children.length === 0) {
        const emptyState = document.getElementById('emptyState');
        if (emptyState) {
            emptyState.style.display = 'block';
        }
    }
}

// Collect data from block form
function collectBlockData(block, type) {
    const data = {};

    switch (type) {
        case 'title':
            data.text = block.querySelector('input[type="text"]').value;
            break;

        case 'text':
            const textEditor = block.querySelector('.ql-editor');
            if (textEditor) {
                // Get the HTML content and ensure it's properly formatted
                data.text = textEditor.innerHTML.trim();
            } else {
                data.text = '';
            }
            break;

        case 'image':
            const uploadArea = block.querySelector('.upload-area');
            data.image_url = uploadArea.dataset.fileUrl || '';
            data.alt_text = block.querySelector('input[placeholder*="Alt text"]').value;
            data.caption = block.querySelector('input[placeholder*="Caption"]').value;
            break;

        case 'video':
            const videoUploadArea = block.querySelector('.upload-area');
            const videoUrlInput = block.querySelector('input[type="url"]');

            // Check if file was uploaded or URL was provided
            data.video_url = videoUploadArea?.dataset.fileUrl || videoUrlInput?.value || '';
            data.caption = block.querySelector('input[placeholder*="Caption"]')?.value || '';
            break;

        case 'audio':
            const audioUploadArea = block.querySelector('.upload-area');
            data.audio_url = audioUploadArea.dataset.fileUrl || '';
            data.title = block.querySelector('input[placeholder*="title"]').value;
            data.transcript = block.querySelector('textarea[placeholder*="Transcript"]').value;
            break;

        case 'exercise':
            data.type = block.querySelector('select').value;
            data.question = block.querySelector('textarea[placeholder*="question"]').value;
            data.options = [];

            const optionInputs = block.querySelectorAll('.option-item input[type="text"]');
            optionInputs.forEach(input => {
                if (input.value.trim()) {
                    data.options.push(input.value.trim());
                }
            });

            const correctAnswer = block.querySelector('input[name^="correct_answer"]:checked');
            data.correct_answer = correctAnswer ? parseInt(correctAnswer.value) : 0;
            break;
    }

    return data;
}

// Validate block data
function validateBlockData(data, type) {
    switch (type) {
        case 'title':
        case 'text':
            if (!data.text || data.text.trim() === '') {
                showNotification('Please enter some text', 'error');
                return false;
            }
            break;

        case 'image':
            if (!data.image_url) {
                showNotification('Please upload an image', 'error');
                return false;
            }
            break;

        case 'video':
            if (!data.video_url) {
                showNotification('Please enter a video URL or upload a video file', 'error');
                return false;
            }
            break;

        case 'audio':
            if (!data.audio_url) {
                showNotification('Please upload an audio file', 'error');
                return false;
            }
            break;

        case 'exercise':
            if (!data.question || data.options.length < 2) {
                showNotification('Please enter a question and at least 2 options', 'error');
                return false;
            }
            break;
    }

    return true;
}

// Get next order number
function getNextOrder() {
    const blocks = document.querySelectorAll('.content-block[data-block-id]:not([data-block-id="new"])');
    return blocks.length + 1;
}

// Show notification
function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
    notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Auto-save lesson title and description
function initializeAutoSave() {
    const titleInput = document.getElementById('lessonTitle');
    const descriptionInput = document.getElementById('lessonDescription');

    let saveTimeout;

    function autoSave() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            saveLessonBasics();
        }, 2000);
    }

    titleInput.addEventListener('input', autoSave);
    descriptionInput.addEventListener('input', autoSave);
}

// Save lesson title and description
function saveLessonBasics() {
    const title = document.getElementById('lessonTitle').value;
    const description = document.getElementById('lessonDescription').value;

    fetch(`/admin/lessons/${lessonId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            title: title,
            description: description
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Lesson basics saved');
        }
    })
    .catch(error => {
        console.error('Auto-save error:', error);
    });
}

// Add option to exercise
function addOption(button) {
    const container = button.parentNode;
    const optionCount = container.querySelectorAll('.option-item').length;
    const block = button.closest('.content-block');
    const radioName = block.querySelector('input[type="radio"]').name;

    const optionHtml = `
        <div class="option-item mb-2">
            <div class="input-group">
                <span class="input-group-text">
                    <input type="radio" name="${radioName}" value="${optionCount}">
                </span>
                <input type="text" class="form-control" placeholder="Option ${optionCount + 1}">
                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;

    button.insertAdjacentHTML('beforebegin', optionHtml);
}

// Remove option from exercise
function removeOption(button) {
    const optionItem = button.closest('.option-item');
    const container = optionItem.parentNode;

    if (container.querySelectorAll('.option-item').length > 2) {
        optionItem.remove();
    } else {
        showNotification('You must have at least 2 options', 'error');
    }
}

// Reorder blocks after drag and drop
function reorderBlocks() {
    const blocks = document.querySelectorAll('.content-block[data-block-id]:not([data-block-id="new"])');
    const blockIds = Array.from(blocks).map((block, index) => ({
        id: parseInt(block.dataset.blockId),
        order: index + 1
    }));

    fetch(`/admin/lessons/${lessonId}/content-blocks/reorder`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            blocks: blockIds
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Blocks reordered successfully');
        }
    })
    .catch(error => {
        console.error('Reorder error:', error);
    });
}

// Toggle sidebar on mobile
function toggleSidebar() {
    const sidebar = document.getElementById('lessonSidebar');
    sidebar.classList.toggle('open');
}

// Toggle video input between URL and upload
function toggleVideoInput(select) {
    const videoEdit = select.closest('.video-edit');
    const urlInput = videoEdit.querySelector('.video-url-input');
    const uploadArea = videoEdit.querySelector('.video-upload-area');

    if (select.value === 'upload') {
        urlInput.classList.add('d-none');
        uploadArea.classList.remove('d-none');
    } else {
        urlInput.classList.remove('d-none');
        uploadArea.classList.add('d-none');
    }
}

// CSS for spinning animation
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .spin {
        animation: spin 1s linear infinite;
    }
`;
document.head.appendChild(style);
</script>
@endpush

@endsection
