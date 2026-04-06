<!-- Exercise Block Modal -->
<div class="modal fade" id="exerciseBlockModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-puzzle me-2"></i>
                    <span id="exerciseBlockModalTitle">Add Exercise Block</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="exerciseBlockForm">
                    <!-- Exercise Type Selection -->
                    <div class="mb-4">
                        <label class="form-label">Exercise Type</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="exercise-type-card" data-type="multiple-choice">
                                    <input type="radio" name="exerciseType" value="multiple-choice" id="typeMultipleChoice" checked>
                                    <label for="typeMultipleChoice" class="exercise-type-label">
                                        <i class="bi bi-list-check"></i>
                                        <h6>Multiple Choice</h6>
                                        <p>Single correct answer</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="exercise-type-card" data-type="fill-blanks">
                                    <input type="radio" name="exerciseType" value="fill-blanks" id="typeFillBlanks">
                                    <label for="typeFillBlanks" class="exercise-type-label">
                                        <i class="bi bi-dash-square"></i>
                                        <h6>Fill in the Blanks</h6>
                                        <p>Complete the sentence</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="exercise-type-card" data-type="matching">
                                    <input type="radio" name="exerciseType" value="matching" id="typeMatching">
                                    <label for="typeMatching" class="exercise-type-label">
                                        <i class="bi bi-arrow-left-right"></i>
                                        <h6>Matching</h6>
                                        <p>Match pairs</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Exercise Content -->
                    <div class="mb-4">
                        <label for="exerciseQuestion" class="form-label">Question/Instruction</label>
                        <textarea class="form-control" id="exerciseQuestion" rows="3" placeholder="Enter the exercise question or instruction"></textarea>
                    </div>

                    <!-- Multiple Choice Options -->
                    <div id="multipleChoiceSection">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Answer Options</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption()">
                                <i class="bi bi-plus me-1"></i>
                                Add Option
                            </button>
                        </div>
                        <div id="optionsContainer">
                            <div class="option-item mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input type="radio" name="correctOption" value="0" checked>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Option 1" data-option-index="0">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="option-item mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input type="radio" name="correctOption" value="1">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Option 2" data-option-index="1">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fill in the Blanks Section -->
                    <div id="fillBlanksSection" style="display: none;">
                        <div class="mb-3">
                            <label for="sentenceWithBlanks" class="form-label">Sentence with Blanks</label>
                            <textarea class="form-control" id="sentenceWithBlanks" rows="3" placeholder="Use [blank] to indicate where students should fill in answers"></textarea>
                            <div class="form-text">Example: "The [blank] is shining brightly in the [blank]."</div>
                        </div>
                        <div class="mb-3">
                            <label for="blankAnswers" class="form-label">Correct Answers (comma-separated)</label>
                            <input type="text" class="form-control" id="blankAnswers" placeholder="sun, sky">
                            <div class="form-text">Enter answers in the order they appear in the sentence</div>
                        </div>
                    </div>

                    <!-- Matching Section -->
                    <div id="matchingSection" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0">Matching Pairs</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addMatchingPair()">
                                <i class="bi bi-plus me-1"></i>
                                Add Pair
                            </button>
                        </div>
                        <div id="matchingContainer">
                            <div class="matching-pair mb-2">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="text" class="form-control" placeholder="Left item" data-pair-index="0" data-side="left">
                                    </div>
                                    <div class="col-2 text-center">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Right item" data-pair-index="0" data-side="right">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeMatchingPair(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Exercise Settings -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exercisePoints" class="form-label">Points</label>
                                <input type="number" class="form-control" id="exercisePoints" value="1" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="exerciseRequired" checked>
                                    <label class="form-check-label" for="exerciseRequired">
                                        Required to complete lesson
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exerciseExplanation" class="form-label">Explanation (Optional)</label>
                        <textarea class="form-control" id="exerciseExplanation" rows="2" placeholder="Explain the correct answer"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveExerciseBlock()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Exercise Block
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.exercise-type-card {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    height: 100%;
}

.exercise-type-card:hover {
    border-color: #f57c00;
    background: #fff3e0;
}

.exercise-type-card input[type="radio"] {
    display: none;
}

.exercise-type-card input[type="radio"]:checked + .exercise-type-label {
    color: #f57c00;
}

.exercise-type-card input[type="radio"]:checked ~ .exercise-type-card {
    border-color: #f57c00;
    background: #fff3e0;
}

.exercise-type-label {
    cursor: pointer;
    margin: 0;
}

.exercise-type-label i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

.exercise-type-label h6 {
    margin-bottom: 0.5rem;
}

.exercise-type-label p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

.option-item, .matching-pair {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
let optionIndex = 2;
let pairIndex = 1;

document.addEventListener('DOMContentLoaded', function() {
    // Exercise type change
    document.querySelectorAll('input[name="exerciseType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            toggleExerciseSections(this.value);
        });
    });
    
    // Exercise type card clicks
    document.querySelectorAll('.exercise-type-card').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            toggleExerciseSections(radio.value);
        });
    });
});

function toggleExerciseSections(type) {
    // Hide all sections
    document.getElementById('multipleChoiceSection').style.display = 'none';
    document.getElementById('fillBlanksSection').style.display = 'none';
    document.getElementById('matchingSection').style.display = 'none';
    
    // Show selected section
    if (type === 'multiple-choice') {
        document.getElementById('multipleChoiceSection').style.display = 'block';
    } else if (type === 'fill-blanks') {
        document.getElementById('fillBlanksSection').style.display = 'block';
    } else if (type === 'matching') {
        document.getElementById('matchingSection').style.display = 'block';
    }
    
    // Update card styles
    document.querySelectorAll('.exercise-type-card').forEach(card => {
        card.classList.remove('selected');
    });
    document.querySelector(`[data-type="${type}"]`).classList.add('selected');
}

function addOption() {
    const container = document.getElementById('optionsContainer');
    const optionHtml = `
        <div class="option-item mb-2">
            <div class="input-group">
                <div class="input-group-text">
                    <input type="radio" name="correctOption" value="${optionIndex}">
                </div>
                <input type="text" class="form-control" placeholder="Option ${optionIndex + 1}" data-option-index="${optionIndex}">
                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', optionHtml);
    optionIndex++;
}

function removeOption(button) {
    const optionItem = button.closest('.option-item');
    if (document.querySelectorAll('.option-item').length > 2) {
        optionItem.remove();
    } else {
        showNotification('You must have at least 2 options', 'error');
    }
}

function addMatchingPair() {
    const container = document.getElementById('matchingContainer');
    const pairHtml = `
        <div class="matching-pair mb-2">
            <div class="row">
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Left item" data-pair-index="${pairIndex}" data-side="left">
                </div>
                <div class="col-2 text-center">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Right item" data-pair-index="${pairIndex}" data-side="right">
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeMatchingPair(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', pairHtml);
    pairIndex++;
}

function removeMatchingPair(button) {
    const pairItem = button.closest('.matching-pair');
    if (document.querySelectorAll('.matching-pair').length > 1) {
        pairItem.remove();
    } else {
        showNotification('You must have at least 1 matching pair', 'error');
    }
}

function saveExerciseBlock() {
    const exerciseType = document.querySelector('input[name="exerciseType"]:checked').value;
    const question = document.getElementById('exerciseQuestion').value;
    
    if (!question.trim()) {
        showNotification('Please enter a question or instruction', 'error');
        return;
    }
    
    let exerciseData = {
        type: exerciseType,
        question: question,
        points: parseInt(document.getElementById('exercisePoints').value),
        required: document.getElementById('exerciseRequired').checked,
        explanation: document.getElementById('exerciseExplanation').value
    };
    
    // Collect type-specific data
    if (exerciseType === 'multiple-choice') {
        const options = [];
        const correctOption = document.querySelector('input[name="correctOption"]:checked');
        
        document.querySelectorAll('#optionsContainer input[type="text"]').forEach((input, index) => {
            if (input.value.trim()) {
                options.push({
                    text: input.value.trim(),
                    correct: correctOption && correctOption.value == index
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
        
        exerciseData.options = options;
        
    } else if (exerciseType === 'fill-blanks') {
        const sentence = document.getElementById('sentenceWithBlanks').value;
        const answers = document.getElementById('blankAnswers').value;
        
        if (!sentence.trim() || !answers.trim()) {
            showNotification('Please fill in the sentence and answers', 'error');
            return;
        }
        
        exerciseData.sentence = sentence;
        exerciseData.answers = answers.split(',').map(a => a.trim());
        
    } else if (exerciseType === 'matching') {
        const pairs = [];
        
        document.querySelectorAll('.matching-pair').forEach(pair => {
            const leftInput = pair.querySelector('input[data-side="left"]');
            const rightInput = pair.querySelector('input[data-side="right"]');
            
            if (leftInput.value.trim() && rightInput.value.trim()) {
                pairs.push({
                    left: leftInput.value.trim(),
                    right: rightInput.value.trim()
                });
            }
        });
        
        if (pairs.length < 1) {
            showNotification('Please add at least 1 matching pair', 'error');
            return;
        }
        
        exerciseData.pairs = pairs;
    }
    
    saveContentBlock('exercise', exerciseData);
}
</script>
