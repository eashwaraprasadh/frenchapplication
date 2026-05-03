@extends('layouts.app')

@section('title', $test->title . ' - TS Language Platform')

@section('content')
<style>
/* Test Taking Interface Styles */
.test-header {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 2rem 0;
    border-radius: 0 0 16px 16px;
    margin-bottom: 2rem;
}

.test-container {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 2rem;
    min-height: calc(100vh - 200px);
}

.test-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    height: fit-content;
}

.question-card {
    background: #fefefe;
    border: 1px solid #f1f5f9;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.question-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.question-number {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.question-type {
    background: #fef3c7;
    color: #92400e;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.question-text {
    font-size: 1.2rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.question-media {
    margin-bottom: 1.5rem;
    text-align: center;
}

.question-media img {
    max-width: 100%;
    max-height: 300px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.question-media video {
    max-width: 100%;
    border-radius: 8px;
}

.audio-container {
    text-align: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
    border-radius: 12px;
    border: 2px solid #fdba74;
}

.audio-container audio {
    margin-top: 1rem;
    border-radius: 8px;
}

.options-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.option-item {
    margin-bottom: 1rem;
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
    display: flex;
    align-items: center;
}

.option-item:hover {
    border-color: #f59e0b;
    background: #fffbeb;
}

.option-item.selected {
    border-color: #f59e0b;
    background: #f59e0b;
    color: white;
}

.option-radio {
    margin-right: 1rem;
    width: 20px;
    height: 20px;
}

.option-text {
    flex: 1;
    font-weight: 500;
}

.fill-blanks-input {
    display: inline-block;
    min-width: 100px;
    padding: 0.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 4px;
    margin: 0 0.25rem;
    text-align: center;
    font-weight: 500;
}

.fill-blanks-input:focus {
    outline: none;
    border-color: #f59e0b;
    background: #fffbeb;
}

.test-sidebar {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 1.5rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.timer-display {
    text-align: center;
    background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.timer-icon {
    font-size: 2rem;
    color: #d97706;
    margin-bottom: 0.5rem;
}

.timer-text {
    font-size: 1.5rem;
    font-weight: 600;
    color: #92400e;
}

.timer-label {
    font-size: 0.9rem;
    color: #a16207;
    margin-top: 0.25rem;
}

.question-navigator {
    margin-bottom: 2rem;
}

.nav-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.5rem;
}

.nav-question {
    width: 40px;
    height: 40px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
    background: white;
}

.nav-question:hover {
    border-color: #f59e0b;
    background: #fffbeb;
}

.nav-question.current {
    border-color: #f59e0b;
    background: #f59e0b;
    color: white;
}

.nav-question.answered {
    border-color: #10b981;
    background: #10b981;
    color: white;
}

.test-info {
    background: #f8faff;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.info-item {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.test-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-test {
    flex: 1;
    padding: 0.75rem;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-previous {
    background: #f3f4f6;
    color: #6b7280;
}

.btn-previous:hover:not(:disabled) {
    background: #e5e7eb;
    color: #374151;
}

.btn-next {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.btn-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}

.btn-submit {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    width: 100%;
    padding: 1rem;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 1.1rem;
    margin-top: 1rem;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.warning-low-time {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@media (max-width: 768px) {
    .test-container {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .test-sidebar {
        position: static;
        order: -1;
    }
    
    .nav-grid {
        grid-template-columns: repeat(8, 1fr);
    }
    
    .test-actions {
        position: fixed;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
        background: white;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        z-index: 1000;
    }
}
</style>

<div class="test-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.courses') }}" class="text-white-50">My Courses</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.course.show', $test->course) }}" class="text-white-50">{{ $test->course->title }}</a></li>
                        <li class="breadcrumb-item active text-white">{{ $test->title }}</li>
                    </ol>
                </nav>
                <h1 class="mb-1">{{ $test->title }}</h1>
                <p class="mb-0 opacity-90">{{ $test->description ?? 'Test your knowledge and skills' }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex justify-content-md-end gap-3">
                    <div class="text-center">
                        <div class="fs-4 fw-bold">{{ $currentQuestion + 1 }}</div>
                        <small class="opacity-75">of {{ $totalQuestions }}</small>
                    </div>
                    <div class="text-center">
                        <div class="fs-4 fw-bold">{{ $test->passing_score }}%</div>
                        <small class="opacity-75">to Pass</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="test-container">
        <!-- Main Test Content -->
        <div class="test-content">
            @if($test->questions && $test->questions->count() > 0)
                @foreach($test->questions->sortBy('order') as $index => $question)
                    <div class="question-card" id="question-{{ $index }}" style="{{ $index === 0 ? '' : 'display: none;' }}">
                        <div class="question-header">
                            <div class="question-number">{{ $index + 1 }}</div>
                            <div class="question-type">{{ strtoupper(str_replace('_', ' ', $question->type)) }}</div>
                        </div>
                        
                        <div class="question-text">{{ $question->question_text }}</div>
                        
                        <!-- Question Media -->
                        @if(in_array($question->type, ['mcq_image', 'image_mcq', 'audio', 'video']) && $question->question_media)
                            <div class="question-media">
                                @if($question->type === 'audio')
                                    <div class="audio-container">
                                        <i class="bi bi-volume-up fs-3 text-warning mb-2"></i>
                                        <audio controls class="w-100">
                                            <source src="{{ $question->question_media }}" type="audio/mpeg">
                                            <source src="{{ $question->question_media }}" type="audio/wav">
                                            <source src="{{ $question->question_media }}" type="audio/ogg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                @elseif($question->type === 'video')
                                    @if(str_contains($question->question_media, 'youtube.com') || str_contains($question->question_media, 'youtu.be'))
                                        <iframe width="560" height="315" src="{{ $question->question_media }}" frameborder="0" allowfullscreen></iframe>
                                    @else
                                        <video controls>
                                            <source src="{{ $question->question_media }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                @else
                                    <img src="{{ $question->question_media }}" alt="Question Image">
                                @endif
                            </div>
                        @endif
                        
                        <!-- Question Options -->
                        @if(in_array($question->type, ['mcq', 'mcq_image', 'audio', 'video', 'image_mcq']))
                            @if($question->options && $question->options->count() > 0)
                                <ul class="options-list">
                                    @foreach($question->options as $optionIndex => $option)
                                        <li class="option-item" onclick="selectOption({{ $index }}, {{ $optionIndex }})">
                                            <input type="radio" class="option-radio" name="question_{{ $question->id }}" value="{{ $optionIndex }}">
                                            <span class="option-text">{{ $option->option_text }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <strong>No options available for this question.</strong>
                                    <br><small>This question may need to be recreated by an administrator.</small>
                                </div>
                            @endif
                        @endif
                        
                        <!-- Fill in the Blanks -->
                        @if($question->type === 'fill_blanks')
                            <div class="fill-blanks-container">
                                @php
                                    $questionText = $question->question_text;
                                    $blanks = $question->correct_answer ?? [];
                                    $parts = explode('_____', $questionText);
                                @endphp
                                
                                <div class="fill-blanks-text">
                                    @foreach($parts as $partIndex => $part)
                                        {{ $part }}
                                        @if($partIndex < count($parts) - 1)
                                            <input type="text" class="fill-blanks-input" 
                                                   data-question="{{ $index }}" 
                                                   data-blank="{{ $partIndex }}"
                                                   placeholder="...">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                    <h4 class="mt-3">No Questions Available</h4>
                    <p class="text-muted">This test doesn't have any questions yet.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="test-sidebar">
            <!-- Timer -->
            @if($test->time_limit)
                <div class="timer-display" id="timerDisplay">
                    <i class="bi bi-clock timer-icon"></i>
                    <div class="timer-text" id="timerText">{{ $test->time_limit }}:00</div>
                    <div class="timer-label">Time Remaining</div>
                </div>
            @endif

            <!-- Question Navigator -->
            <div class="question-navigator">
                <h6 class="mb-3">Questions</h6>
                <div class="nav-grid">
                    @for($i = 0; $i < $totalQuestions; $i++)
                        <div class="nav-question {{ $i === 0 ? 'current' : '' }}" 
                             onclick="goToQuestion({{ $i }})">
                            {{ $i + 1 }}
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Test Info -->
            <div class="test-info">
                <div class="info-item">
                    <span>Questions:</span>
                    <span>{{ $totalQuestions }}</span>
                </div>
                <div class="info-item">
                    <span>Duration:</span>
                    <span>{{ $test->time_limit ?? 'Unlimited' }} min</span>
                </div>
                <div class="info-item">
                    <span>Passing Score:</span>
                    <span>{{ $test->passing_score }}%</span>
                </div>
                <div class="info-item">
                    <span>Attempts:</span>
                    <span>{{ $currentAttempt }} of {{ $test->max_attempts ?? 'Unlimited' }}</span>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="test-actions">
                <button class="btn btn-test btn-previous" onclick="previousQuestion()" disabled>
                    <i class="bi bi-arrow-left me-1"></i>
                    Previous
                </button>
                <button class="btn btn-test btn-next" onclick="nextQuestion()">
                    Next
                    <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>

            <!-- Submit Button -->
            <button class="btn btn-submit" onclick="submitTest()">
                <i class="bi bi-check-circle me-2"></i>
                Submit Test
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentQuestion = 0;
const totalQuestions = {{ $totalQuestions }};
let answers = {};
let timeRemaining = {{ $test->time_limit ? $test->time_limit * 60 : 0 }}; // in seconds

// Timer functionality
@if($test->time_limit)
function startTimer() {
    const timer = setInterval(() => {
        timeRemaining--;
        updateTimerDisplay();
        
        if (timeRemaining <= 0) {
            clearInterval(timer);
            alert('Time is up! Submitting test automatically.');
            submitTest();
        } else if (timeRemaining <= 300) { // 5 minutes warning
            document.getElementById('timerDisplay').classList.add('warning-low-time');
        }
    }, 1000);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeRemaining / 60);
    const seconds = timeRemaining % 60;
    const display = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    document.getElementById('timerText').textContent = display;
}

// Start timer when page loads
document.addEventListener('DOMContentLoaded', startTimer);
@endif

// Question navigation
function goToQuestion(questionIndex) {
    // Hide current question
    document.querySelector(`#question-${currentQuestion}`).style.display = 'none';
    
    // Update navigation
    document.querySelectorAll('.nav-question').forEach(nav => nav.classList.remove('current'));
    document.querySelectorAll('.nav-question')[questionIndex].classList.add('current');
    
    // Show new question
    document.querySelector(`#question-${questionIndex}`).style.display = 'block';
    
    currentQuestion = questionIndex;
    updateNavigationButtons();
}

function nextQuestion() {
    if (currentQuestion < totalQuestions - 1) {
        goToQuestion(currentQuestion + 1);
    }
}

function previousQuestion() {
    if (currentQuestion > 0) {
        goToQuestion(currentQuestion - 1);
    }
}

function updateNavigationButtons() {
    document.querySelector('.btn-previous').disabled = currentQuestion === 0;
    document.querySelector('.btn-next').disabled = currentQuestion === totalQuestions - 1;
}

// Answer selection
function selectOption(questionIndex, optionIndex) {
    console.log('selectOption called:', questionIndex, optionIndex);

    const questionCard = document.querySelector(`#question-${questionIndex}`);
    const options = questionCard.querySelectorAll('.option-item');

    console.log('Found question card:', questionCard);
    console.log('Found options:', options.length);

    if (!questionCard || options.length === 0) {
        console.error('Question card or options not found');
        return;
    }

    if (optionIndex >= options.length) {
        console.error('Option index out of range:', optionIndex, 'max:', options.length - 1);
        return;
    }

    // Clear previous selections
    options.forEach(option => option.classList.remove('selected'));

    // Select current option
    options[optionIndex].classList.add('selected');
    const radioInput = options[optionIndex].querySelector('input');
    if (radioInput) {
        radioInput.checked = true;
    }

    // Store answer
    answers[questionIndex] = optionIndex;
    console.log('Answer stored:', answers);

    // Mark question as answered in navigator
    const navQuestions = document.querySelectorAll('.nav-question');
    if (navQuestions[questionIndex]) {
        navQuestions[questionIndex].classList.add('answered');
    }
}

// Fill in the blanks
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('fill-blanks-input')) {
        const questionIndex = e.target.dataset.question;
        const blankIndex = e.target.dataset.blank;
        
        if (!answers[questionIndex]) {
            answers[questionIndex] = {};
        }
        
        answers[questionIndex][blankIndex] = e.target.value;
        
        // Mark question as answered if any blank is filled
        if (Object.keys(answers[questionIndex]).length > 0) {
            document.querySelectorAll('.nav-question')[questionIndex].classList.add('answered');
        }
    }
});

// Submit test
function submitTest() {
    const answeredCount = Object.keys(answers).length;
    const unansweredCount = totalQuestions - answeredCount;
    
    let confirmMessage = 'Are you sure you want to submit your test?';
    if (unansweredCount > 0) {
        confirmMessage += `\n\nYou have ${unansweredCount} unanswered question(s).`;
    }
    
    if (confirm(confirmMessage)) {
        // Prepare submission data
        const totalTimeInSeconds = {{ $test->time_limit ? $test->time_limit * 60 : 0 }};
        const timeTaken = totalTimeInSeconds > 0 ? Math.max(0, totalTimeInSeconds - timeRemaining) : 0;

        const submissionData = {
            test_id: {{ $test->id }},
            answers: answers,
            time_taken: timeTaken
        };

        console.log('Submitting test with data:', submissionData);

        // Submit via AJAX
        fetch(`/student/test/{{ $test->id }}/submit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(submissionData)
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                alert('Error submitting test: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting test: ' + error.message);
        });
    }
}

// Prevent accidental page refresh
window.addEventListener('beforeunload', function(e) {
    if (Object.keys(answers).length > 0) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Debug: Initialize test debugging
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== TEST DEBUG INFO ===');
    console.log('Total questions: {{ $totalQuestions }}');

    @foreach($test->questions->sortBy('order') as $index => $question)
        console.log('Question {{ $index }}: Type={{ $question->type }}, Options={{ $question->options->count() }}');
    @endforeach

    console.log('=== END DEBUG INFO ===');
});
</script>
@endpush
@endsection
