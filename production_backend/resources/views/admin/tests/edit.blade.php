@extends('layouts.admin')

@section('title', 'Edit Test - ' . $test->title)

@section('content')
    <!-- SortableJS Library -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .question-block:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }

        /* Question Type Icons */
        .question-type-mcq {
            color: #007bff;
        }

        .question-type-mcq_image {
            color: #28a745;
        }

        .question-type-audio {
            color: #fd7e14;
        }

        .question-type-video {
            color: #dc3545;
        }

        .question-type-image_mcq {
            color: #17a2b8;
        }

        .question-type-fill_blanks {
            color: #6f42c1;
        }

        .question-type-image_audio_mcq {
            color: #e83e8c;
        }

        .question-type-passage_mcq {
            color: #20c997;
        }

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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
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
        .btn-group .btn-check:checked+.btn {
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

        .drag-handle:active {
            cursor: grabbing;
        }

        /* Sortable Classes */
        .sortable-drag {
            opacity: 0.5;
            background: #f8f9fa;
        }

        .sortable-fallback {
            opacity: 1 !important;
            background: white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
            border: 1px solid #667eea;
            border-radius: 12px;
            pointer-events: none;
            /* Ensure events pass through to underlying elements */
            z-index: 9999;
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spin {
            animation: spin 1s linear infinite;
        }

        /* Question Numbering */
    </style>

    <div class="test-editor d-flex flex-row align-items-start">
        <!-- Left Sidebar -->
        <div class="test-sidebar flex-shrink-0" id="testSidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title mb-0">
                    <i class="bi bi-clipboard-check"></i>
                    Test Editor
                </h2>
            </div>

            <div class="question-types-section" id="standardSidebar">
                <h3 class="section-title">Question Types</h3>
                <div class="question-type-list">
                    <button type="button" class="question-type-btn" onclick="addQuestion('mcq')">
                        <i class="bi bi-list-ul question-type-mcq"></i>
                        <span>Multiple Choice</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('mcq_image')">
                        <i class="bi bi-image question-type-mcq_image"></i>
                        <span>MCQ with Image</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('audio')">
                        <i class="bi bi-volume-up question-type-audio"></i>
                        <span>Audio + MCQ</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('video')">
                        <i class="bi bi-play-circle question-type-video"></i>
                        <span>Video Question</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('image_mcq')">
                        <i class="bi bi-card-image question-type-image_mcq"></i>
                        <span>Image-based MCQ</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('fill_blanks')">
                        <i class="bi bi-dash-square question-type-fill_blanks"></i>
                        <span>Fill in the Blanks</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('image_audio_mcq')">
                        <i class="bi bi-image question-type-image_audio_mcq"></i>
                        <span>Image + Audio + MCQ</span>
                    </button>
                    <button type="button" class="question-type-btn" onclick="addQuestion('passage_mcq')">
                        <i class="bi bi-file-text question-type-passage_mcq"></i>
                        <span>Passage + Question + MCQ</span>
                    </button>
                </div>
            </div>

            <!-- Expression Ecrite Sidebar -->
            <div class="question-types-section" id="expressionSidebar" style="display: none;">
                <h3 class="section-title">Expression Écrite</h3>
                <div class="question-type-list">
                    <button type="button" class="question-type-btn" onclick="addQuestion('expression_ecrite')">
                        <i class="bi bi-pencil-square text-primary"></i>
                        <span>Add Writing Task</span>
                    </button>
                </div>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#bulkPassageMcqModal">
                    <i class="bi bi-upload me-1"></i> Bulk Upload CSV
                </button>
            </div>

        </div>

        <!-- Main Content Area -->
        <div class="test-main flex-grow-1">
            <!-- Test Header -->

            <div class="test-header">
                <h1 class="test-title">{{ $test->title }}</h1>
                <p class="test-description">
                    {{ $test->description ?: 'Create and manage test questions with multiple question types' }}
                </p>
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
                                <input type="text" class="form-control" id="title" name="title" value="{{ $test->title }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration"
                                    value="{{ $test->time_limit }}" min="1">
                                <small class="form-text text-muted">Leave empty for unlimited time</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="passing_score" class="form-label">Passing Score (%)</label>
                                <input type="number" class="form-control" id="passing_score" name="passing_score"
                                    value="{{ $test->passing_score }}" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="max_attempts" class="form-label">Max Attempts</label>
                                <input type="number" class="form-control" id="max_attempts" name="max_attempts"
                                    value="{{ $test->max_attempts ?? 3 }}" min="1" max="30">
                                <small class="form-text text-muted">Number of times students can retake this test</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="draft" {{ $test->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $test->status === 'published' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="archived" {{ $test->status === 'archived' ? 'selected' : '' }}>Archived
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check form-switch p-3 bg-light rounded border">
                                <input class="form-check-input" type="checkbox" id="enable_expression_ecrite" name="type"
                                    value="expression_ecrite" {{ (($test->type ?? 'standard') === 'expression_ecrite' || $test->questions->contains('type', 'expression_ecrite')) ? 'checked' : '' }}
                                    onchange="toggleExpressionEcriteMode(this.checked)">
                                <label class="form-check-label ms-2" for="enable_expression_ecrite">
                                    <strong>Enable Expression Écrite Mode</strong>
                                    <p class="text-muted mb-0 small">Switch to written expression test builder. This will
                                        hide standard
                                        question types.</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Describe what this test covers...">{{ $test->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="randomize_questions"
                                        name="randomize_questions" {{ $test->randomize_questions ? 'checked' : '' }}>
                                    <label class="form-check-label" for="randomize_questions">
                                        <strong>Randomize question order</strong>
                                        <br><small class="text-muted">Questions will appear in random order for each
                                            student</small>
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
                                        <br><small class="text-muted">Students can see their score and correct
                                            answers</small>
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

            <!-- Expression Ecrite Container -->
            <div class="questions-container" id="expressionEcriteContainer" style="display: none;">
                <div class="empty-state" id="expressionEmptyState">
                    <div class="empty-state-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h5 class="text-muted mb-3">No Writing Tasks Yet</h5>
                    <p class="text-muted mb-4">Add your first writing task using the sidebar.</p>
                    <button type="button" class="btn btn-primary" onclick="addQuestion('expression_ecrite')">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Task
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        // Global variables
        let testId = {{ $test->id }};
        let questionCounter = 0;

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function () {
            initializeSortable();
            // Initialize Expression Ecrite Mode
            const expressionToggle = document.getElementById('enable_expression_ecrite');
            toggleExpressionEcriteMode(expressionToggle.checked);

            // Move existing expression questions to the correct container
            moveExpressionQuestions();

            updateEmptyState();
        });

        function toggleExpressionEcriteMode(enabled) {
            const standardSidebar = document.getElementById('standardSidebar');
            const expressionSidebar = document.getElementById('expressionSidebar');
            const standardContainer = document.getElementById('questionsContainer');
            const expressionContainer = document.getElementById('expressionEcriteContainer');

            if (enabled) {
                standardSidebar.style.display = 'none';
                expressionSidebar.style.display = 'block';
                standardContainer.style.display = 'none';
                expressionContainer.style.display = 'block';
            } else {
                standardSidebar.style.display = 'block';
                expressionSidebar.style.display = 'none';
                standardContainer.style.display = 'block';
                expressionContainer.style.display = 'none';
            }
        }

        function moveExpressionQuestions() {
            const standardContainer = document.getElementById('questionsContainer');
            const expressionContainer = document.getElementById('expressionEcriteContainer');
            const emptyState = document.getElementById('expressionEmptyState');

            // Find all expression questions in standard container
            const expQuestions = standardContainer.querySelectorAll('[data-question-type="expression_ecrite"]');

            if (expQuestions.length > 0) {
                if (emptyState) emptyState.style.display = 'none';
                expQuestions.forEach(q => {
                    expressionContainer.appendChild(q);
                });
            }
        }

        // Initialize drag and drop sorting
        let sortableInstances = {}; // Store instances to destroy them later

        function initializeSortable() {
            const containers = ['questionsContainer', 'expressionEcriteContainer'];

            containers.forEach(containerId => {
                const container = document.getElementById(containerId);

                // Destroy existing instance if any
                if (sortableInstances[containerId]) {
                    sortableInstances[containerId].destroy();
                    delete sortableInstances[containerId];
                }

                if (container) {
                    sortableInstances[containerId] = new Sortable(container, {
                        handle: '.drag-handle',
                        animation: 150,
                        ghostClass: 'sortable-drag',
                        dragClass: 'sortable-drag',
                        forceFallback: true,
                        fallbackClass: 'sortable-fallback',
                        fallbackOnBody: true,
                        scroll: true,
                        scrollSensitivity: 100,
                        scrollSpeed: 20,
                        filter: 'input, textarea, select, .btn, button:not(.drag-handle), .ignore-for-drag',
                        preventOnFilter: false,
                        onStart: function (evt) {
                            // No op needed for start
                        },
                        onEnd: function (evt) {
                            // Helper to get visible items
                            const getItems = () => Array.from(container.querySelectorAll('.question-block:not([style*="display: none"])'));

                            // Re-calculate visible indices if needed, or just let updateQuestionOrder handle it.
                            // updateQuestionOrder gets all blocks with data-question-id.

                            updateQuestionOrder(container);

                            if (evt.oldIndex !== evt.newIndex) {
                                showNotification('Question order updated', 'success');
                            }
                        }
                    });
                }
            });
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
                                                                                                                                                    `,
            'image_audio_mcq': `
                                                                                                                                                        <div class="question-block editing new" data-question-type="image_audio_mcq">
                                                                                                                                                            <div class="question-header">
                                                                                                                                                                <div class="question-type-indicator">
                                                                                                                                                                    <i class="bi bi-image question-type-image_audio_mcq"></i>
                                                                                                                                                                    <span>Image + Audio + MCQ</span>
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
                                                                                                                                                                    <textarea class="form-control question-text-input" rows="2" placeholder="Enter your question..." required></textarea>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="row">
                                                                                                                                                                    <div class="col-md-6">
                                                                                                                                                                        <div class="mb-3">
                                                                                                                                                                            <label class="form-label">Upload Image</label>
                                                                                                                                                                            <div class="upload-area" onclick="triggerFileUpload(this)">
                                                                                                                                                                                <input type="file" class="file-input" accept="image/*" data-file-type="image" style="display: none;" onchange="console.log('Image file selected'); handleFileUpload(this)">
                                                                                                                                                                                <div class="upload-placeholder">
                                                                                                                                                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                                                                                                                                                    <p>Click to upload image</p>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="upload-preview" style="display: none;">
                                                                                                                                                                                    <img class="preview-image" src="" alt="Preview" style="max-width: 100%; max-height: 200px;">
                                                                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeUpload(this)">
                                                                                                                                                                                        <i class="bi bi-trash"></i> Remove
                                                                                                                                                                                    </button>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="col-md-6">
                                                                                                                                                                        <div class="mb-3">
                                                                                                                                                                            <label class="form-label">Upload Audio</label>
                                                                                                                                                                            <div class="upload-area" onclick="triggerFileUpload(this)">
                                                                                                                                                                                <input type="file" class="file-input" accept="audio/*" data-file-type="audio" style="display: none;" onchange="console.log('Audio file selected'); handleFileUpload(this)">
                                                                                                                                                                                <div class="upload-placeholder">
                                                                                                                                                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                                                                                                                                                    <p>Click to upload audio</p>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="upload-preview" style="display: none;">
                                                                                                                                                                                    <audio class="preview-audio" controls style="width: 100%;"></audio>
                                                                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeUpload(this)">
                                                                                                                                                                                        <i class="bi bi-trash"></i> Remove
                                                                                                                                                                                    </button>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="mb-3">
                                                                                                                                                                    <label class="form-label">Options</label>
                                                                                                                                                                    <div class="options-container">
                                                                                                                                                                        <div class="option-item">
                                                                                                                                                                            <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                                                                                                                                                            <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                                                                                                                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeOption(this)">
                                                                                                                                                                                <i class="bi bi-trash"></i>
                                                                                                                                                                            </button>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="option-item">
                                                                                                                                                                            <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                                                                                                                                                            <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                                                                                                                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeOption(this)">
                                                                                                                                                                                <i class="bi bi-trash"></i>
                                                                                                                                                                            </button>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addOption(this)">
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
            'passage_mcq': `
                                                                                                                                                        <div class="question-block editing new" data-question-type="passage_mcq">
                                                                                                                                                            <div class="question-header">
                                                                                                                                                                <div class="question-type-indicator">
                                                                                                                                                                    <i class="bi bi-file-text question-type-passage_mcq"></i>
                                                                                                                                                                    <span>Passage + Question + MCQ</span>
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
                                                                                                                                                                    <label class="form-label">Passage Text</label>
                                                                                                                                                                    <textarea class="form-control passage-text-input" rows="4" placeholder="Enter the passage text..." required></textarea>
                                                                                                                                                                    <small class="form-text text-muted">This is the reading material for the question.</small>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="mb-3">
                                                                                                                                                                    <label class="form-label">Question Text</label>
                                                                                                                                                                    <textarea class="form-control question-text-input" rows="2" placeholder="Enter your question about the passage..." required></textarea>
                                                                                                                                                                </div>
                                                                                                                                                                <div class="mb-3">
                                                                                                                                                                    <label class="form-label">Options</label>
                                                                                                                                                                    <div class="options-container">
                                                                                                                                                                        <div class="option-item">
                                                                                                                                                                            <input type="radio" name="correct_answer" value="0" class="form-check-input">
                                                                                                                                                                            <input type="text" class="form-control option-text" placeholder="Option 1" required>
                                                                                                                                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeOption(this)">
                                                                                                                                                                                <i class="bi bi-trash"></i>
                                                                                                                                                                            </button>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="option-item">
                                                                                                                                                                            <input type="radio" name="correct_answer" value="1" class="form-check-input">
                                                                                                                                                                            <input type="text" class="form-control option-text" placeholder="Option 2" required>
                                                                                                                                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeOption(this)">
                                                                                                                                                                                <i class="bi bi-trash"></i>
                                                                                                                                                                            </button>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addOption(this)">
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
            'expression_ecrite': `
                                                                                                        <div class="question-block editing new" data-question-type="expression_ecrite">
                                                                                                            <div class="question-header">
                                                                                                                <div class="question-type-indicator">
                                                                                                                    <span class="question-number fw-bold me-2"></span>
                                                                                                                    <i class="bi bi-pencil-square text-primary"></i>
                                                                                                                    <span>Expression Écrite Task</span>
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
                                                                                                            <div class="edit-form question-content">
                                                                                                                <div class="mb-3">
                                                                                                                    <label class="form-label">Task Title</label>
                                                                                                                    <input type="text" class="form-control question-text-input" placeholder="e.g. Tâche 1" required>
                                                                                                                </div>

                                                                                                                <!-- Document Builder Area -->
                                                                                                                <div class="mb-3">
                                                                                                                    <label class="form-label">Task Description / Prompt</label>

                                                                                                                    <!-- Tabs for edit modes -->
                                                                                                                    <ul class="nav nav-tabs mb-2" role="tablist">
                                                                                                                        <li class="nav-item" role="presentation">
                                                                                                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#builder-mode" type="button" role="tab">Builder Mode</button>
                                                                                                                        </li>
                                                                                                                        <li class="nav-item" role="presentation">
                                                                                                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#raw-mode" type="button" role="tab">Raw Text</button>
                                                                                                                        </li>
                                                                                                                    </ul>

                                                                                                                    <div class="tab-content">
                                                                                                                        <!-- Builder Mode -->
                                                                                                                        <div class="tab-pane fade show active" id="builder-mode" role="tabpanel">
                                                                                                                            <div class="document-builder p-3 border rounded bg-light">
                                                                                                                                 <div class="mb-3">
                                                                                                                                    <label class="form-label small text-muted">Introduction / Instructions</label>
                                                                                                                                    <textarea class="form-control builder-intro" rows="3" placeholder="Describe the task scenario..."></textarea>
                                                                                                                                 </div>

                                                                                                                                 <div class="documents-list"></div>

                                                                                                                                 <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addBuilderDocument(this)">
                                                                                                                                    <i class="bi bi-plus-circle"></i> Add Document
                                                                                                                                 </button>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <!-- Raw Mode (The actual input) -->
                                                                                                                        <div class="tab-pane fade" id="raw-mode" role="tabpanel">
                                                                                                                             <textarea class="form-control passage-text-input" rows="8" placeholder="Full task text..." required></textarea>
                                                                                                                             <small class="text-muted">Rich text support can be added if needed</small>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="mb-3">
                                                                                                                    <label class="form-label">Correction / Model Answer</label>
                                                                                                                    <textarea class="form-control explanation-input" rows="5" placeholder="Enter the model answer or correction here..."></textarea>
                                                                                                                    <small class="text-muted">This will be visible to students in the results page.</small>
                                                                                                                </div>

                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-6">
                                                                                                                        <div class="mb-3">
                                                                                                                            <label class="form-label">Minimum Words</label>
                                                                                                                            <input type="number" class="form-control min-words-input" value="60" min="0">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <div class="mb-3">
                                                                                                                            <label class="form-label">Maximum Words</label>
                                                                                                                            <input type="number" class="form-control max-words-input" value="120" min="1">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-6">
                                                                                                                        <div class="mb-3">
                                                                                                                            <label class="form-label">Points</label>
                                                                                                                            <input type="number" class="form-control points-input" value="10" min="1">
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

            if (type === 'expression_ecrite') {
                const expContainer = document.getElementById('expressionEcriteContainer');
                const expEmpty = document.getElementById('expressionEmptyState');
                if (expEmpty) expEmpty.style.display = 'none';
                expContainer.insertAdjacentHTML('beforeend', questionHtml);

                const newQuestion = expContainer.lastElementChild;
                newQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return; // Exit early for expression tasks
            }

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

            urlRadio.addEventListener('change', function () {
                if (this.checked) {
                    urlInput.style.display = 'block';
                    uploadInput.style.display = 'none';
                }
            });

            uploadRadio.addEventListener('change', function () {
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
                passage: questionData.passage || null,
                question_media: questionData.question_media || null,
                correct_answer: questionData.correct_answer,
                explanation: questionData.explanation || null,
                points: questionData.points || 1,
                options: questionData.options || null,
                min_words: questionData.min_words || null,
                max_words: questionData.max_words || null
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
                question_text: questionBlock.querySelector('.question-text-input').value.trim(),
                points: parseInt(questionBlock.querySelector('.points-input').value) || 1,
                explanation: questionBlock.querySelector('.explanation-input')?.value.trim() || null,
                min_words: questionBlock.querySelector('.min-words-input')?.value || null,
                max_words: questionBlock.querySelector('.max-words-input')?.value || null
            };

            // Handle media upload
            if (questionType === 'image_audio_mcq') {
                // For image_audio_mcq, we need to handle both image and audio
                const imageInputs = questionBlock.querySelectorAll('input[data-file-type="image"]');
                const audioInputs = questionBlock.querySelectorAll('input[data-file-type="audio"]');

                // Store both as JSON in question_media
                const media = {};

                // Get image URL
                if (imageInputs.length > 0) {
                    const imageUrl = imageInputs[0].getAttribute('data-uploaded-url');
                    if (imageUrl) {
                        media.image = imageUrl;
                    }
                }

                // Get audio URL
                if (audioInputs.length > 0) {
                    const audioUrl = audioInputs[0].getAttribute('data-uploaded-url');
                    if (audioUrl) {
                        media.audio = audioUrl;
                    }
                }

                if (Object.keys(media).length > 0) {
                    data.question_media = JSON.stringify(media);
                }
            } else {
                const fileInput = questionBlock.querySelector('.file-input');
                if (fileInput && fileInput.getAttribute('data-uploaded-url')) {
                    data.question_media = fileInput.getAttribute('data-uploaded-url') || null;
                } else if (questionType === 'video') {
                    const videoUrlInput = questionBlock.querySelector('.video-url-input input');
                    if (videoUrlInput && videoUrlInput.value.trim()) {
                        data.question_media = videoUrlInput.value.trim();
                    }
                }
            }

            // Handle passage for passage_mcq and expression_ecrite
            if (['passage_mcq', 'expression_ecrite'].includes(questionType)) {
                const passageInput = questionBlock.querySelector('.passage-text-input');
                if (passageInput) {
                    data.passage = passageInput.value.trim();
                }
            }

            // Handle options for MCQ questions
            if (['mcq', 'mcq_image', 'audio', 'video', 'image_mcq', 'image_audio_mcq', 'passage_mcq'].includes(questionType)) {
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

            if (['passage_mcq', 'expression_ecrite'].includes(questionType)) {
                if (!data.passage) {
                    showNotification('Please enter the passage text', 'error');
                    return false;
                }
            }

            if (['mcq', 'mcq_image', 'audio', 'video', 'image_mcq', 'image_audio_mcq', 'passage_mcq'].includes(questionType)) {
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
            try {
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
                        questionDisplay.innerHTML = `<input type="text" class="form-control question-text-edit" value="${currentText.replace(/"/g, '&quot;')}">`;
                    }

                    // Handle passage editing
                    const passageDiv = questionBlock.querySelector('.passage-text');
                    if (passageDiv) {
                        const passageText = passageDiv.querySelector('p');
                        const currentPassage = passageText ? passageText.textContent.trim() : '';
                        passageDiv.innerHTML = `<strong>Passage:</strong><textarea class="form-control passage-edit mt-2" rows="4">${currentPassage}</textarea>`;
                    }

                    if (explanationDiv) {
                        const explanationText = explanationDiv.querySelector('small');
                        let currentExplanation = '';
                        if (explanationText) {
                            // Careful with the replacement if the structure changed
                            currentExplanation = explanationText.textContent.replace(/^Explanation:\s*/i, '').trim();
                        }
                        explanationDiv.innerHTML = `<small class="text-muted"><strong>Explanation:</strong> <textarea class="form-control explanation-edit mt-1" rows="2">${currentExplanation}</textarea></small>`;
                    } else {
                        // Add explanation field if it doesn't exist
                        const questionContent = questionBlock.querySelector('.question-display');
                        if (questionContent) {
                            const explanationHtml = `<div class="explanation mt-3"><small class="text-muted"><strong>Explanation:</strong> <textarea class="form-control explanation-edit mt-1" rows="2" placeholder="Add explanation (optional)"></textarea></small></div>`;
                            questionContent.insertAdjacentHTML('beforeend', explanationHtml);
                        }
                    }

                    if (pointsDiv) {
                        const currentPoints = pointsDiv.textContent.replace('Points: ', '').trim();
                        pointsDiv.innerHTML = `<small class="text-muted">Points: <input type="number" class="form-control points-edit d-inline-block" value="${parseInt(currentPoints) || 1}" min="1" max="10" style="width: 80px;"></small>`;
                    }

                    // Make options editable for MCQ questions
                    const questionOptions = questionBlock.querySelector('.question-options');
                    if (questionOptions) {
                        makeOptionsEditable(questionOptions);
                    }

                    showNotification('Edit mode enabled. Click the check button to save changes.', 'info');
                }
            } catch (e) {
                console.error('Error in editQuestion:', e);
                showNotification('Error starting edit mode: ' + e.message, 'error');
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
            const passageInput = questionBlock.querySelector('.passage-edit');
            const explanationInput = questionBlock.querySelector('.explanation-edit');
            const pointsInput = questionBlock.querySelector('.points-edit');

            if (!questionTextInput) {
                showNotification('Error: Question text input not found', 'error');
                return;
            }

            const updatedData = {
                question_text: questionTextInput.value.trim(),
                passage: passageInput ? passageInput.value.trim() : null,
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

                        const passageDiv = questionBlock.querySelector('.passage-text');
                        if (passageDiv && updatedData.passage !== null) {
                            passageDiv.innerHTML = `<strong>Passage:</strong><p class="mt-2 mb-0">${updatedData.passage}</p>`;
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
        function updateQuestionOrder(specificContainer = null) {
            // If a specific container is passed (from sortable), use it. 
            // Otherwise try to find the visible one.
            let targetContainer = specificContainer;

            if (!targetContainer) {
                const isExpressionMode = document.getElementById('enable_expression_ecrite').checked;
                targetContainer = isExpressionMode ?
                    document.getElementById('expressionEcriteContainer') :
                    document.getElementById('questionsContainer');
            }

            if (!targetContainer) return;

            const questions = Array.from(targetContainer.querySelectorAll('.question-block[data-question-id]')).map((question, index) => ({
                id: parseInt(question.dataset.questionId),
                order: index + 1
            }));

            // Update visible numbers
            updateQuestionNumbers();

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

        // Update question numbers based on visibility
        function updateQuestionNumbers() {
            const standardContainer = document.getElementById('questionsContainer');
            const expressionContainer = document.getElementById('expressionEcriteContainer');

            // Check which container is visible (or if exp mode is enabled)
            const isExpressionMode = document.getElementById('enable_expression_ecrite').checked;

            const targetContainer = isExpressionMode ? expressionContainer : standardContainer;

            if (targetContainer) {
                const questions = targetContainer.querySelectorAll('.question-block');
                questions.forEach((q, index) => {
                    const numSpan = q.querySelector('.question-number');
                    if (numSpan) {
                        numSpan.textContent = `Q${index + 1}.`;
                    }
                });
            }
        }

        // Add to existing functions
        const originalToggleExpressionEcriteMode = toggleExpressionEcriteMode;
        toggleExpressionEcriteMode = function (enabled) {
            originalToggleExpressionEcriteMode(enabled);
            setTimeout(updateQuestionNumbers, 50); // Small delay to ensure DOM update
        };

        const originalAddQuestion = addQuestion;
        addQuestion = function (type) {
            originalAddQuestion(type);
            updateQuestionNumbers();
        };

        // Initialize event listeners for existing document builders
        function initializeDocumentBuilders() {
            document.querySelectorAll('.document-builder').forEach(builder => {
                // Attach listener to intro field
                const introField = builder.querySelector('.builder-intro');
                if (introField) {
                    introField.addEventListener('input', () => syncBuilderToPassage(builder));
                }

                // Attach listeners to all existing documents
                builder.querySelectorAll('.builder-document').forEach(doc => {
                    doc.querySelectorAll('input, textarea').forEach(input => {
                        input.addEventListener('input', () => syncBuilderToPassage(builder));
                    });
                });
            });
        }

        // Initial call
        document.addEventListener('DOMContentLoaded', function () {
            updateQuestionNumbers();
            initializeDocumentBuilders();
        });


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
            console.log('Trigger file upload:', {
                uploadArea: uploadArea,
                fileInput: fileInput,
                fileInputFound: !!fileInput
            });
            if (fileInput) {
                fileInput.click();
            } else {
                console.error('File input not found in upload area');
            }
        }

        function handleFileUpload(fileInput) {
            console.log('handleFileUpload called with:', fileInput);
            const file = fileInput.files[0];
            if (!file) {
                console.error('No file selected');
                return;
            }

            console.log('Uploading file:', file.name, 'Type:', file.type, 'Size:', file.size, 'Size in MB:', (file.size / 1024 / 1024).toFixed(2));

            const uploadArea = fileInput.closest('.upload-area');
            const placeholder = uploadArea.querySelector('.upload-placeholder');
            const preview = uploadArea.querySelector('.upload-preview');

            // Determine file type - check data-file-type attribute first
            let fileType = fileInput.getAttribute('data-file-type') || 'file';
            if (fileType === 'file') {
                // Fallback to detecting from file type
                if (file.type.startsWith('image/')) {
                    fileType = 'image';
                } else if (file.type.startsWith('video/')) {
                    fileType = 'video';
                } else if (file.type.startsWith('audio/')) {
                    fileType = 'audio';
                }
            }

            const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
            const CHUNK_SIZE = 1024 * 1024; // 1MB chunks
            const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
            const fileId = 'file_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

            console.log('Starting chunked upload:', {
                fileName: file.name,
                fileType: fileType,
                fileSizeMB: fileSizeMB,
                totalChunks: totalChunks,
                fileId: fileId
            });

            // Show loading state with unique IDs
            const progressId = 'progress-' + fileId;
            const statusId = 'status-' + fileId;
            placeholder.innerHTML = `<i class="bi bi-arrow-clockwise spin"></i><p>Uploading ${fileSizeMB}MB file...</p><div class="progress mt-2"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="${progressId}" style="width: 0%"></div></div><p class="small text-muted" id="${statusId}">0/${totalChunks} chunks</p>`;

            // Upload chunks sequentially
            let uploadedChunks = 0;

            async function uploadNextChunk(chunkIndex) {
                if (chunkIndex >= totalChunks) {
                    // All chunks uploaded
                    console.log('All chunks uploaded successfully');
                    fileInput.setAttribute('data-uploaded-url', window.lastUploadUrl);
                    placeholder.style.display = 'none';
                    preview.style.display = 'block';

                    if (file.type.startsWith('image/')) {
                        const img = preview.querySelector('.preview-image');
                        if (img) img.src = window.lastUploadUrl;
                    } else if (file.type.startsWith('video/')) {
                        const video = preview.querySelector('.preview-video');
                        if (video) video.src = window.lastUploadUrl;
                    } else if (file.type.startsWith('audio/')) {
                        const audio = preview.querySelector('.preview-audio');
                        if (audio) audio.src = window.lastUploadUrl;
                    }

                    showNotification('File uploaded successfully', 'success');
                    return;
                }

                try {
                    const start = chunkIndex * CHUNK_SIZE;
                    const end = Math.min(start + CHUNK_SIZE, file.size);
                    const chunk = file.slice(start, end);

                    const formData = new FormData();
                    formData.append('file', chunk);
                    formData.append('chunkIndex', chunkIndex);
                    formData.append('totalChunks', totalChunks);
                    formData.append('fileId', fileId);
                    formData.append('fileName', file.name);
                    formData.append('type', fileType);

                    const response = await fetch('/admin/files/upload-chunk', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    console.log('Chunk upload response:', response.status, response.statusText);

                    if (!response.ok) {
                        // Try to get error details
                        const errorText = await response.text();
                        console.error('Upload error response:', errorText);
                        throw new Error(`HTTP error! status: ${response.status} - ${errorText.substring(0, 100)}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        uploadedChunks++;
                        const progressPercent = (uploadedChunks / totalChunks) * 100;
                        const progressBar = document.getElementById(progressId);
                        const statusText = document.getElementById(statusId);
                        if (progressBar) progressBar.style.width = progressPercent + '%';
                        if (statusText) statusText.textContent = uploadedChunks + '/' + totalChunks + ' chunks';

                        console.log('Chunk ' + (chunkIndex + 1) + ' uploaded successfully');

                        // Store URL if this is the final chunk
                        if (data.url) {
                            window.lastUploadUrl = data.url;
                        }

                        // Upload next chunk
                        await uploadNextChunk(chunkIndex + 1);
                    } else {
                        throw new Error(data.message || 'Chunk upload failed');
                    }
                } catch (error) {
                    console.error('Chunk upload error:', error);
                    showNotification('Upload failed at chunk ' + (chunkIndex + 1) + ': ' + error.message, 'error');
                    placeholder.innerHTML = `<i class="bi bi-exclamation-triangle text-danger"></i><p class="text-danger">Upload failed: ${error.message}</p>`;
                }
            }

            // Start uploading chunks
            uploadNextChunk(0);
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
            console.log('Starting saveTestSettings...');
            try {
                const form = document.getElementById('testSettingsForm');
                if (!form) throw new Error('Form testSettingsForm not found');

                const formData = new FormData(form);
                // Convert checkboxes to proper values
                const randomizeEl = document.getElementById('randomize_questions');
                const showResultsEl = document.getElementById('show_results');

                formData.set('randomize_questions', randomizeEl && randomizeEl.checked ? '1' : '0');
                formData.set('show_results', showResultsEl && showResultsEl.checked ? '1' : '0');

                // Add method spoofing for Laravel
                formData.append('_method', 'PUT');

                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfMeta) throw new Error('CSRF meta tag not found');
                const csrfToken = csrfMeta.getAttribute('content').trim();

                // Ensure testId is valid
                if (!testId) throw new Error('testId is missing');

                const url = '/admin/tests/' + String(testId);

                console.log('Preparing request...', { url, testId });

                // Use XMLHttpRequest with FormData
                const xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                // Don't set Content-Type - let browser set it with boundary for FormData

                xhr.onload = function () {
                    console.log('XHR response received:', xhr.status);
                    console.log('Response text (first 500 chars):', xhr.responseText.substring(0, 500));

                    if (xhr.status >= 200 && xhr.status < 300) {
                        try {
                            const responseData = JSON.parse(xhr.responseText);
                            console.log('Response data:', responseData);

                            if (responseData.success) {
                                showNotification('Test settings saved successfully', 'success');

                                try {
                                    // Update the header title if changed
                                    const titleEl = document.querySelector('.test-title');
                                    if (titleEl && responseData.test && responseData.test.title) {
                                        titleEl.textContent = responseData.test.title;
                                    }
                                    // Update stats
                                    if (responseData.test) {
                                        updateTestStats(responseData.test);
                                    }
                                } catch (uiError) {
                                    console.error('UI update error:', uiError);
                                }
                            } else {
                                showNotification('Error saving settings: ' + (responseData.message || 'Unknown error'), 'error');
                            }
                        } catch (parseError) {
                            console.error('JSON parse error:', parseError);
                            console.error('Full response text:', xhr.responseText);
                            showNotification('Server returned invalid response. Check console for details.', 'error');
                        }
                    } else {
                        console.error('Server error:', xhr.status, xhr.responseText);
                        showNotification('Server error: ' + xhr.status, 'error');
                    }
                };

                xhr.onerror = function () {
                    console.error('XHR error occurred');
                    showNotification('Network error occurred', 'error');
                };

                xhr.send(formData);

            } catch (e) {
                console.error('Synchronous error in saveTestSettings:', e);
                showNotification('Error preparing save: ' + e.message, 'error');
            }
        }

        // Preview test in student view
        function previewTest() {
            // Open test preview in new tab
            window.open(`/student/test/${testId}/preview`, '_blank');
        }

        // Update test statistics display
        function updateTestStats(test) {
            try {
                const maxAttemptsElement = document.querySelector('.stat-item:nth-child(4) .stat-number');
                const statusElement = document.querySelector('.stat-item:nth-child(5) .stat-number');

                if (maxAttemptsElement) {
                    maxAttemptsElement.textContent = test.max_attempts || 'Unlimited';
                }
                if (statusElement && test.status) {
                    statusElement.textContent = test.status.charAt(0).toUpperCase() + test.status.slice(1);
                }
            } catch (e) {
                console.error('Error in updateTestStats:', e);
            }
        }

        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('testSidebar');
            sidebar.classList.toggle('open');
        }

        // --- Expression Ecrite Builder Logic ---

        function addBuilderDocument(btn, title = '', content = '') {
            const builder = btn.closest('.document-builder');
            const list = builder.querySelector('.documents-list');
            const docCount = list.children.length + 1;
            const docTitle = title || `Document ${docCount}`;

            const docHtml = `
                                                                    <div class="builder-document mb-3 border-bottom pb-3">
                                                                        <div class="d-flex justify-content-between mb-2">
                                                                            <input type="text" class="form-control form-control-sm me-2 fw-bold builder-doc-title" value="${docTitle}" placeholder="Document Title">
                                                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeBuilderDocument(this)" title="Remove Document">
                                                                                <i class="bi bi-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                        <textarea class="form-control builder-doc-content" rows="3" placeholder="Document content...">${content}</textarea>
                                                                    </div>
                                                                `;
            list.insertAdjacentHTML('beforeend', docHtml);

            // Attach listener to new inputs
            const newDoc = list.lastElementChild;
            newDoc.querySelectorAll('input, textarea').forEach(input => {
                input.addEventListener('input', () => syncBuilderToPassage(builder));
            });

            syncBuilderToPassage(builder);
        }

        function removeBuilderDocument(btn) {
            const builder = btn.closest('.document-builder');
            btn.closest('.builder-document').remove();
            syncBuilderToPassage(builder);
        }

        function syncBuilderToPassage(builder) {
            const form = builder.closest('.edit-form');
            const passageInput = form.querySelector('.passage-text-input');
            const intro = builder.querySelector('.builder-intro').value.trim();

            let fullText = intro;

            builder.querySelectorAll('.builder-document').forEach(doc => {
                const title = doc.querySelector('.builder-doc-title').value.trim();
                const content = doc.querySelector('.builder-doc-content').value.trim();
                if (fullText) fullText += "\n\n";
                fullText += `${title} :\n${content}`;
            });

            passageInput.value = fullText;
        }

        function syncPassageToBuilder(form) {
            const passageInput = form.querySelector('.passage-text-input');
            const builder = form.querySelector('.document-builder');
            const introInput = builder.querySelector('.builder-intro');
            const list = builder.querySelector('.documents-list');

            const text = passageInput.value;
            list.innerHTML = ''; // Clear list

            // Simple parsing strategy: Split by "Document X :" pattern
            // Regex to find "Document X :" or similar headers at start of lines
            const parts = text.split(/(?:^|\n)(Document \d+)\s*:\s*\n/);

            if (parts.length > 1) {
                introInput.value = parts[0].trim();
                for (let i = 1; i < parts.length; i += 2) {
                    const title = parts[i];
                    const content = parts[i + 1] ? parts[i + 1].trim() : '';
                    addBuilderDocument(builder.querySelector('button'), title, content);
                }
            } else {
                introInput.value = text;
            }
        }

    </script>


    @include('admin.tests.modals.bulk-passage-mcq-upload')

@endsection