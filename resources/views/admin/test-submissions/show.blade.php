@extends('layouts.admin')

@section('title', 'Test Submission Details - Admin Panel')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.test-submissions.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-2"></i>Back to Submissions
        </a>
        <a href="{{ route('admin.test-submissions.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-2"></i>Back to Submissions
        </a>
    </div>

    <!-- Grading Action Card -->
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Test Evaluation</h5>
            <span class="badge bg-light text-primary">{{ ucfirst($submission->status ?? 'completed') }}</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.test-submissions.update', $submission->id) }}" method="POST" id="grading-form">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="score" class="form-label">Score (%)</label>
                            <input type="number" class="form-control" id="score" name="score"
                                value="{{ old('score', $submission->score) }}" min="0" max="100" step="0.01" required>
                            <div class="form-text">Passing score is {{ $submission->test->passing_score }}%</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" {{ ($submission->status ?? 'completed') === 'pending' ? 'selected' : '' }}>Pending Evaluation</option>
                                <option value="completed" {{ ($submission->status ?? 'completed') === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mb-3 w-100">
                            <i class="bi bi-save me-2"></i>Save Evaluation
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Teacher Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="4"
                        placeholder="Enter feedback for the student...">{{ old('remarks', $submission->remarks) }}</textarea>
                </div>
            </form>
        </div>
    </div>

    <!-- Header -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-3">{{ $submission->test->title }}</h3>
                    <div class="mb-3">
                        <label class="text-muted">Student</label>
                        <div class="d-flex align-items-center mt-2">
                            <img src="{{ $submission->student->avatar_url }}" alt="{{ $submission->student->name }}"
                                class="rounded-circle me-3" width="48" height="48">
                            <div>
                                <div class="fw-600">{{ $submission->student->name }}</div>
                                <small class="text-muted">{{ $submission->student->email }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Course</label>
                        <div class="mt-2">{{ $submission->test->course->title }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        <div class="mb-3">
                            <label class="text-muted">Score</label>
                            <div class="mt-2">
                                <h2 class="mb-0">{{ number_format($submission->score, 2) }}%</h2>
                                <small class="text-muted">Passing Score: {{ $submission->test->passing_score }}%</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted">Status</label>
                            <div class="mt-2">
                                @if($submission->passed)
                                    <span class="badge bg-success fs-6">PASSED</span>
                                @else
                                    <span class="badge bg-danger fs-6">FAILED</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submission Details -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-calendar3 fs-3 text-primary mb-2"></i>
                    <div class="text-muted small">Submitted</div>
                    <div class="fw-600">{{ $submission->submitted_at->format('M d, Y') }}</div>
                    <small class="text-muted">{{ $submission->submitted_at->format('H:i A') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-clock fs-3 text-info mb-2"></i>
                    <div class="text-muted small">Time Taken</div>
                    <div class="fw-600">{{ $submission->time_taken ? gmdate('H:i:s', $submission->time_taken) : 'N/A' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-question-circle fs-3 text-warning mb-2"></i>
                    <div class="text-muted small">Total Questions</div>
                    <div class="fw-600">{{ count($submission->answers ?? []) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-repeat fs-3 text-secondary mb-2"></i>
                    <div class="text-muted small">Attempt</div>
                    <div class="fw-600">#{{ $submission->attempt_number }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Answers Review -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Answer Review</h5>
        </div>
        <div class="card-body">
            @php
                $questions = $submission->test->questions->sortBy('order')->values();
            @endphp

            @if($submission->answers && count($submission->answers) > 0)
                @foreach($questions as $index => $question)
                    @php
                        // Answers are stored by index (stringified)
                        $answerIndex = (string) $index;
                        $answer = $submission->answers[$answerIndex] ?? null;

                        // Normalize answer to ensure it's an array structure
                        if ($answer && !is_array($answer)) {
                             $answer = ['answer' => $answer];
                        }
                        
                        // Fallback if no answer
                        if (!$answer) {
                            $answer = ['answer' => null];
                        }

                        $isCorrect = isset($answer['is_correct']) ? $answer['is_correct'] : false;
                        $userAnswerText = is_array($answer['answer'] ?? null) ? implode(', ', $answer['answer']) : ($answer['answer'] ?? null);
                        $correction = $answer['correction'] ?? null;
                    @endphp

                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0">Question {{ $loop->iteration }}: {{ $question->question_text }}</h6>
                            @if($question->type !== 'expression_ecrite')
                                @if($isCorrect)
                                    <span class="badge bg-success">Correct</span>
                                @else
                                    <span class="badge bg-danger">Incorrect</span>
                                @endif
                            @else
                                <span class="badge bg-warning text-dark">Manual Grading</span>
                            @endif
                        </div>

                        @if($question->question_media)
                            <div class="mb-3">
                                @if(\Illuminate\Support\Str::contains($question->question_media, ['.jpg', '.jpeg', '.png', '.gif']))
                                    <img src="{{ route('serve-storage', ['path' => $question->question_media]) }}" alt="Question media"
                                        class="img-fluid" style="max-width: 300px;">
                                @elseif(\Illuminate\Support\Str::contains($question->question_media, ['.mp3', '.wav', '.ogg']))
                                    <audio controls class="w-100">
                                        <source src="{{ route('serve-storage', ['path' => $question->question_media]) }}" type="audio/mpeg">
                                    </audio>
                                @endif
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="text-muted small">Student's Answer:</label>
                            <div class="alert alert-info mb-0" style="white-space: pre-wrap;">
                                {{ $userAnswerText ?? 'No answer provided' }}</div>
                        </div>

                        @if($question->type === 'expression_ecrite')
                            <div class="mb-3">
                                <label class="form-label text-primary fw-600">
                                    <i class="bi bi-pencil-square me-1"></i>Teacher Correction (Edit to provide diff)
                                </label>
                                <!-- Use index as key for corrections to match answers array structure -->
                                <textarea class="form-control font-monospace" name="corrections[{{ $index }}]" rows="6"
                                    form="grading-form">{{ $correction ?? $userAnswerText }}</textarea>
                                <div class="form-text">Edit the student's answer above. The student will see a diff (red for deletions,
                                    green for additions).</div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="text-muted small">Correct Answer:</label>
                            <div class="alert alert-success mb-0">
                                @if(is_array($question->correct_answer))
                                    {{ implode(', ', $question->correct_answer) }}
                                @else
                                    {{ $question->correct_answer ?? 'N/A' }}
                                @endif
                            </div>
                        </div>

                        @if($question->explanation)
                            <div>
                                <label class="text-muted small">Explanation:</label>
                                <p class="mb-0">{{ $question->explanation }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-muted">No answers recorded for this submission.</p>
            @endif
        </div>
    </div>

    <style>
        .fw-600 {
            font-weight: 600;
        }
        
        /* Saving Indicator */
        #saving-indicator {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateY(100px);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000;
            border: 1px solid #e5e7eb;
        }
        
        #saving-indicator.visible {
            transform: translateY(0);
        }
        
        .saving-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid #e5e7eb;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!-- Saving Indicator Element -->
    <div id="saving-indicator">
        <div class="saving-spinner"></div>
        <span class="text-sm fw-600 text-gray-700" id="saving-text">Saving...</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('grading-form');
            const indicator = document.getElementById('saving-indicator');
            const savingText = document.getElementById('saving-text');
            const spinner = indicator.querySelector('.saving-spinner');
            
            let autosaveTimeout;
            
            // Function to show saving state
            function showSaving() {
                indicator.classList.add('visible');
                savingText.textContent = 'Saving...';
                spinner.style.borderTopColor = '#3b82f6'; // Blue
                spinner.style.animation = 'spin 1s linear infinite';
            }
            
            // Function to show saved state
            function showSaved() {
                savingText.textContent = 'Saved';
                spinner.style.borderTopColor = '#10b981'; // Green
                spinner.style.borderColor = '#10b981';
                spinner.style.animation = 'none';
                
                // Hide after 2 seconds
                setTimeout(() => {
                    indicator.classList.remove('visible');
                    // Reset spinner style after hidden
                    setTimeout(() => {
                        spinner.style.border = '2px solid #e5e7eb';
                        spinner.style.borderTop = '2px solid #3b82f6';
                    }, 300);
                }, 2000);
            }
            
            // Function to show error state
            function showError() {
                savingText.textContent = 'Error Saving';
                spinner.style.borderTopColor = '#ef4444'; // Red
                spinner.style.borderColor = '#ef4444';
                spinner.style.animation = 'none';
            }

            // Autosave function
            function autosave() {
                showSaving();
                
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data.success) {
                        showSaved();
                    } else {
                        showError();
                    }
                })
                .catch(error => {
                    console.error('Autosave error:', error);
                    showError();
                });
            }

            // Listen for changes
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(autosaveTimeout);
                    autosaveTimeout = setTimeout(autosave, 1000); // Save after 1 second of inactivity
                });
                
                // Also trigger on change for selects immediately
                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', function() {
                        clearTimeout(autosaveTimeout);
                        autosave();
                    });
                }
            });
        });
    </script>
@endsection