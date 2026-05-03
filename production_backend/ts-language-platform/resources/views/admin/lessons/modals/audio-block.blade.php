<!-- Audio Block Modal -->
<div class="modal fade" id="audioBlockModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-music-note me-2"></i>
                    <span id="audioBlockModalTitle">Add Audio Block</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="audioBlockForm">
                    <!-- Audio Upload Area -->
                    <div class="mb-4">
                        <label class="form-label">Audio File</label>
                        <div class="audio-upload-area" id="audioUploadArea">
                            <div class="upload-placeholder" id="audioUploadPlaceholder">
                                <i class="bi bi-cloud-upload fs-1 text-muted mb-3"></i>
                                <h6>Drop audio file here or click to browse</h6>
                                <p class="text-muted mb-0">Supports: MP3, WAV, OGG (Max: 50MB)</p>
                            </div>
                            <div class="audio-preview" id="audioPreview" style="display: none;">
                                <audio id="previewAudio" controls class="w-100 mb-3"></audio>
                                <div class="audio-info" id="audioInfo"></div>
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeAudio()">
                                    <i class="bi bi-trash me-1"></i>
                                    Remove Audio
                                </button>
                            </div>
                        </div>
                        <input type="file" id="audioInput" accept="audio/*" style="display: none;">
                    </div>

                    <!-- Audio Settings -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="audioTitle" class="form-label">Audio Title</label>
                                <input type="text" class="form-control" id="audioTitle" placeholder="Enter audio title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="audioAlignment" class="form-label">Alignment</label>
                                <select class="form-select" id="audioAlignment">
                                    <option value="left">Left</option>
                                    <option value="center" selected>Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="audioAutoplay">
                                    <label class="form-check-label" for="audioAutoplay">
                                        Autoplay (not recommended)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="audioLoop">
                                    <label class="form-check-label" for="audioLoop">
                                        Loop audio
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="audioTranscript" class="form-label">Transcript (Optional)</label>
                        <textarea class="form-control" id="audioTranscript" rows="4" placeholder="Add a transcript for accessibility"></textarea>
                        <div class="form-text">Transcripts improve accessibility and SEO</div>
                    </div>

                    <div class="mb-3">
                        <label for="audioCaption" class="form-label">Caption (Optional)</label>
                        <textarea class="form-control" id="audioCaption" rows="2" placeholder="Add a caption for this audio"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="audioDownloadable">
                            <label class="form-check-label" for="audioDownloadable">
                                Allow students to download this audio
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveAudioBlock()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Audio Block
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.audio-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.audio-upload-area:hover {
    border-color: #2e7d32;
    background: #e8f5e8;
}

.audio-upload-area.dragover {
    border-color: #2e7d32;
    background: #e8f5e8;
}

.audio-info {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    text-align: left;
}
</style>

<script>
let selectedAudioFile = null;

document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('audioUploadArea');
    const audioInput = document.getElementById('audioInput');
    
    // Click to upload
    uploadArea.addEventListener('click', function() {
        audioInput.click();
    });
    
    // File input change
    audioInput.addEventListener('change', function(e) {
        handleAudioFile(e.target.files[0]);
    });
    
    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleAudioFile(files[0]);
        }
    });
});

function handleAudioFile(file) {
    if (!file) return;
    
    // Validate file type
    if (!file.type.startsWith('audio/')) {
        showNotification('Please select a valid audio file', 'error');
        return;
    }
    
    // Validate file size (50MB)
    if (file.size > 50 * 1024 * 1024) {
        showNotification('Audio file size must be less than 50MB', 'error');
        return;
    }
    
    selectedAudioFile = file;
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        const audio = document.getElementById('previewAudio');
        audio.src = e.target.result;
        
        // Show audio info
        const audioInfo = document.getElementById('audioInfo');
        audioInfo.innerHTML = `
            <div class="row">
                <div class="col-6">
                    <strong>Filename:</strong><br>
                    <span class="text-muted">${file.name}</span>
                </div>
                <div class="col-6">
                    <strong>Size:</strong><br>
                    <span class="text-muted">${formatFileSize(file.size)}</span>
                </div>
            </div>
        `;
        
        // Auto-fill title if empty
        const titleInput = document.getElementById('audioTitle');
        if (!titleInput.value) {
            titleInput.value = file.name.replace(/\.[^/.]+$/, ""); // Remove extension
        }
        
        document.getElementById('audioUploadPlaceholder').style.display = 'none';
        document.getElementById('audioPreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function removeAudio() {
    selectedAudioFile = null;
    document.getElementById('audioUploadPlaceholder').style.display = 'block';
    document.getElementById('audioPreview').style.display = 'none';
    document.getElementById('audioInput').value = '';
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function saveAudioBlock() {
    if (!selectedAudioFile) {
        showNotification('Please select an audio file', 'error');
        return;
    }
    
    const title = document.getElementById('audioTitle').value;
    if (!title.trim()) {
        showNotification('Please enter an audio title', 'error');
        return;
    }
    
    // In a real implementation, you would upload the file first
    const content = {
        url: URL.createObjectURL(selectedAudioFile), // Temporary URL for demo
        title: title,
        alignment: document.getElementById('audioAlignment').value,
        autoplay: document.getElementById('audioAutoplay').checked,
        loop: document.getElementById('audioLoop').checked,
        transcript: document.getElementById('audioTranscript').value,
        caption: document.getElementById('audioCaption').value,
        downloadable: document.getElementById('audioDownloadable').checked,
        filename: selectedAudioFile.name,
        filesize: selectedAudioFile.size,
        duration: 0 // Would be calculated after upload
    };
    
    saveContentBlock('audio', content);
}
</script>
