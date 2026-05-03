<!-- Video Block Modal -->
<div class="modal fade" id="videoBlockModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-play-circle me-2"></i>
                    <span id="videoBlockModalTitle">Add Video Block</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="videoBlockForm">
                    <!-- Video Source Type -->
                    <div class="mb-4">
                        <label class="form-label">Video Source</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="videoSource" id="videoSourceYoutube" value="youtube" checked>
                            <label class="btn btn-outline-danger" for="videoSourceYoutube">
                                <i class="bi bi-youtube me-2"></i>
                                YouTube
                            </label>
                            
                            <input type="radio" class="btn-check" name="videoSource" id="videoSourceVimeo" value="vimeo">
                            <label class="btn btn-outline-primary" for="videoSourceVimeo">
                                <i class="bi bi-vimeo me-2"></i>
                                Vimeo
                            </label>
                            
                            <input type="radio" class="btn-check" name="videoSource" id="videoSourceUpload" value="upload">
                            <label class="btn btn-outline-secondary" for="videoSourceUpload">
                                <i class="bi bi-cloud-upload me-2"></i>
                                Upload
                            </label>
                        </div>
                    </div>

                    <!-- YouTube/Vimeo URL Input -->
                    <div class="mb-3" id="urlInputSection">
                        <label for="videoUrl" class="form-label">Video URL</label>
                        <input type="url" class="form-control" id="videoUrl" placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text">
                            <span id="urlHelpText">Paste a YouTube video URL</span>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="previewVideo()">
                            <i class="bi bi-eye me-1"></i>
                            Preview Video
                        </button>
                    </div>

                    <!-- Video Upload Area -->
                    <div class="mb-3" id="uploadSection" style="display: none;">
                        <label class="form-label">Upload Video</label>
                        <div class="video-upload-area" id="videoUploadArea">
                            <div class="upload-placeholder" id="videoUploadPlaceholder">
                                <i class="bi bi-cloud-upload fs-1 text-muted mb-3"></i>
                                <h6>Drop video here or click to browse</h6>
                                <p class="text-muted mb-0">Supports: MP4, WebM, MOV (Max: 100MB)</p>
                            </div>
                            <div class="video-preview" id="videoPreview" style="display: none;">
                                <video id="previewVideo" controls class="w-100" style="max-height: 300px;"></video>
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeVideo()">
                                    <i class="bi bi-trash me-1"></i>
                                    Remove Video
                                </button>
                            </div>
                        </div>
                        <input type="file" id="videoInput" accept="video/*" style="display: none;">
                    </div>

                    <!-- Video Preview -->
                    <div class="mb-3" id="videoPreviewSection" style="display: none;">
                        <label class="form-label">Preview</label>
                        <div class="ratio ratio-16x9">
                            <iframe id="videoIframe" src="" allowfullscreen></iframe>
                        </div>
                    </div>

                    <!-- Video Settings -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="videoAlignment" class="form-label">Alignment</label>
                                <select class="form-select" id="videoAlignment">
                                    <option value="left">Left</option>
                                    <option value="center" selected>Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="videoSize" class="form-label">Size</label>
                                <select class="form-select" id="videoSize">
                                    <option value="small">Small (50%)</option>
                                    <option value="medium">Medium (75%)</option>
                                    <option value="large" selected>Large (100%)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="videoAutoplay">
                                    <label class="form-check-label" for="videoAutoplay">
                                        Autoplay (not recommended)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="videoControls" checked>
                                    <label class="form-check-label" for="videoControls">
                                        Show controls
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="videoCaption" class="form-label">Caption (Optional)</label>
                        <textarea class="form-control" id="videoCaption" rows="2" placeholder="Add a caption for this video"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveVideoBlock()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Video Block
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.video-upload-area {
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

.video-upload-area:hover {
    border-color: #c62828;
    background: #ffebee;
}

.video-upload-area.dragover {
    border-color: #c62828;
    background: #ffebee;
}
</style>

<script>
let selectedVideoFile = null;

document.addEventListener('DOMContentLoaded', function() {
    // Video source type change
    document.querySelectorAll('input[name="videoSource"]').forEach(radio => {
        radio.addEventListener('change', function() {
            toggleVideoSourceSections(this.value);
        });
    });
    
    // Video upload setup
    const uploadArea = document.getElementById('videoUploadArea');
    const videoInput = document.getElementById('videoInput');
    
    uploadArea.addEventListener('click', function() {
        videoInput.click();
    });
    
    videoInput.addEventListener('change', function(e) {
        handleVideoFile(e.target.files[0]);
    });
    
    // Drag and drop for video
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
            handleVideoFile(files[0]);
        }
    });
});

function toggleVideoSourceSections(source) {
    const urlSection = document.getElementById('urlInputSection');
    const uploadSection = document.getElementById('uploadSection');
    const urlHelpText = document.getElementById('urlHelpText');
    
    if (source === 'upload') {
        urlSection.style.display = 'none';
        uploadSection.style.display = 'block';
    } else {
        urlSection.style.display = 'block';
        uploadSection.style.display = 'none';
        
        if (source === 'youtube') {
            urlHelpText.textContent = 'Paste a YouTube video URL';
        } else if (source === 'vimeo') {
            urlHelpText.textContent = 'Paste a Vimeo video URL';
        }
    }
}

function previewVideo() {
    const url = document.getElementById('videoUrl').value;
    if (!url) {
        showNotification('Please enter a video URL', 'error');
        return;
    }
    
    const embedUrl = getEmbedUrl(url);
    if (embedUrl) {
        document.getElementById('videoIframe').src = embedUrl;
        document.getElementById('videoPreviewSection').style.display = 'block';
    } else {
        showNotification('Invalid video URL', 'error');
    }
}

function getEmbedUrl(url) {
    // YouTube
    const youtubeRegex = /(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/;
    const youtubeMatch = url.match(youtubeRegex);
    if (youtubeMatch) {
        return `https://www.youtube.com/embed/${youtubeMatch[1]}`;
    }
    
    // Vimeo
    const vimeoRegex = /vimeo\.com\/(\d+)/;
    const vimeoMatch = url.match(vimeoRegex);
    if (vimeoMatch) {
        return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
    }
    
    return null;
}

function handleVideoFile(file) {
    if (!file) return;
    
    if (!file.type.startsWith('video/')) {
        showNotification('Please select a valid video file', 'error');
        return;
    }
    
    if (file.size > 100 * 1024 * 1024) {
        showNotification('Video file size must be less than 100MB', 'error');
        return;
    }
    
    selectedVideoFile = file;
    
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewVideo').src = e.target.result;
        document.getElementById('videoUploadPlaceholder').style.display = 'none';
        document.getElementById('videoPreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function removeVideo() {
    selectedVideoFile = null;
    document.getElementById('videoUploadPlaceholder').style.display = 'block';
    document.getElementById('videoPreview').style.display = 'none';
    document.getElementById('videoInput').value = '';
}

function saveVideoBlock() {
    const source = document.querySelector('input[name="videoSource"]:checked').value;
    let videoUrl = '';
    
    if (source === 'upload') {
        if (!selectedVideoFile) {
            showNotification('Please select a video file', 'error');
            return;
        }
        videoUrl = URL.createObjectURL(selectedVideoFile); // Temporary URL for demo
    } else {
        videoUrl = document.getElementById('videoUrl').value;
        if (!videoUrl) {
            showNotification('Please enter a video URL', 'error');
            return;
        }
        
        if (source !== 'upload') {
            videoUrl = getEmbedUrl(videoUrl);
            if (!videoUrl) {
                showNotification('Invalid video URL', 'error');
                return;
            }
        }
    }
    
    const content = {
        url: videoUrl,
        source: source,
        alignment: document.getElementById('videoAlignment').value,
        size: document.getElementById('videoSize').value,
        autoplay: document.getElementById('videoAutoplay').checked,
        controls: document.getElementById('videoControls').checked,
        caption: document.getElementById('videoCaption').value
    };
    
    if (source === 'upload' && selectedVideoFile) {
        content.filename = selectedVideoFile.name;
        content.filesize = selectedVideoFile.size;
    }
    
    saveContentBlock('video', content);
}
</script>
