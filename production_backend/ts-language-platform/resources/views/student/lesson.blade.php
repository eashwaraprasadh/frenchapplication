@extends('layouts.app')

@section('title', $lesson->title . ' - TS Language Platform')

@section('content')
<style>
/* Lesson Learning Interface Styles */
.lesson-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem 0;
    border-radius: 0 0 16px 16px;
    margin-bottom: 2rem;
}

.lesson-container {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2rem;
    min-height: calc(100vh - 200px);
}

.lesson-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    height: fit-content;
}

.content-block {
    margin-bottom: 2rem;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #f1f5f9;
}

.content-block.title {
    background: linear-gradient(135deg, #f8faff 0%, #e0f2fe 100%);
    border-color: #bfdbfe;
}

.content-block.text {
    background: #fefefe;
}

.content-block.image {
    background: #f9fafb;
    text-align: center;
}

.content-block.video {
    background: #f3f4f6;
}

.content-block.audio {
    background: #fef7ff;
    border-color: #e9d5ff;
}

.content-block.exercise {
    background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    border-color: #fed7aa;
}

.block-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
}

.block-text {
    line-height: 1.7;
    color: #374151;
    font-size: 1.1rem;
}

.block-image {
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.video-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    border-radius: 8px;
    overflow: hidden;
}

.video-container iframe,
.video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.audio-player {
    width: 100%;
    border-radius: 8px;
}

.exercise-content {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    margin-top: 1rem;
}

.exercise-question {
    font-weight: 600;
    margin-bottom: 1rem;
    color: #1f2937;
}

.exercise-options {
    display: grid;
    gap: 0.75rem;
}

.exercise-option {
    padding: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.exercise-option:hover {
    border-color: #667eea;
    background: #f8faff;
}

.exercise-option.selected {
    border-color: #667eea;
    background: #667eea;
    color: white;
}

.exercise-option.correct {
    border-color: #10b981;
    background: #10b981;
    color: white;
}

.exercise-option.incorrect {
    border-color: #ef4444;
    background: #ef4444;
    color: white;
}

.lesson-sidebar {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 1.5rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.lesson-progress {
    text-align: center;
    margin-bottom: 2rem;
}

.progress-ring {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    position: relative;
}

.progress-ring svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.progress-ring circle {
    fill: none;
    stroke-width: 8;
}

.progress-ring .bg {
    stroke: #e5e7eb;
}

.progress-ring .progress {
    stroke: #667eea;
    stroke-linecap: round;
    transition: stroke-dasharray 0.3s ease;
}

.navigation-buttons {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.btn-nav {
    flex: 1;
    padding: 0.75rem;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-prev {
    background: #f3f4f6;
    color: #6b7280;
}

.btn-prev:hover:not(:disabled) {
    background: #e5e7eb;
    color: #374151;
}

.btn-next {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-nav:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.lesson-info {
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

.info-label {
    color: #6b7280;
}

.info-value {
    font-weight: 500;
    color: #1f2937;
}

.completion-celebration {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border-radius: 12px;
    margin-top: 2rem;
}

.celebration-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .lesson-container {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .lesson-sidebar {
        position: static;
        order: -1;
    }
    
    .navigation-buttons {
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

<div class="lesson-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.courses') }}" class="text-white-50">My Courses</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.course.show', $lesson->course) }}" class="text-white-50">{{ $lesson->course->title }}</a></li>
                        <li class="breadcrumb-item active text-white">{{ $lesson->title }}</li>
                    </ol>
                </nav>
                <h1 class="mb-1">{{ $lesson->title }}</h1>
                <p class="mb-0 opacity-90">{{ $lesson->description ?? 'Learn and practice new concepts' }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex justify-content-md-end gap-3">
                    <div class="text-center">
                        <div class="fs-4 fw-bold">{{ $currentBlock + 1 }}</div>
                        <small class="opacity-75">of {{ $totalBlocks }}</small>
                    </div>
                    <div class="text-center">
                        <div class="fs-4 fw-bold">{{ $progressPercentage }}%</div>
                        <small class="opacity-75">Complete</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="lesson-container">
        <!-- Main Lesson Content -->
        <div class="lesson-content">
            @if($lesson->contentBlocks && $lesson->contentBlocks->count() > 0)
                @foreach($lesson->contentBlocks->sortBy('order') as $index => $block)
                    @php
                        $blockData = $block->content;
                        $blockType = $block->type;
                    @endphp
                    
                    <div class="content-block {{ $blockType }}" id="block-{{ $index }}">
                        @if($blockType === 'title')
                            <h2 class="block-title">{{ $blockData['title'] ?? $blockData['text'] ?? 'Untitled' }}</h2>
                            
                        @elseif($blockType === 'text')
                            <div class="block-text">{!! $blockData['content'] ?? $blockData['text'] ?? 'No content' !!}</div>
                            
                        @elseif($blockType === 'image')
                            @if(isset($blockData['image_url']) && $blockData['image_url'])
                                <img src="{{ $blockData['image_url'] }}" alt="{{ $blockData['alt_text'] ?? 'Lesson Image' }}" class="block-image">
                                @if(isset($blockData['caption']) && $blockData['caption'])
                                    <p class="text-center text-muted mt-2">{{ $blockData['caption'] }}</p>
                                @endif
                            @endif
                            
                        @elseif($blockType === 'video')
                            @if(isset($blockData['video_url']) && $blockData['video_url'])
                                <div class="video-container">
                                    @if(str_contains($blockData['video_url'], 'youtube.com') || str_contains($blockData['video_url'], 'youtu.be'))
                                        <iframe src="{{ $blockData['video_url'] }}" frameborder="0" allowfullscreen></iframe>
                                    @else
                                        <video controls>
                                            <source src="{{ $blockData['video_url'] }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                                @if(isset($blockData['caption']) && $blockData['caption'])
                                    <p class="text-center text-muted mt-2">{{ $blockData['caption'] }}</p>
                                @endif
                            @endif
                            
                        @elseif($blockType === 'audio')
                            @if(isset($blockData['audio_url']) && $blockData['audio_url'])
                                <div class="text-center">
                                    <i class="bi bi-music-note-beamed fs-2 text-purple mb-3"></i>
                                    <audio controls class="audio-player">
                                        <source src="{{ $blockData['audio_url'] }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    @if(isset($blockData['caption']) && $blockData['caption'])
                                        <p class="text-muted mt-2">{{ $blockData['caption'] }}</p>
                                    @endif
                                </div>
                            @endif
                            
                        @elseif($blockType === 'exercise')
                            <div class="exercise-content">
                                <div class="exercise-question">
                                    {{ $blockData['question'] ?? $blockData['text'] ?? 'Practice Exercise' }}
                                </div>
                                
                                @if(isset($blockData['options']) && is_array($blockData['options']))
                                    <div class="exercise-options">
                                        @foreach($blockData['options'] as $optionIndex => $option)
                                            <div class="exercise-option" onclick="selectOption({{ $index }}, {{ $optionIndex }})">
                                                {{ $option }}
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-primary" onclick="checkAnswer({{ $index }})">
                                            Check Answer
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
                
                <!-- Lesson Completion -->
                @if($isCompleted)
                    <div class="completion-celebration">
                        <i class="bi bi-trophy celebration-icon"></i>
                        <h3>Lesson Completed!</h3>
                        <p>Great job! You've successfully completed this lesson.</p>
                        <div class="mt-3">
                            <a href="{{ route('student.course.show', $lesson->course) }}" class="btn btn-light me-2">
                                Back to Course
                            </a>
                            @if($nextLesson)
                                <a href="{{ route('student.lesson.show', $nextLesson) }}" class="btn btn-success">
                                    Next Lesson
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bi bi-book fs-1 text-muted"></i>
                    <h4 class="mt-3">No Content Available</h4>
                    <p class="text-muted">This lesson doesn't have any content yet.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lesson-sidebar">
            <!-- Progress -->
            <div class="lesson-progress">
                <div class="progress-ring">
                    <svg>
                        <circle class="bg" cx="40" cy="40" r="36"></circle>
                        <circle class="progress" cx="40" cy="40" r="36" 
                                stroke-dasharray="{{ $progressPercentage * 2.26 }} 226"></circle>
                    </svg>
                </div>
                <h6>{{ $progressPercentage }}% Complete</h6>
                <small class="text-muted">{{ $currentBlock + 1 }} of {{ $totalBlocks }} sections</small>
            </div>

            <!-- Navigation -->
            <div class="navigation-buttons">
                <button class="btn btn-nav btn-prev" onclick="previousSection()" 
                        {{ $currentBlock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-arrow-left me-1"></i>
                    Previous
                </button>
                <button class="btn btn-nav btn-next" onclick="nextSection()" 
                        {{ $currentBlock >= $totalBlocks - 1 ? 'disabled' : '' }}>
                    Next
                    <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>

            <!-- Lesson Info -->
            <div class="lesson-info">
                <div class="info-item">
                    <span class="info-label">Duration:</span>
                    <span class="info-value">{{ $lesson->estimated_duration ?? '10' }} min</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Difficulty:</span>
                    <span class="info-value">{{ ucfirst($lesson->difficulty ?? 'Beginner') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Course:</span>
                    <span class="info-value">{{ $lesson->course->title }}</span>
                </div>
            </div>

            <!-- Complete Lesson Button -->
            @if(!$isCompleted)
                <button class="btn btn-success w-100" onclick="completeLesson()">
                    <i class="bi bi-check-circle me-2"></i>
                    Mark as Complete
                </button>
            @else
                <div class="alert alert-success text-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Lesson Completed!
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentBlock = {{ $currentBlock }};
const totalBlocks = {{ $totalBlocks }};

// Exercise functionality
function selectOption(blockIndex, optionIndex) {
    const block = document.querySelector(`#block-${blockIndex}`);
    const options = block.querySelectorAll('.exercise-option');
    
    options.forEach(option => option.classList.remove('selected'));
    options[optionIndex].classList.add('selected');
    
    // Store selected answer
    block.dataset.selectedAnswer = optionIndex;
}

function checkAnswer(blockIndex) {
    const block = document.querySelector(`#block-${blockIndex}`);
    const selectedAnswer = block.dataset.selectedAnswer;
    
    if (selectedAnswer === undefined) {
        alert('Please select an answer first!');
        return;
    }
    
    // This would normally check against the correct answer
    // For now, we'll just show feedback
    const options = block.querySelectorAll('.exercise-option');
    options.forEach((option, index) => {
        if (index == selectedAnswer) {
            option.classList.add('correct'); // Assume correct for demo
        }
    });
    
    // Show success message
    setTimeout(() => {
        alert('Correct! Well done!');
    }, 500);
}

// Navigation
function nextSection() {
    if (currentBlock < totalBlocks - 1) {
        currentBlock++;
        scrollToBlock(currentBlock);
        updateProgress();
    }
}

function previousSection() {
    if (currentBlock > 0) {
        currentBlock--;
        scrollToBlock(currentBlock);
        updateProgress();
    }
}

function scrollToBlock(blockIndex) {
    const block = document.querySelector(`#block-${blockIndex}`);
    if (block) {
        block.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function updateProgress() {
    const progressPercentage = Math.round(((currentBlock + 1) / totalBlocks) * 100);
    const progressCircle = document.querySelector('.progress-ring .progress');
    const progressText = document.querySelector('.lesson-progress h6');
    
    progressCircle.style.strokeDasharray = `${progressPercentage * 2.26} 226`;
    progressText.textContent = `${progressPercentage}% Complete`;
    
    // Update navigation buttons
    document.querySelector('.btn-prev').disabled = currentBlock <= 0;
    document.querySelector('.btn-next').disabled = currentBlock >= totalBlocks - 1;
}

// Complete lesson
function completeLesson() {
    if (confirm('Mark this lesson as complete?')) {
        fetch(`/student/lesson/{{ $lesson->id }}/complete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error completing lesson');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error completing lesson');
        });
    }
}
</script>
@endpush
@endsection
