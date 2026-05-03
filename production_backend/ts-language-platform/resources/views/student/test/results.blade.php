@extends('layouts.app')

@section('title', 'Test Results - ' . $test->title)

@section('content')
<style>
/* Test Results Styles */
.results-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 2rem 0;
    border-radius: 0 0 16px 16px;
    margin-bottom: 2rem;
}

.results-header.failed {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.results-container {
    max-width: 800px;
    margin: 0 auto;
}

.score-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.score-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 2rem;
    font-weight: bold;
    color: white;
}

.score-circle.passed {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.score-circle.failed {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.test-info {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.info-item {
    text-align: center;
}

.info-value {
    font-size: 1.5rem;
    font-weight: bold;
    color: #1f2937;
}

.info-label {
    color: #6b7280;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.attempts-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    margin-bottom: 2rem;
}

.attempt-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.attempt-item.current {
    border-color: #3b82f6;
    background: #eff6ff;
}

.attempt-score {
    font-weight: bold;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    color: white;
}

.attempt-score.passed {
    background: #10b981;
}

.attempt-score.failed {
    background: #ef4444;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn-retake {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-retake:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    color: white;
}

.btn-retake:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-back {
    background: #6b7280;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #4b5563;
    color: white;
}

.detailed-results {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    margin-bottom: 2rem;
}

.question-result {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.question-result.correct {
    border-color: #10b981;
    background: #f0fdf4;
}

.question-result.incorrect {
    border-color: #ef4444;
    background: #fef2f2;
}

.question-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.result-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
}

.result-icon.correct {
    background: #10b981;
}

.result-icon.incorrect {
    background: #ef4444;
}

.audio-container {
    text-align: center;
    padding: 1rem;
    background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
    border-radius: 8px;
    border: 2px solid #fdba74;
    margin: 1rem 0;
}

.audio-container audio {
    margin-top: 0.5rem;
    border-radius: 4px;
}

@media (max-width: 768px) {
    .results-container {
        padding: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="results-header {{ $attempt->passed ? '' : 'failed' }}">
    <div class="container text-center">
        <h1 class="mb-2">{{ $attempt->passed ? '🎉 Congratulations!' : '📚 Keep Learning!' }}</h1>
        <h2>{{ $test->title }} - Results</h2>
        <p class="mb-0">{{ $test->course->title }}</p>
    </div>
</div>

<div class="container">
    <div class="results-container">
        <!-- Score Card -->
        <div class="score-card">
            <div class="score-circle {{ $attempt->passed ? 'passed' : 'failed' }}">
                {{ number_format($attempt->score, 1) }}%
            </div>
            <h3 class="mb-2">{{ $attempt->passed ? 'Passed!' : 'Not Passed' }}</h3>
            <p class="text-muted mb-0">
                {{ $attempt->passed ? 'Great job! You have successfully completed this test.' : 'Don\'t worry! You can try again to improve your score.' }}
            </p>
        </div>

        <!-- Test Information -->
        <div class="test-info">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-value">{{ number_format($attempt->score, 1) }}%</div>
                    <div class="info-label">Your Score</div>
                </div>
                <div class="info-item">
                    <div class="info-value">{{ $test->passing_score }}%</div>
                    <div class="info-label">Passing Score</div>
                </div>
                <div class="info-item">
                    <div class="info-value">{{ $attempt->attempt_number }}</div>
                    <div class="info-label">Attempt Number</div>
                </div>
                @if($attempt->time_taken)
                <div class="info-item">
                    <div class="info-value">{{ gmdate('H:i:s', $attempt->time_taken) }}</div>
                    <div class="info-label">Time Taken</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Previous Attempts -->
        @if($allAttempts->count() > 1)
        <div class="attempts-section">
            <h4 class="mb-3">All Attempts</h4>
            @foreach($allAttempts as $attemptItem)
            <div class="attempt-item {{ $attemptItem->id === $attempt->id ? 'current' : '' }}">
                <div>
                    <strong>Attempt {{ $attemptItem->attempt_number }}</strong>
                    <div class="text-muted small">{{ $attemptItem->completed_at ? $attemptItem->completed_at->format('M j, Y g:i A') : 'In Progress' }}</div>
                </div>
                @if($attemptItem->completed_at)
                <div class="attempt-score {{ $attemptItem->passed ? 'passed' : 'failed' }}">
                    {{ number_format($attemptItem->score, 1) }}%
                </div>
                @else
                <div class="text-muted">In Progress</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <!-- Detailed Results -->
        @if($detailedResults && $test->show_answers)
        <div class="detailed-results">
            <h4 class="mb-3">Question Review</h4>
            @foreach($detailedResults as $index => $result)
            <div class="question-result {{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
                <div class="question-header">
                    <div class="result-icon {{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
                        {{ $result['is_correct'] ? '✓' : '✗' }}
                    </div>
                    <div>
                        <strong>Question {{ $index + 1 }}</strong>
                        <span class="badge bg-secondary ms-2">{{ strtoupper(str_replace('_', ' ', $result['question']->type)) }}</span>
                    </div>
                </div>

                <div class="question-text mb-3">{{ $result['question']->question_text }}</div>

                <!-- Question Media -->
                @if($result['question']->question_media)
                    @if($result['question']->type === 'audio')
                        <div class="audio-container">
                            <i class="bi bi-volume-up fs-4 text-warning mb-2"></i>
                            <audio controls class="w-100">
                                <source src="{{ $result['question']->question_media }}" type="audio/mpeg">
                                <source src="{{ $result['question']->question_media }}" type="audio/wav">
                                <source src="{{ $result['question']->question_media }}" type="audio/ogg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @elseif($result['question']->type === 'video')
                        <div class="mb-3">
                            @if(str_contains($result['question']->question_media, 'youtube.com') || str_contains($result['question']->question_media, 'youtu.be'))
                                <iframe width="100%" height="315" src="{{ $result['question']->question_media }}" frameborder="0" allowfullscreen></iframe>
                            @else
                                <video controls class="w-100">
                                    <source src="{{ $result['question']->question_media }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    @else
                        <div class="mb-3">
                            <img src="{{ $result['question']->question_media }}" alt="Question Image" class="img-fluid rounded">
                        </div>
                    @endif
                @endif

                <!-- Options for MCQ questions -->
                @if(in_array($result['question']->type, ['mcq', 'mcq_image', 'audio', 'video', 'image_mcq']))
                    <div class="options-review">
                        @foreach($result['question']->options as $optionIndex => $option)
                        <div class="option-review mb-2 p-2 rounded
                            {{ $optionIndex === $result['correct_answer'] ? 'bg-success text-white' : '' }}
                            {{ $optionIndex === $result['user_answer'] && $optionIndex !== $result['correct_answer'] ? 'bg-danger text-white' : '' }}">
                            <div class="d-flex align-items-center">
                                @if($optionIndex === $result['user_answer'])
                                    <i class="bi bi-arrow-right-circle-fill me-2"></i>
                                @endif
                                @if($optionIndex === $result['correct_answer'])
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                @endif
                                <span>{{ chr(65 + $optionIndex) }}. {{ $option->option_text }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <!-- Fill in the blanks -->
                @if($result['question']->type === 'fill_blanks')
                    <div class="fill-blanks-review">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Your Answers:</h6>
                                @if(is_array($result['user_answer']))
                                    @foreach($result['user_answer'] as $answer)
                                    <div class="badge bg-secondary me-1 mb-1">{{ $answer ?: '(blank)' }}</div>
                                    @endforeach
                                @else
                                    <span class="text-muted">No answer provided</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6>Correct Answers:</h6>
                                @foreach($result['correct_answer'] as $answer)
                                <div class="badge bg-success me-1 mb-1">{{ $answer }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if($result['question']->explanation)
                <div class="explanation mt-3 p-3 bg-light rounded">
                    <h6><i class="bi bi-lightbulb"></i> Explanation:</h6>
                    <p class="mb-0">{{ $result['question']->explanation }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('student.course.show', $test->course) }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Back to Course
            </a>
            
            @if($canRetake)
            <form action="{{ route('student.test.start', $test) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-retake">
                    <i class="bi bi-arrow-clockwise"></i>
                    Retake Test
                    @if($test->max_attempts)
                        ({{ $attemptsLeft }} left)
                    @endif
                </button>
            </form>
            @else
            <button class="btn-retake" disabled>
                <i class="bi bi-x-circle"></i>
                No More Attempts
            </button>
            @endif
        </div>
    </div>
</div>
@endsection
