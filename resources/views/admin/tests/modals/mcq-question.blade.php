<!-- Multiple Choice Question Modal -->
<div class="modal fade" id="mcqQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-list-check me-2 question-type-mcq"></i>
                    <span id="mcqQuestionModalTitle">Add Multiple Choice Question</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="mcqQuestionForm">
                    <div class="mb-3">
                        <label for="mcqQuestionText" class="form-label">Question Text</label>
                        <textarea class="form-control" id="mcqQuestionText" rows="3" placeholder="Enter your question here..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="mcqQuestionMedia" class="form-label">Question Image (Optional)</label>
                        <input type="file" class="form-control" id="mcqQuestionMedia" accept="image/*">
                        <div class="form-text">Add an image to support your question</div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Answer Options</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addMcqOption()">
                                <i class="bi bi-plus me-1"></i>
                                Add Option
                            </button>
                        </div>
                        <div id="mcqOptionsContainer">
                            <div class="mcq-option mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input type="radio" name="mcqCorrectOption" value="0" checked>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Option 1" data-option-index="0" required>
                                    <button type="button" class="btn btn-outline-danger" onclick="removeMcqOption(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mcq-option mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input type="radio" name="mcqCorrectOption" value="1">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Option 2" data-option-index="1" required>
                                    <button type="button" class="btn btn-outline-danger" onclick="removeMcqOption(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-text">Select the radio button next to the correct answer</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mcqPoints" class="form-label">Points</label>
                                <input type="number" class="form-control" id="mcqPoints" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mcqDifficulty" class="form-label">Difficulty</label>
                                <select class="form-select" id="mcqDifficulty">
                                    <option value="easy">Easy</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mcqExplanation" class="form-label">Explanation (Optional)</label>
                        <textarea class="form-control" id="mcqExplanation" rows="2" placeholder="Explain why this is the correct answer"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="mcqRandomizeOptions">
                            <label class="form-check-label" for="mcqRandomizeOptions">
                                Randomize option order for each student
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveMcqQuestion()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Question
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let mcqOptionIndex = 2;

function addMcqOption() {
    const container = document.getElementById('mcqOptionsContainer');
    const optionHtml = `
        <div class="mcq-option mb-2">
            <div class="input-group">
                <div class="input-group-text">
                    <input type="radio" name="mcqCorrectOption" value="${mcqOptionIndex}">
                </div>
                <input type="text" class="form-control" placeholder="Option ${mcqOptionIndex + 1}" data-option-index="${mcqOptionIndex}" required>
                <button type="button" class="btn btn-outline-danger" onclick="removeMcqOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', optionHtml);
    mcqOptionIndex++;
}

function removeMcqOption(button) {
    const optionElement = button.closest('.mcq-option');
    if (document.querySelectorAll('.mcq-option').length > 2) {
        optionElement.remove();
    } else {
        showNotification('You must have at least 2 options', 'error');
    }
}

function saveMcqQuestion() {
    const questionText = document.getElementById('mcqQuestionText').value;
    const points = parseInt(document.getElementById('mcqPoints').value);
    const explanation = document.getElementById('mcqExplanation').value;
    const difficulty = document.getElementById('mcqDifficulty').value;
    const randomizeOptions = document.getElementById('mcqRandomizeOptions').checked;
    
    if (!questionText.trim()) {
        showNotification('Please enter a question text', 'error');
        return;
    }
    
    // Collect options
    const options = [];
    const correctOption = document.querySelector('input[name="mcqCorrectOption"]:checked');
    
    document.querySelectorAll('#mcqOptionsContainer input[type="text"]').forEach((input, index) => {
        if (input.value.trim()) {
            options.push({
                text: input.value.trim(),
                is_correct: correctOption && correctOption.value == index,
                order: index + 1
            });
        }
    });
    
    if (options.length < 2) {
        showNotification('Please add at least 2 options', 'error');
        return;
    }
    
    if (!correctOption) {
        showNotification('Please select the correct answer', 'error');
        return;
    }
    
    const questionData = {
        question_text: questionText,
        question_media: null, // File upload would be handled separately
        correct_answer: [correctOption.value],
        explanation: explanation,
        points: points,
        difficulty: difficulty,
        randomize_options: randomizeOptions,
        options: options
    };
    
    saveQuestion('mcq', questionData);
}

// Reset form when modal is hidden
document.getElementById('mcqQuestionModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('mcqQuestionForm').reset();
    // Reset options to default 2
    const container = document.getElementById('mcqOptionsContainer');
    container.innerHTML = `
        <div class="mcq-option mb-2">
            <div class="input-group">
                <div class="input-group-text">
                    <input type="radio" name="mcqCorrectOption" value="0" checked>
                </div>
                <input type="text" class="form-control" placeholder="Option 1" data-option-index="0" required>
                <button type="button" class="btn btn-outline-danger" onclick="removeMcqOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
        <div class="mcq-option mb-2">
            <div class="input-group">
                <div class="input-group-text">
                    <input type="radio" name="mcqCorrectOption" value="1">
                </div>
                <input type="text" class="form-control" placeholder="Option 2" data-option-index="1" required>
                <button type="button" class="btn btn-outline-danger" onclick="removeMcqOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    mcqOptionIndex = 2;
});
</script>
