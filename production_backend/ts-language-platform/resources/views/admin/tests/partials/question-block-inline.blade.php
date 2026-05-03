{{-- Inline Question Block for Test Editor --}}
<div class="question-block" data-question-id="{{ $question->id }}" data-question-type="{{ $question->type }}">
    <div class="question-header">
        <div class="question-type-indicator">
            <span
                class="question-number fw-bold me-2">Q{{ isset($loop) ? $loop->iteration : ($question->order ?? '') }}.</span>
            <i class="{{ $question->type === 'mcq' ? 'bi-list-ul question-type-mcq' :
    ($question->type === 'mcq_image' ? 'bi-image question-type-mcq-image' :
        ($question->type === 'audio' ? 'bi-volume-up question-type-audio' :
            ($question->type === 'video' ? 'bi-play-circle question-type-video' :
                ($question->type === 'image_mcq' ? 'bi-card-image question-type-image-mcq' :
                    ($question->type === 'image_audio_mcq' ? 'bi-image question-type-image_audio_mcq' :
                        ($question->type === 'passage_mcq' ? 'bi-file-text question-type-passage_mcq' :
                            ($question->type === 'expression_ecrite' ? 'bi-pencil-square question-type-expression-ecrite text-primary' :
                                'bi-dash-square question-type-fill-blanks'))))))) }}"></i>
            <span>{{ $question->type === 'mcq' ? 'Multiple Choice' :
    ($question->type === 'mcq_image' ? 'MCQ with Image' :
        ($question->type === 'audio' ? 'Audio + MCQ' :
            ($question->type === 'video' ? 'Video Question' :
                ($question->type === 'image_mcq' ? 'Image-based MCQ' :
                    ($question->type === 'image_audio_mcq' ? 'Image + Audio + MCQ' :
                        ($question->type === 'passage_mcq' ? 'Passage + Question + MCQ' :
                            ($question->type === 'expression_ecrite' ? 'Expression Écrite Task' :
                                'Fill in the Blanks'))))))) }}</span>
        </div>
        <div class="question-actions">
            <button type="button" class="drag-handle">
                <i class="bi bi-grip-vertical"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="editQuestion(this)">
                <i class="bi bi-pencil"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteQuestion(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
    <div class="question-content">
        <div class="question-display">
            <h6>{{ $question->question_text }}</h6>

            @if($question->question_media)
                <div class="question-media mb-3">
                    @if($question->type === 'image_audio_mcq')
                        @php
                            $media = is_string($question->question_media) ? json_decode($question->question_media, true) : $question->question_media;
                        @endphp
                        <div class="row">
                            @if(isset($media['image']))
                                <div class="col-md-6">
                                    <img src="{{ $media['image'] }}" alt="Question image"
                                        style="max-width: 100%; height: auto; border-radius: 8px;">
                                </div>
                            @endif
                            @if(isset($media['audio']))
                                <div class="col-md-6">
                                    <div class="audio-container">
                                        <i class="bi bi-volume-up fs-4 text-warning mb-2"></i>
                                        <audio controls class="w-100">
                                            <source src="{{ $media['audio'] }}" type="audio/mpeg">
                                            <source src="{{ $media['audio'] }}" type="audio/wav">
                                            <source src="{{ $media['audio'] }}" type="audio/ogg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif($question->type === 'audio')
                        <div class="audio-container">
                            <i class="bi bi-volume-up fs-4 text-warning mb-2"></i>
                            <audio controls class="w-100">
                                <source src="{{ $question->question_media }}" type="audio/mpeg">
                                <source src="{{ $question->question_media }}" type="audio/wav">
                                <source src="{{ $question->question_media }}" type="audio/ogg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @elseif(str_contains($question->question_media, 'youtube.com') || str_contains($question->question_media, 'vimeo.com'))
                        <iframe src="{{ $question->question_media }}" width="100%" height="300" frameborder="0"></iframe>
                    @elseif(preg_match('/\.(jpg|jpeg|png|gif)$/i', $question->question_media))
                        <img src="{{ $question->question_media }}" alt="Question image"
                            style="max-width: 100%; height: auto; border-radius: 8px;">
                    @else
                        <video controls style="max-width: 100%; height: auto; border-radius: 8px;">
                            <source src="{{ $question->question_media }}">
                        </video>
                    @endif
                </div>
            @endif

            @if(in_array($question->type, ['mcq', 'mcq_image', 'audio', 'video', 'image_mcq', 'image_audio_mcq', 'passage_mcq']) && $question->options->count() > 0)
                <div class="question-options">
                    @foreach($question->options as $index => $option)
                        <div class="form-check mb-2 {{ $option->is_correct ? 'text-success fw-bold' : '' }}">
                            <input class="form-check-input" type="radio" disabled {{ $option->is_correct ? 'checked' : '' }}>
                            <label class="form-check-label">
                                @if($option->option_image)
                                    <img src="{{ $option->option_image }}" alt="Option image" class="me-2"
                                        style="max-width: 50px; height: auto;">
                                @endif
                                {{ $option->option_text }}
                                @if($option->is_correct)
                                    <i class="bi bi-check-circle-fill text-success ms-2"></i>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(in_array($question->type, ['passage_mcq', 'expression_ecrite']) && $question->passage)
                <div class="passage-text mb-3 p-3"
                    style="background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 4px;">
                    @if($question->type === 'expression_ecrite')
                        @php
                            // Parse expression ecrite passage into documents
                            $passageText = $question->passage;
                            $lines = explode("\n", $passageText);
                            $intro = '';
                            $documents = [];
                            $currentDoc = null;

                            foreach ($lines as $line) {
                                $line = trim($line);
                                if (empty($line))
                                    continue;

                                // Check if line is a document header (e.g., "Document 1 :", "Document 2 :")
                                if (preg_match('/^(Document\s+\d+)\s*:(.*)$/i', $line, $matches)) {
                                    // Save previous document if exists
                                    if ($currentDoc) {
                                        $documents[] = $currentDoc;
                                    }
                                    // Start new document
                                    $currentDoc = [
                                        'title' => trim($matches[1]),
                                        'content' => trim($matches[2])
                                    ];
                                } elseif ($currentDoc) {
                                    // Add to current document content
                                    $currentDoc['content'] .= ' ' . $line;
                                } else {
                                    // This is intro text before any document
                                    $intro .= ' ' . $line;
                                }
                            }

                            // Don't forget the last document
                            if ($currentDoc) {
                                $documents[] = $currentDoc;
                            }
                        @endphp

                        @if($intro)
                            <div class="mb-3">
                                <strong class="text-primary">Instructions:</strong>
                                <p class="mt-2 mb-0">{{ trim($intro) }}</p>
                            </div>
                        @endif

                        @foreach($documents as $doc)
                            <div class="mb-3">
                                <strong class="text-info">{{ $doc['title'] }}</strong>
                                <p class="mt-1 mb-0">{{ trim($doc['content']) }}</p>
                            </div>
                        @endforeach
                    @else
                        <strong>Passage:</strong>
                        <p class="mt-2 mb-0">{{ $question->passage }}</p>
                    @endif
                </div>
            @endif

            @if($question->type === 'fill_blanks')
                <div class="fill-blanks-answers">
                    <strong>Correct answers:</strong>
                    @if(is_array($question->correct_answer))
                        {{ implode(', ', $question->correct_answer) }}
                    @else
                        {{ $question->correct_answer }}
                    @endif
                </div>
            @endif

            @if($question->explanation)
                <div class="explanation mt-3">
                    <small class="text-muted">
                        <strong>Explanation:</strong> {{ $question->explanation }}
                    </small>
                </div>
            @endif

            <div class="question-meta mt-3">
                <small class="text-muted">Points: {{ $question->points }}</small>
            </div>
        </div>
    </div>
</div>