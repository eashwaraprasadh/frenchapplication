<div class="question-block" data-question-id="{{ $question->id }}" data-question-type="{{ $question->type }}">
    <div class="question-header">
        <div class="question-type-indicator">
            <div class="question-type-icon">
                @switch($question->type)
                    @case('mcq')
                        <i class="bi bi-list-check question-type-mcq"></i>
                        <span>Multiple Choice</span>
                        @break
                    @case('mcq_image')
                        <i class="bi bi-image question-type-mcq_image"></i>
                        <span>MCQ with Images</span>
                        @break
                    @case('audio')
                        <i class="bi bi-music-note question-type-audio"></i>
                        <span>Audio Question</span>
                        @break
                    @case('video')
                        <i class="bi bi-play-circle question-type-video"></i>
                        <span>Video Question</span>
                        @break
                    @case('drag_drop')
                        <i class="bi bi-arrows-move question-type-drag_drop"></i>
                        <span>Drag & Drop</span>
                        @break
                    @case('text_input')
                        <i class="bi bi-input-cursor question-type-text_input"></i>
                        <span>Text Input</span>
                        @break
                    @case('fill_blanks')
                        <i class="bi bi-dash-square question-type-fill_blanks"></i>
                        <span>Fill in Blanks</span>
                        @break
                @endswitch
            </div>
            <div class="question-meta">
                <small class="text-muted">Question #{{ $question->order }} • {{ $question->points }} point(s)</small>
            </div>
        </div>
        <div class="question-actions">
            <span class="drag-handle" title="Drag to reorder">
                <i class="bi bi-grip-vertical"></i>
            </span>
            <button class="btn btn-sm btn-outline-primary" onclick="editQuestion({{ $question->id }})" title="Edit">
                <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteQuestion({{ $question->id }})" title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
    
    <div class="question-content">
        <div class="question-text mb-3">
            <h6>{{ $question->question_text }}</h6>
            @if($question->question_media)
                <div class="question-media mt-2">
                    @if($question->type === 'audio')
                        <audio controls class="w-100">
                            <source src="{{ $question->question_media }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif($question->type === 'video')
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $question->question_media }}" allowfullscreen></iframe>
                        </div>
                    @else
                        <img src="{{ $question->question_media }}" alt="Question media" class="img-fluid rounded">
                    @endif
                </div>
            @endif
        </div>

        @switch($question->type)
            @case('mcq')
            @case('mcq_image')
                <div class="mcq-options">
                    @foreach($question->options as $index => $option)
                        <div class="form-check mb-2 {{ $option->is_correct ? 'correct-answer' : '' }}">
                            <input class="form-check-input" type="radio" name="question_{{ $question->id }}" id="option_{{ $question->id }}_{{ $index }}" disabled {{ $option->is_correct ? 'checked' : '' }}>
                            <label class="form-check-label d-flex align-items-center" for="option_{{ $question->id }}_{{ $index }}">
                                @if($option->option_image)
                                    <img src="{{ $option->option_image }}" alt="Option image" class="option-image me-2">
                                @endif
                                <span>{{ $option->option_text }}</span>
                                @if($option->is_correct)
                                    <i class="bi bi-check-circle-fill text-success ms-2"></i>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
                @break
                
            @case('drag_drop')
                <div class="drag-drop-preview">
                    <div class="row">
                        <div class="col-6">
                            <h6>Items to match:</h6>
                            @foreach($question->dragDropItems as $item)
                                <div class="drag-item mb-2 p-2 border rounded bg-light">
                                    {{ $item->item_text }}
                                </div>
                            @endforeach
                        </div>
                        <div class="col-6">
                            <h6>Match with:</h6>
                            @foreach($question->dragDropItems as $item)
                                <div class="drop-target mb-2 p-2 border rounded">
                                    {{ $item->match_text }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @break
                
            @case('text_input')
                <div class="text-input-preview">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Student will type answer here..." disabled>
                        <small class="form-text text-muted">
                            <strong>Expected answer:</strong> 
                            @if(is_array($question->correct_answer))
                                {{ implode(', ', $question->correct_answer) }}
                            @else
                                {{ $question->correct_answer }}
                            @endif
                        </small>
                    </div>
                </div>
                @break
                
            @case('fill_blanks')
                <div class="fill-blanks-preview">
                    <p class="fill-blanks-sentence">
                        @php
                            $sentence = $question->question_text;
                            $blanks = is_array($question->correct_answer) ? $question->correct_answer : [$question->correct_answer];
                            foreach($blanks as $blank) {
                                $sentence = preg_replace('/\[blank\]/', '<span class="blank-answer badge bg-success">' . $blank . '</span>', $sentence, 1);
                            }
                        @endphp
                        {!! $sentence !!}
                    </p>
                </div>
                @break
        @endswitch

        @if($question->explanation)
            <div class="question-explanation mt-3 p-2 bg-info bg-opacity-10 rounded">
                <small class="text-muted">
                    <strong>Explanation:</strong> {{ $question->explanation }}
                </small>
            </div>
        @endif
    </div>
</div>

<style>
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

.question-block.dragging {
    opacity: 0.5;
    transform: rotate(2deg);
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
    gap: 1rem;
}

.question-type-icon {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.question-meta {
    display: flex;
    flex-direction: column;
}

.question-actions {
    display: flex;
    gap: 0.25rem;
    align-items: center;
}

.question-content {
    padding: 1.5rem;
}

.drag-handle {
    cursor: grab;
    padding: 0.25rem;
    margin-right: 0.5rem;
    color: #6c757d;
    font-size: 1.1rem;
}

.drag-handle:hover {
    color: #495057;
}

.drag-handle:active {
    cursor: grabbing;
}

.correct-answer {
    background-color: #d4edda;
    border-color: #c3e6cb;
    border-radius: 8px;
    padding: 0.5rem;
}

.option-image {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
}

.drag-item, .drop-target {
    cursor: pointer;
    transition: all 0.3s ease;
}

.drag-item:hover, .drop-target:hover {
    background-color: #e3f2fd !important;
    border-color: #2196f3 !important;
}

.blank-answer {
    margin: 0 2px;
    padding: 2px 6px;
    font-size: 0.9em;
}

.question-media {
    max-width: 100%;
}

.question-media img {
    max-height: 300px;
    object-fit: contain;
}

.question-media audio {
    max-width: 400px;
}

.question-explanation {
    font-size: 0.9rem;
}
</style>
