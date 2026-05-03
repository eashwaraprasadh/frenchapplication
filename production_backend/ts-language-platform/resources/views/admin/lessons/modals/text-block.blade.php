<!-- Text Block Modal -->
<div class="modal fade" id="textBlockModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-type me-2"></i>
                    <span id="textBlockModalTitle">Add Text Block</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="textBlockForm">
                    <div class="mb-3">
                        <label for="textContent" class="form-label">Content</label>
                        <div id="textEditor" style="height: 300px; border: 1px solid #dee2e6; border-radius: 8px;"></div>
                        <div class="form-text">Use the rich text editor to format your content.</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="textAlignment" class="form-label">Text Alignment</label>
                                <select class="form-select" id="textAlignment">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                    <option value="justify">Justify</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="textSize" class="form-label">Text Size</label>
                                <select class="form-select" id="textSize">
                                    <option value="small">Small</option>
                                    <option value="normal" selected>Normal</option>
                                    <option value="large">Large</option>
                                    <option value="extra-large">Extra Large</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="highlightText">
                            <label class="form-check-label" for="highlightText">
                                Highlight this text block
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveTextBlock()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Text Block
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Quill editor for text blocks
let textQuill = null;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor when modal is shown
    document.getElementById('textBlockModal').addEventListener('shown.bs.modal', function() {
        if (!textQuill) {
            textQuill = new Quill('#textEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'blockquote', 'code-block'],
                        ['clean']
                    ]
                }
            });
        }
    });
});

function saveTextBlock() {
    if (!textQuill) {
        showNotification('Editor not initialized', 'error');
        return;
    }

    const content = {
        html: textQuill.root.innerHTML,
        text: textQuill.getText(),
        alignment: document.getElementById('textAlignment').value,
        size: document.getElementById('textSize').value,
        highlighted: document.getElementById('highlightText').checked
    };

    if (!content.text.trim()) {
        showNotification('Please enter some text content', 'error');
        return;
    }

    saveContentBlock('text', content);
}
</script>

<!-- Include Quill CSS and JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
