@extends('layouts.admin')

@section('title', 'Edit Test - ' . $test->title)

@section('content')
<style>
/* Test Editor Styles */
.test-editor {
    background: #f8f9fa;
    min-height: 100vh;
    font-family: 'Google Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    display: flex;
    position: relative;
}

/* Sidebar Styles */
.test-sidebar {
    width: 280px;
    background: white;
    border-right: 1px solid #e0e0e0;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    z-index: 100;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e0e0e0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.sidebar-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.question-types-section {
    padding: 1.5rem;
}

.section-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: #5f6368;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.question-type-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.question-type-btn {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
    cursor: pointer;
    width: 100%;
}

.question-type-btn:hover {
    background: #fff3e0;
    border-color: #ff6b35;
    color: #ff6b35;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
}

.question-type-btn i {
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

/* Main Content Area */
.test-main {
    flex: 1;
    padding: 2rem;
    overflow-y: auto;
}

.test-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
}

.test-title {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.test-description {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.test-stats {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    border-radius: 8px;
    background: #f8f9fa;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 500;
}

/* Test Settings Card */
.test-settings-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-left: 4px solid #667eea;
}

/* Questions Container */
.questions-container {
    margin-bottom: 2rem;
}

.question-block {
    background: white;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.question-block:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.question-block.editing {
    border: 2px solid #667eea;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
}

.question-header {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.question-type-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.question-actions {
    display: flex;
    gap: 0.25rem;
}

.question-content {
    padding: 1.5rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.empty-state-icon {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

/* Question Type Icons */
.question-type-mcq { color: #007bff; }
.question-type-mcq_image { color: #28a745; }
.question-type-audio { color: #fd7e14; }
.question-type-video { color: #dc3545; }
.question-type-image_mcq { color: #17a2b8; }
.question-type-fill_blanks { color: #6f42c1; }

/* Responsive Design */
@media (max-width: 768px) {
    .test-editor {
        flex-direction: column;
    }
    
    .test-sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    
    .test-main {
        padding: 1rem;
    }
}

/* Animation for new questions */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.question-block.new {
    animation: slideInUp 0.5s ease;
}

/* Notification Styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 300px;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    transform: translateX(400px);
    transition: transform 0.3s ease;
}

.notification.show {
    transform: translateX(0);
}

.notification.success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.notification.error {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
}

.notification.info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

/* Upload Area Styles */
.upload-area {
    border: 2px dashed #e0e0e0;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
}

.upload-area:hover {
    border-color: #667eea;
    background: #f0f4ff;
}

.upload-area.drag-over {
    border-color: #667eea;
    background: #e3f2fd;
    transform: scale(1.02);
}

.upload-placeholder {
    color: #6c757d;
}

.upload-placeholder i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

.upload-placeholder p {
    margin: 0;
    font-size: 0.9rem;
}

.upload-preview {
    text-align: center;
}

/* Form Styles */
.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

.btn-outline-secondary {
    border-color: #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}

.btn-outline-primary {
    border-color: #667eea;
    color: #667eea;
}

.btn-outline-primary:hover {
    background: #667eea;
    border-color: #667eea;
    transform: translateY(-2px);
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    transform: translateY(-2px);
}

/* Option Items */
.option-item {
    margin-bottom: 0.75rem;
}

.input-group-text {
    background: #f8f9fa;
    border-color: #e9ecef;
}

/* Video Type Toggle */
.btn-group .btn-check:checked + .btn {
    background: #667eea;
    border-color: #667eea;
    color: white;
}

/* Drag Handle */
.drag-handle {
    cursor: grab;
    color: #6c757d;
    padding: 0.5rem;
    border: none;
    background: none;
}

.drag-handle:hover {
    color: #495057;
}

.drag-handle:active {
    cursor: grabbing;
}

/* Dragging State */
.dragging {
    opacity: 0.5;
    transform: rotate(5deg);
}

/* Spin Animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.spin {
    animation: spin 1s linear infinite;
}
</style>

<div class="test-editor">
    <!-- Left Sidebar -->
    <div class="test-sidebar" id="testSidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title mb-0">
                <i class="bi bi-clipboard-check"></i>
                Test Editor
            </h2>
        </div>
        
        <div class="question-types-section">
            <h3 class="section-title">Question Types</h3>
            <div class="question-type-list">
                <button class="question-type-btn" onclick="addQuestion('mcq')">
                    <i class="bi bi-list-ul question-type-mcq"></i>
                    <span>Multiple Choice</span>
                </button>
                <button class="question-type-btn" onclick="addQuestion('mcq_image')">
                    <i class="bi bi-image question-type-mcq_image"></i>
                    <span>MCQ with Image</span>
                </button>
                <button class="question-type-btn" onclick="addQuestion('audio')">
                    <i class="bi bi-volume-up question-type-audio"></i>
                    <span>Audio + MCQ</span>
                </button>
                <button class="question-type-btn" onclick="addQuestion('video')">
                    <i class="bi bi-play-circle question-type-video"></i>
                    <span>Video Question</span>
                </button>
                <button class="question-type-btn" onclick="addQuestion('image_mcq')">
                    <i class="bi bi-card-image question-type-image_mcq"></i>
                    <span>Image-based MCQ</span>
                </button>
                <button class="question-type-btn" onclick="addQuestion('fill_blanks')">
                    <i class="bi bi-dash-square question-type-fill_blanks"></i>
                    <span>Fill in the Blanks</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="test-main">
        <!-- Test Header -->
        <div class="test-header">
            <h1 class="test-title">{{ $test->title }}</h1>
            <p class="test-description">{{ $test->description ?: 'Create and manage test questions with multiple question types' }}</p>
        </div>

        <!-- Test Statistics -->
        <div class="test-stats">
            <div class="stat-item">
                <span class="stat-number" id="questionsCount">{{ $test->questions->count() }}</span>
                <div class="stat-label">Questions</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $test->time_limit ?? 0 }}</span>
                <div class="stat-label">Minutes</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $test->passing_score }}%</span>
                <div class="stat-label">Passing Score</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $test->max_attempts ?? 'Unlimited' }}</span>
                <div class="stat-label">Max Attempts</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ ucfirst($test->status) }}</span>
                <div class="stat-label">Status</div>
            </div>
        </div>

        <!-- Test Settings -->
        <div class="test-settings-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <i class="bi bi-gear me-2"></i>
                    Test Settings
                </h5>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-info" onclick="previewTest()">
                        <i class="bi bi-eye me-2"></i>
                        Preview (Student View)
                    </button>
                    <button type="button" class="btn btn-success" onclick="saveTestSettings()">
                        <i class="bi bi-check-circle me-2"></i>
                        Save Settings
                    </button>
                </div>
            </div>

            <form id="testSettingsForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Test Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $test->title }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="{{ $test->time_limit }}" min="1">
                            <small class="form-text text-muted">Leave empty for unlimited time</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="passing_score" class="form-label">Passing Score (%)</label>
                            <input type="number" class="form-control" id="passing_score" name="passing_score" value="{{ $test->passing_score }}" min="0" max="100" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="max_attempts" class="form-label">Max Attempts</label>
                            <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="{{ $test->max_attempts ?? 3 }}" min="1" max="10">
                            <small class="form-text text-muted">Number of times students can retake this test</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="draft" {{ $test->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $test->status === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ $test->status === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe what this test covers...">{{ $test->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="randomize_questions" name="randomize_questions" {{ $test->randomize_questions ? 'checked' : '' }}>
                                <label class="form-check-label" for="randomize_questions">
                                    <strong>Randomize question order</strong>
                                    <br><small class="text-muted">Questions will appear in random order for each student</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="show_results" name="show_results" {{ $test->show_answers ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_results">
                                    <strong>Show results after completion</strong>
                                    <br><small class="text-muted">Students can see their score and correct answers</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Questions Container -->
        <div class="questions-container" id="questionsContainer">
            @forelse($test->questions as $question)
                @include('admin.tests.partials.question-block-inline', ['question' => $question])
            @empty
                <div class="empty-state" id="emptyState">
                    <div class="empty-state-icon">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <h5 class="text-muted mb-3">No Questions Yet</h5>
                    <p class="text-muted mb-4">Start building your test by adding questions using the sidebar.</p>
                    <button type="button" class="btn btn-primary" onclick="addQuestion('mcq')">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Your First Question
                    </button>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
// Global variables
let testId = {{ $test->id }};
let questionCounter = 0;

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeSortable();
    updateEmptyState();
});

// Initialize drag and drop sorting
function initializeSortable() {
    const container = document.getElementById('questionsContainer');
    if (container && !container.querySelector('.empty-state')) {
        new Sortable(container, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function(evt) {
                updateQuestionOrder();
            }
        });
    }
}

// Question templates for inline editing
const questionTemplates = {
    'mcq': `
        <div class="question-block editing new" data-question-type="mcq">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-list-ul question-type-mcq"></i>
                    <span>Multiple Choice Question</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question here..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer Options</label>
                    <div class="options-container">
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Explanation (Optional)</label>
                            <textarea class="form-control explanation-input" rows="2" placeholder="Explain the correct answer..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    'mcq_image': `
        <div class="question-block editing new" data-question-type="mcq_image">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-image question-type-mcq_image"></i>
                    <span>MCQ with Image</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question here..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question Image</label>
                    <div class="upload-area" onclick="triggerFileUpload(this)">
                        <input type="file" class="file-input" accept="image/*" style="display: none;" onchange="handleFileUpload(this)">
                        <div class="upload-placeholder">
                            <i class="bi bi-cloud-upload"></i>
                            <p>Click to upload image or drag and drop</p>
                        </div>
                        <div class="upload-preview" style="display: none;">
                            <img class="preview-image" style="max-width: 100%; height: auto; border-radius: 8px;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeUpload(this)">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer Options</label>
                    <div class="options-container">
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Explanation (Optional)</label>
                            <textarea class="form-control explanation-input" rows="2" placeholder="Explain the correct answer..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    'video': `
        <div class="question-block editing new" data-question-type="video">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-play-circle question-type-video"></i>
                    <span>Video Question</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question here..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Video Source</label>
                    <div class="video-input-type mb-2">
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="video_type" id="video_url" value="url" checked>
                            <label class="btn btn-outline-primary" for="video_url">URL</label>
                            <input type="radio" class="btn-check" name="video_type" id="video_upload" value="upload">
                            <label class="btn btn-outline-primary" for="video_upload">Upload</label>
                        </div>
                    </div>
                    <div class="video-url-input">
                        <input type="url" class="form-control" placeholder="Enter video URL (YouTube, Vimeo, etc.)">
                    </div>
                    <div class="video-upload-input" style="display: none;">
                        <div class="upload-area" onclick="triggerFileUpload(this)">
                            <input type="file" class="file-input" accept="video/*" style="display: none;" onchange="handleFileUpload(this)">
                            <div class="upload-placeholder">
                                <i class="bi bi-cloud-upload"></i>
                                <p>Click to upload video or drag and drop</p>
                            </div>
                            <div class="upload-preview" style="display: none;">
                                <video class="preview-video" controls style="max-width: 100%; height: auto; border-radius: 8px;"></video>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeUpload(this)">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer Options</label>
                    <div class="options-container">
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Explanation (Optional)</label>
                            <textarea class="form-control explanation-input" rows="2" placeholder="Explain the correct answer..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    'audio': `
        <div class="question-block editing new" data-question-type="audio">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-volume-up question-type-audio"></i>
                    <span>Audio + MCQ</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question about the audio..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Audio File</label>
                    <div class="upload-area" onclick="triggerFileUpload(this)">
                        <input type="file" class="file-input" accept="audio/mp3,audio/wav,audio/ogg,audio/mpeg,audio/m4a,.mp3,.wav,.ogg,.m4a" style="display: none;" onchange="handleFileUpload(this)">
                        <div class="upload-placeholder">
                            <i class="bi bi-cloud-upload"></i>
                            <p>Click to upload audio or drag and drop</p>
                            <small class="text-muted">Supported formats: MP3, WAV, OGG, M4A (No size limit)</small>
                        </div>
                        <div class="upload-preview" style="display: none;">
                            <audio class="preview-audio" controls style="width: 100%; margin-bottom: 10px;"></audio>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeUpload(this)">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer Options</label>
                    <div class="options-container">
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Explanation (Optional)</label>
                    <textarea class="form-control explanation-input" rows="2" placeholder="Explain why this is the correct answer..."></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    'image_mcq': `
        <div class="question-block editing new" data-question-type="image_mcq">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-card-image question-type-image_mcq"></i>
                    <span>Image-based MCQ</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question about the image..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question Image</label>
                    <div class="upload-area" onclick="triggerFileUpload(this)">
                        <input type="file" class="file-input" accept="image/*" style="display: none;" onchange="handleFileUpload(this)">
                        <div class="upload-placeholder">
                            <i class="bi bi-cloud-upload"></i>
                            <p>Click to upload image or drag and drop</p>
                        </div>
                        <div class="upload-preview" style="display: none;">
                            <img class="preview-image" style="max-width: 100%; height: auto; border-radius: 8px;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeUpload(this)">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer Options</label>
                    <div class="options-container">
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="option-item mb-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                </div>
                                <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                        <i class="bi bi-plus"></i> Add Option
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Explanation (Optional)</label>
                            <textarea class="form-control explanation-input" rows="2" placeholder="Explain the correct answer..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    'fill_blanks': `
        <div class="question-block editing new" data-question-type="fill_blanks">
            <div class="question-header">
                <div class="question-type-indicator">
                    <i class="bi bi-dash-square question-type-fill_blanks"></i>
                    <span>Fill in the Blanks</span>
                </div>
                <div class="question-actions">
                    <button type="button" class="btn btn-sm btn-success" onclick="saveNewQuestion(this)">
                        <i class="bi bi-check"></i> Save
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="cancelNewQuestion(this)">
                        <i class="bi bi-x"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="question-content">
                <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea class="form-control question-text-input" rows="3" placeholder="Enter your question with blanks (use _____ for blanks)..." required></textarea>
                    <small class="form-text text-muted">Use underscores (____) to indicate where students should fill in answers.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correct Answers</label>
                    <input type="text" class="form-control answers-input" placeholder="Enter correct answers separated by commas" required>
                    <small class="form-text text-muted">Example: answer1, answer2, answer3</small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control points-input" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Explanation (Optional)</label>
                            <textarea class="form-control explanation-input" rows="2" placeholder="Explain the correct answers..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `
};

// Add question function
function addQuestion(type) {
    const container = document.getElementById('questionsContainer');
    const emptyState = document.getElementById('emptyState');

    if (emptyState) {
        emptyState.style.display = 'none';
    }

    const questionHtml = createNewQuestionHtml(type);
    container.insertAdjacentHTML('beforeend', questionHtml);
    setupFileUploadHandlers();

    const newQuestion = container.lastElementChild;
    newQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
    newQuestion.classList.add('editing');

    // Setup video type toggle if it's a video question
    if (type === 'video') {
        setupVideoTypeToggle(newQuestion);
    }
}

// Create new question HTML
function createNewQuestionHtml(type) {
    questionCounter++;
    return questionTemplates[type] || questionTemplates['mcq'];
}

// Setup video type toggle
function setupVideoTypeToggle(questionBlock) {
    const urlRadio = questionBlock.querySelector('input[value="url"]');
    const uploadRadio = questionBlock.querySelector('input[value="upload"]');
    const urlInput = questionBlock.querySelector('.video-url-input');
    const uploadInput = questionBlock.querySelector('.video-upload-input');

    urlRadio.addEventListener('change', function() {
        if (this.checked) {
            urlInput.style.display = 'block';
            uploadInput.style.display = 'none';
        }
    });

    uploadRadio.addEventListener('change', function() {
        if (this.checked) {
            urlInput.style.display = 'none';
            uploadInput.style.display = 'block';
        }
    });
}

// Save new question
function saveNewQuestion(button) {
    const questionBlock = button.closest('.question-block');
    const questionType = questionBlock.dataset.questionType;
    const questionData = collectQuestionData(questionBlock, questionType);

    if (!validateQuestionData(questionData, questionType)) {
        return;
    }

    button.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Saving...';
    button.disabled = true;

    const requestData = {
        type: questionType,
        question_text: questionData.question_text,
        question_media: questionData.question_media || null,
        correct_answer: questionData.correct_answer,
        explanation: questionData.explanation || null,
        points: questionData.points || 1,
        options: questionData.options || null
    };

    fetch(`/admin/tests/${testId}/questions`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            questionBlock.outerHTML = data.questionHtml;
            showNotification('Question saved successfully', 'success');
            initializeSortable();
        } else {
            showNotification('Error saving question: ' + data.message, 'error');
            button.innerHTML = 'Save';
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Save error:', error);
        showNotification('Error saving question', 'error');
        button.innerHTML = 'Save';
        button.disabled = false;
    });
}

// Cancel new question
function cancelNewQuestion(button) {
    const questionBlock = button.closest('.question-block');
    questionBlock.remove();
    updateEmptyState();
}

// Collect question data from form
function collectQuestionData(questionBlock, questionType) {
    const data = {
        question_text: questionBlock.querySelector('.question-text-input').value.trim(),
        points: parseInt(questionBlock.querySelector('.points-input').value) || 1,
        explanation: questionBlock.querySelector('.explanation-input')?.value.trim() || null
    };

    // Handle media upload
    const fileInput = questionBlock.querySelector('.file-input');
    if (fileInput && fileInput.files.length > 0) {
        data.question_media = fileInput.getAttribute('data-uploaded-url') || null;
    } else if (questionType === 'video') {
        const videoUrlInput = questionBlock.querySelector('.video-url-input input');
        if (videoUrlInput && videoUrlInput.value.trim()) {
            data.question_media = videoUrlInput.value.trim();
        }
    }

    // Handle options for MCQ questions
    if (['mcq', 'mcq_image', 'audio', 'video', 'image_mcq'].includes(questionType)) {
        data.options = [];
        data.correct_answer = [];

        const optionItems = questionBlock.querySelectorAll('.option-item');
        const correctAnswerRadio = questionBlock.querySelector('input[name="correct_answer"]:checked');

        if (correctAnswerRadio) {
            data.correct_answer = [parseInt(correctAnswerRadio.value)];
        }

        optionItems.forEach((item, index) => {
            const optionText = item.querySelector('.option-text').value.trim();
            if (optionText) {
                data.options.push({
                    text: optionText,
                    is_correct: correctAnswerRadio && parseInt(correctAnswerRadio.value) === index
                });
            }
        });
    }

    // Handle fill in the blanks
    if (questionType === 'fill_blanks') {
        const answersInput = questionBlock.querySelector('.answers-input');
        if (answersInput) {
            data.correct_answer = answersInput.value.split(',').map(s => s.trim()).filter(s => s);
        }
    }

    return data;
}

// Validate question data
function validateQuestionData(data, questionType) {
    if (!data.question_text) {
        showNotification('Please enter a question text', 'error');
        return false;
    }

    if (['mcq', 'mcq_image', 'audio', 'video', 'image_mcq'].includes(questionType)) {
        if (!data.options || data.options.length < 2) {
            showNotification('Please add at least 2 options', 'error');
            return false;
        }
        if (!data.correct_answer || data.correct_answer.length === 0) {
            showNotification('Please select a correct answer', 'error');
            return false;
        }
    }

    if (questionType === 'fill_blanks') {
        if (!data.correct_answer || data.correct_answer.length === 0) {
            showNotification('Please provide correct answers', 'error');
            return false;
        }
    }

    return true;
}

// Add option to MCQ question
function addOption(button) {
    const optionsContainer = button.previousElementSibling;
    const optionCount = optionsContainer.children.length;

    const optionHtml = `
        <div class="option-item mb-2">
            <div class="input-group">
                <div class="input-group-text">
                    <input type="radio" name="correct_answer" value="${optionCount}" class="form-check-input">
                </div>
                <input type="text" class="form-control option-text" placeholder="Option ${optionCount + 1}" required>
                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;

    optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
    updateRemoveButtons(optionsContainer);
}

// Remove option from MCQ question
function removeOption(button) {
    const optionItem = button.closest('.option-item');
    const container = optionItem.parentElement;

    if (container.children.length > 2) {
        optionItem.remove();
        updateOptionNumbers(container);
        updateRemoveButtons(container);
    }
}

// Update option numbers and radio values
function updateOptionNumbers(container) {
    const options = container.children;
    for (let i = 0; i < options.length; i++) {
        const option = options[i];
        const radio = option.querySelector('input[type="radio"]');
        const textInput = option.querySelector('.option-text');

        radio.value = i;
        textInput.placeholder = `Option ${i + 1}`;
    }
}

// Update remove button visibility
function updateRemoveButtons(container) {
    const removeButtons = container.querySelectorAll('.btn-outline-danger');
    removeButtons.forEach(button => {
        button.style.display = container.children.length > 2 ? 'inline-block' : 'none';
    });
}

// Delete question
function deleteQuestion(button) {
    if (!confirm('Are you sure you want to delete this question?')) {
        return;
    }

    const questionBlock = button.closest('.question-block');
    const questionId = questionBlock.dataset.questionId;

    console.log('Delete question:', questionId, 'Test ID:', testId);

    if (!questionId) {
        showNotification('Error: Question ID not found', 'error');
        return;
    }

    fetch(`/admin/tests/${testId}/questions/${questionId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            questionBlock.remove();
            showNotification('Question deleted successfully', 'success');
            updateEmptyState();
            updateStats();
        } else {
            showNotification('Error deleting question: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        showNotification('Error deleting question', 'error');
    });
}

// Edit question
function editQuestion(button) {
    const questionBlock = button.closest('.question-block');
    const questionId = questionBlock.dataset.questionId;

    if (!questionId) {
        showNotification('Cannot edit question: No question ID found', 'error');
        return;
    }

    // Toggle editing mode
    if (questionBlock.classList.contains('editing')) {
        // Save changes and exit editing mode
        saveQuestionChanges(questionBlock, questionId, button);
    } else {
        // Enter editing mode
        questionBlock.classList.add('editing');
        button.innerHTML = '<i class="bi bi-check-lg"></i>';
        button.title = 'Save Changes';

        // Make fields editable - work with actual structure
        const questionDisplay = questionBlock.querySelector('.question-display h6');
        const explanationDiv = questionBlock.querySelector('.explanation');
        const pointsDiv = questionBlock.querySelector('.question-meta');

        if (questionDisplay) {
            const currentText = questionDisplay.textContent.trim();
            questionDisplay.innerHTML = `<input type="text" class="form-control question-text-edit" value="${currentText}">`;
        }

        if (explanationDiv) {
            const explanationText = explanationDiv.querySelector('small');
            const currentExplanation = explanationText ? explanationText.textContent.replace('Explanation: ', '').trim() : '';
            explanationDiv.innerHTML = `<small class="text-muted"><strong>Explanation:</strong> <textarea class="form-control explanation-edit mt-1" rows="2">${currentExplanation}</textarea></small>`;
        } else {
            // Add explanation field if it doesn't exist
            const questionContent = questionBlock.querySelector('.question-display');
            const explanationHtml = `<div class="explanation mt-3"><small class="text-muted"><strong>Explanation:</strong> <textarea class="form-control explanation-edit mt-1" rows="2" placeholder="Add explanation (optional)"></textarea></small></div>`;
            questionContent.insertAdjacentHTML('beforeend', explanationHtml);
        }

        if (pointsDiv) {
            const currentPoints = pointsDiv.textContent.replace('Points: ', '').trim();
            pointsDiv.innerHTML = `<small class="text-muted">Points: <input type="number" class="form-control points-edit d-inline-block" value="${currentPoints}" min="1" max="10" style="width: 80px;"></small>`;
        }

        // Make options editable for MCQ questions
        const questionOptions = questionBlock.querySelector('.question-options');
        if (questionOptions) {
            makeOptionsEditable(questionOptions);
        }

        showNotification('Edit mode enabled. Click the check button to save changes.', 'info');
    }
}

// Make options editable
function makeOptionsEditable(optionsContainer) {
    const optionItems = optionsContainer.querySelectorAll('.form-check');

    optionItems.forEach((item, index) => {
        const label = item.querySelector('.form-check-label');
        const radio = item.querySelector('.form-check-input');
        const isCorrect = radio.checked;

        if (label) {
            const currentText = label.textContent.trim();
            // Remove the check icon if present
            const cleanText = currentText.replace(/✓.*$/, '').trim();

            label.innerHTML = `
                <input type="text" class="form-control option-text-edit d-inline-block me-2" value="${cleanText}" style="width: 300px;">
                <input type="radio" class="form-check-input option-correct-edit" name="correct_option_edit" value="${index}" ${isCorrect ? 'checked' : ''}>
                <label class="form-check-label ms-1">Correct</label>
            `;
        }
    });

    // Add button to add new option
    const addOptionBtn = document.createElement('button');
    addOptionBtn.type = 'button';
    addOptionBtn.className = 'btn btn-sm btn-outline-primary mt-2';
    addOptionBtn.innerHTML = '<i class="bi bi-plus"></i> Add Option';
    addOptionBtn.onclick = () => addNewOptionEdit(optionsContainer);
    optionsContainer.appendChild(addOptionBtn);
}

// Add new option in edit mode
function addNewOptionEdit(optionsContainer) {
    const optionItems = optionsContainer.querySelectorAll('.form-check');
    const newIndex = optionItems.length;

    const newOption = document.createElement('div');
    newOption.className = 'form-check mb-2';
    newOption.innerHTML = `
        <label class="form-check-label">
            <input type="text" class="form-control option-text-edit d-inline-block me-2" value="" placeholder="Enter option text" style="width: 300px;">
            <input type="radio" class="form-check-input option-correct-edit" name="correct_option_edit" value="${newIndex}">
            <label class="form-check-label ms-1">Correct</label>
            <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeOptionEdit(this)">
                <i class="bi bi-trash"></i>
            </button>
        </label>
    `;

    // Insert before the add button
    const addBtn = optionsContainer.querySelector('button');
    optionsContainer.insertBefore(newOption, addBtn);
}

// Remove option in edit mode
function removeOptionEdit(button) {
    const optionItem = button.closest('.form-check');
    optionItem.remove();
}

// Save question changes
function saveQuestionChanges(questionBlock, questionId, button) {
    const questionTextInput = questionBlock.querySelector('.question-text-edit');
    const explanationInput = questionBlock.querySelector('.explanation-edit');
    const pointsInput = questionBlock.querySelector('.points-edit');

    if (!questionTextInput) {
        showNotification('Error: Question text input not found', 'error');
        return;
    }

    const updatedData = {
        question_text: questionTextInput.value.trim(),
        explanation: explanationInput ? explanationInput.value.trim() : '',
        points: pointsInput ? parseInt(pointsInput.value) || 1 : 1
    };

    // Collect options if this is an MCQ question
    const optionsContainer = questionBlock.querySelector('.question-options');
    if (optionsContainer) {
        const optionInputs = optionsContainer.querySelectorAll('.option-text-edit');
        const correctRadio = optionsContainer.querySelector('input[name="correct_option_edit"]:checked');

        updatedData.options = [];
        let validOptionIndex = 0;

        optionInputs.forEach((input, originalIndex) => {
            const text = input.value.trim();
            if (text) {
                updatedData.options.push({
                    text: text,
                    is_correct: correctRadio && parseInt(correctRadio.value) === originalIndex
                });
                validOptionIndex++;
            }
        });

        // Only include options if we have at least one valid option
        if (updatedData.options.length === 0) {
            delete updatedData.options;
        }
    }

    if (!updatedData.question_text) {
        showNotification('Question text cannot be empty', 'error');
        return;
    }

    // Show loading state
    button.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i>';
    button.disabled = true;

    console.log('Updating question:', questionId, 'with data:', updatedData);

    console.log('Sending update data:', updatedData);

    fetch(`/admin/tests/${testId}/questions/${questionId}/update-basic`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Server error response:', text);
                throw new Error(`Server error: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Update the display - work with actual structure
            const questionDisplay = questionBlock.querySelector('.question-display h6');
            const explanationDiv = questionBlock.querySelector('.explanation');
            const pointsDiv = questionBlock.querySelector('.question-meta');

            if (questionDisplay) {
                questionDisplay.textContent = updatedData.question_text;
            }

            if (explanationDiv) {
                if (updatedData.explanation) {
                    explanationDiv.innerHTML = `<small class="text-muted"><strong>Explanation:</strong> ${updatedData.explanation}</small>`;
                } else {
                    explanationDiv.remove();
                }
            } else if (updatedData.explanation) {
                // Add explanation if it was added
                const questionContent = questionBlock.querySelector('.question-display');
                const explanationHtml = `<div class="explanation mt-3"><small class="text-muted"><strong>Explanation:</strong> ${updatedData.explanation}</small></div>`;
                questionContent.insertAdjacentHTML('beforeend', explanationHtml);
            }

            if (pointsDiv) {
                pointsDiv.innerHTML = `<small class="text-muted">Points: ${updatedData.points}</small>`;
            }

            // Restore options display if they were updated
            const optionsContainer = questionBlock.querySelector('.question-options');
            if (optionsContainer && updatedData.options) {
                restoreOptionsDisplay(optionsContainer, updatedData.options);
            }

            // Exit editing mode
            questionBlock.classList.remove('editing');
            button.innerHTML = '<i class="bi bi-pencil"></i>';
            button.title = 'Edit Question';
            button.disabled = false;

            showNotification('Question updated successfully', 'success');
        } else {
            showNotification('Error updating question: ' + data.message, 'error');
            button.innerHTML = '<i class="bi bi-check-lg"></i>';
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Update error:', error);
        showNotification('Error updating question', 'error');
        button.innerHTML = '<i class="bi bi-check-lg"></i>';
        button.disabled = false;
    });
}

// Restore options display after saving
function restoreOptionsDisplay(optionsContainer, options) {
    optionsContainer.innerHTML = '';

    options.forEach((option, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = `form-check mb-2 ${option.is_correct ? 'text-success fw-bold' : ''}`;
        optionDiv.innerHTML = `
            <input class="form-check-input" type="radio" disabled ${option.is_correct ? 'checked' : ''}>
            <label class="form-check-label">
                ${option.text}
                ${option.is_correct ? '<i class="bi bi-check-circle-fill text-success ms-2"></i>' : ''}
            </label>
        `;
        optionsContainer.appendChild(optionDiv);
    });
}

// Update question order after drag and drop
function updateQuestionOrder() {
    const questions = Array.from(document.querySelectorAll('.question-block[data-question-id]')).map((question, index) => ({
        id: parseInt(question.dataset.questionId),
        order: index + 1
    }));

    fetch(`/admin/tests/${testId}/questions/reorder`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ questions: questions })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Questions reordered successfully');
        }
    })
    .catch(error => {
        console.error('Reorder error:', error);
    });
}

// Update empty state
function updateEmptyState() {
    const container = document.getElementById('questionsContainer');
    const emptyState = document.getElementById('emptyState');
    const hasQuestions = container.querySelectorAll('.question-block[data-question-id]').length > 0;

    if (emptyState) {
        emptyState.style.display = hasQuestions ? 'none' : 'block';
    }
}

// Update statistics
function updateStats() {
    const questionCount = document.querySelectorAll('.question-block[data-question-id]').length;
    document.getElementById('questionsCount').textContent = questionCount;
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => notification.classList.add('show'), 100);

    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// File upload functionality
function setupFileUploadHandlers() {
    const uploadAreas = document.querySelectorAll('.upload-area');
    uploadAreas.forEach(area => {
        area.addEventListener('dragover', handleDragOver);
        area.addEventListener('drop', handleDrop);
        area.addEventListener('dragleave', handleDragLeave);
    });
}

function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.add('drag-over');
}

function handleDragLeave(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('drag-over');
}

function handleDrop(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('drag-over');

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const fileInput = this.querySelector('.file-input');
        fileInput.files = files;
        handleFileUpload(fileInput);
    }
}

function triggerFileUpload(uploadArea) {
    const fileInput = uploadArea.querySelector('.file-input');
    fileInput.click();
}

function handleFileUpload(fileInput) {
    const file = fileInput.files[0];
    if (!file) {
        console.error('No file selected');
        return;
    }

    console.log('Uploading file:', file.name, 'Type:', file.type, 'Size:', file.size, 'Size in MB:', (file.size / 1024 / 1024).toFixed(2));

    // No file size limit - allow unlimited uploads
    console.log('File size check: No limit enforced, allowing upload of', (file.size / 1024 / 1024).toFixed(2), 'MB file');

    const uploadArea = fileInput.closest('.upload-area');
    const placeholder = uploadArea.querySelector('.upload-placeholder');
    const preview = uploadArea.querySelector('.upload-preview');

    // Show loading state with file size info
    const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
    placeholder.innerHTML = `<i class="bi bi-arrow-clockwise spin"></i><p>Uploading ${fileSizeMB}MB file...</p><div class="progress mt-2"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div></div>`;

    const formData = new FormData();
    formData.append('file', file);

    // Determine file type
    let fileType = 'file';
    if (file.type.startsWith('image/')) {
        fileType = 'image';
    } else if (file.type.startsWith('video/')) {
        fileType = 'video';
    } else if (file.type.startsWith('audio/')) {
        fileType = 'audio';
    }
    console.log('Detected file type:', fileType);
    console.log('FormData contents:', Array.from(formData.entries()));
    formData.append('type', fileType);

    console.log('Sending request to /admin/files/upload-content');
    console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // Try the upload with current server configuration
    fetch('/admin/files/upload-content', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        console.log('Upload response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text().then(text => {
            console.log('Upload response text:', text);
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error('JSON parse error:', e);
                throw new Error('Invalid JSON response: ' + text.substring(0, 100));
            }
        });
    })
    .then(data => {
        if (data.success) {
            // Store the uploaded file URL
            fileInput.setAttribute('data-uploaded-url', data.url);

            // Show preview
            placeholder.style.display = 'none';
            preview.style.display = 'block';

            if (file.type.startsWith('image/')) {
                const img = preview.querySelector('.preview-image');
                if (img) img.src = data.url;
            } else if (file.type.startsWith('video/')) {
                const video = preview.querySelector('.preview-video');
                if (video) video.src = data.url;
            } else if (file.type.startsWith('audio/')) {
                const audio = preview.querySelector('.preview-audio');
                if (audio) audio.src = data.url;
            }

            showNotification('File uploaded successfully', 'success');
        } else {
            showNotification('Upload failed: ' + data.message, 'error');
            // Reset placeholder
            placeholder.innerHTML = '<i class="bi bi-cloud-upload"></i><p>Click to upload or drag and drop</p>';
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        let errorMessage = error.message;
        let suggestions = '';

        // Provide helpful suggestions based on error type
        if (error.message.includes('upload_max_filesize') || error.message.includes('422')) {
            suggestions = '<br><small class="text-muted">💡 Try: Use a smaller file or compress your audio file manually.</small>';
        }

        showNotification('Upload failed: ' + errorMessage, 'error');
        // Reset placeholder with suggestions
        placeholder.innerHTML = `<i class="bi bi-exclamation-triangle text-danger"></i><p class="text-danger">Upload failed: ${errorMessage}${suggestions}</p>`;
    });
}

function removeUpload(button) {
    const uploadArea = button.closest('.upload-area');
    const placeholder = uploadArea.querySelector('.upload-placeholder');
    const preview = uploadArea.querySelector('.upload-preview');
    const fileInput = uploadArea.querySelector('.file-input');

    // Reset file input
    fileInput.value = '';
    fileInput.removeAttribute('data-uploaded-url');

    // Show placeholder, hide preview
    placeholder.style.display = 'block';
    preview.style.display = 'none';

    // Reset placeholder content
    placeholder.innerHTML = '<i class="bi bi-cloud-upload"></i><p>Click to upload or drag and drop</p>';
}

// Save test settings
function saveTestSettings() {
    const formData = new FormData(document.getElementById('testSettingsForm'));
    const data = Object.fromEntries(formData);

    // Convert checkboxes to boolean
    data.randomize_questions = document.getElementById('randomize_questions').checked;
    data.show_results = document.getElementById('show_results').checked;

    fetch(`/admin/tests/${testId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Test settings saved successfully', 'success');
            // Update the header title if changed
            document.querySelector('.test-title').textContent = data.test.title;
            // Update stats
            updateTestStats(data.test);
        } else {
            showNotification('Error saving settings: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Save error:', error);
        showNotification('Error saving settings', 'error');
    });
}

// Preview test in student view
function previewTest() {
    // Open test preview in new tab
    window.open(`/student/test/${testId}/preview`, '_blank');
}

// Update test statistics display
function updateTestStats(test) {
    const maxAttemptsElement = document.querySelector('.stat-item:nth-child(4) .stat-number');
    const statusElement = document.querySelector('.stat-item:nth-child(5) .stat-number');

    if (maxAttemptsElement) {
        maxAttemptsElement.textContent = test.max_attempts || 'Unlimited';
    }
    if (statusElement) {
        statusElement.textContent = test.status.charAt(0).toUpperCase() + test.status.slice(1);
    }
}

// Toggle sidebar on mobile
function toggleSidebar() {
    const sidebar = document.getElementById('testSidebar');
    sidebar.classList.toggle('open');
}
</script>

@endsection
