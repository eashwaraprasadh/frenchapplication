<div class="test-container expression-ecrite-mode">
    <!-- Main Test Content -->
    <div class="test-content w-100">
        @if($test->questions && $test->questions->count() > 0)
            @foreach($test->questions->sortBy('order') as $index => $question)
                <div class="question-card mb-5" id="question-{{ $index }}">
                    <div class="question-header">
                        <div class="d-flex align-items-center">
                            <div class="question-number me-3">{{ $index + 1 }}</div>
                            <h4 class="mb-0">{{ $question->question_text }}</h4>
                        </div>
                        <div class="points-badge badge bg-primary rounded-pill">
                            {{ $question->points }} Points
                        </div>
                    </div>

                    @if($question->passage)
                        <div class="task-description p-3 bg-light rounded mb-4">
                            <h5>Task Instructions:</h5>
                            {!! nl2br(e($question->passage)) !!}
                        </div>
                    @endif

                    <div class="writing-area">
                        <!-- Accent Helper Toolbar -->
                        <div class="accent-toolbar">
                            @foreach(['é', 'è', 'à', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ë', 'ï', 'ü', 'ÿ', 'ç', '«', '»', '’'] as $char)
                                <button type="button" class="accent-btn"
                                    onclick="insertCharacter('{{ $char }}', 'answer-{{ $question->id }}')"
                                    title="Insert {{ $char }}">
                                    {{ $char }}
                                </button>
                            @endforeach
                            <div class="ms-auto d-flex gap-2">
                                <button type="button" class="accent-btn"
                                    onclick="formatText('bold', 'answer-{{ $question->id }}')" title="Bold"><i
                                        class="bi bi-type-bold"></i></button>
                                <button type="button" class="accent-btn"
                                    onclick="formatText('italic', 'answer-{{ $question->id }}')" title="Italic"><i
                                        class="bi bi-type-italic"></i></button>
                            </div>
                        </div>

                        <!-- Text Area -->
                        <textarea class="form-control border-top-0 rounded-0 rounded-bottom p-3" id="answer-{{ $question->id }}"
                            rows="15" placeholder="Type your response here..."
                            oninput="updateWordCount(this, {{ $question->min_words ?? 0 }}, {{ $question->max_words ?? 0 }})"></textarea>

                        <!-- Word Counter -->
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">
                                @if($question->min_words && $question->max_words)
                                    Target: {{ $question->min_words }} - {{ $question->max_words }} words
                                @endif
                            </small>
                            <div class="word-counter" id="word-count-{{ $question->id }}">
                                0 words
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                <h4 class="mt-3">No Tasks Available</h4>
            </div>
        @endif

        <div class="test-actions mt-5">
            <button class="btn btn-submit btn-lg" onclick="submitExpressionTest()">
                <i class="bi bi-check-circle me-2"></i>
                Submit Writing Task
            </button>
        </div>
    </div>
</div>

<script>
    // Initialize word counts
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize existing answers if any (not implemented yet for drafts)
    });

    function insertCharacter(char, inputId) {
        const textarea = document.getElementById(inputId);
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;

        textarea.value = text.substring(0, start) + char + text.substring(end);
        textarea.selectionStart = textarea.selectionEnd = start + 1;
        textarea.focus();

        // Trigger input event to update word count
        textarea.dispatchEvent(new Event('input'));
    }

    function formatText(command, inputId) {
        // Simple text formatting not fully supported in textarea without wysiwyg
        // We might fallback to just inserting markers or ignoring for now
        // For actual formatting we'd need a rich text editor like Quill or Trix
        // For now, let's just insert markdown-style markers as a fallback
        const textarea = document.getElementById(inputId);
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const selected = text.substring(start, end);

        let wrapper = '';
        if (command === 'bold') wrapper = '**';
        if (command === 'italic') wrapper = '*';

        textarea.value = text.substring(0, start) + wrapper + selected + wrapper + text.substring(end);
        textarea.focus();
    }

    function updateWordCount(textarea, min, max) {
        const text = textarea.value.trim();
        const wordCount = text ? text.split(/\s+/).length : 0;
        const counterEl = document.getElementById(textarea.id.replace('answer-', 'word-count-')); // Fix ID reference

        // Find the counter element relative to the textarea or by ID
        // Note: ID construction in blade was "word-count-{{ $question->id }}", textarea is "answer-{{ $question->id }}"
        // So replacing 'answer-' with 'word-count-' works.

        if (counterEl) {
            counterEl.textContent = `${wordCount} words`;

            if (min > 0 && wordCount < min) {
                counterEl.classList.add('text-warning');
                counterEl.classList.remove('text-success', 'text-danger');
            } else if (max > 0 && wordCount > max) {
                counterEl.classList.add('text-danger');
                counterEl.classList.remove('text-success', 'text-warning');
            } else {
                counterEl.classList.add('text-success');
                counterEl.classList.remove('text-warning', 'text-danger');
            }
        }

        // Store answer
        const questionId = textarea.id.replace('answer-', '');
        answers[questionId] = text;
    }

    function submitExpressionTest() {
        // Collect all answers
        // answers object is already global in parent view

        // Validate word counts if necessary
        // ...

        // Use parent submit logic but adapted
        // actually submitTest() uses `answers` global.
        // We just need to make sure `answers` is populated.
        // The updateWordCount function populates `answers`.

        // Call the parent submitTest logic
        submitTest();
    }
</script>