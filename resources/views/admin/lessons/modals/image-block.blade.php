<!-- Image Block Modal -->
<div class="modal fade" id="imageBlockModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-image me-2"></i>
                    <span id="imageBlockModalTitle">Add Image Block</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="imageBlockForm">
                    <!-- Image Upload Area -->
                    <div class="mb-4">
                        <label class="form-label">Image</label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="bi bi-cloud-upload fs-1 text-muted mb-3"></i>
                                <h6>Drop image here or click to browse</h6>
                                <p class="text-muted mb-0">Supports: JPG, PNG, GIF, WebP (Max: 10MB)</p>
                            </div>
                            <div class="image-preview" id="imagePreview" style="display: none;">
                                <img id="previewImage" src="" alt="Preview" class="img-fluid rounded">
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                    <i class="bi bi-trash me-1"></i>
                                    Remove Image
                                </button>
                            </div>
                        </div>
                        <input type="file" id="imageInput" accept="image/*" style="display: none;">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="imageAlt" class="form-label">Alt Text</label>
                                <input type="text" class="form-control" id="imageAlt" placeholder="Describe the image for accessibility">
                                <div class="form-text">Important for screen readers and SEO</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="imageAlignment" class="form-label">Alignment</label>
                                <select class="form-select" id="imageAlignment">
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
                                <label for="imageSize" class="form-label">Size</label>
                                <select class="form-select" id="imageSize">
                                    <option value="small">Small (25%)</option>
                                    <option value="medium">Medium (50%)</option>
                                    <option value="large" selected>Large (75%)</option>
                                    <option value="full">Full Width (100%)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="imageRounding" class="form-label">Style</label>
                                <select class="form-select" id="imageRounding">
                                    <option value="none">Square</option>
                                    <option value="rounded" selected>Rounded</option>
                                    <option value="circle">Circle</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imageCaption" class="form-label">Caption (Optional)</label>
                        <textarea class="form-control" id="imageCaption" rows="2" placeholder="Add a caption for this image"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="imageLightbox">
                            <label class="form-check-label" for="imageLightbox">
                                Enable lightbox (click to enlarge)
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveImageBlock()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save Image Block
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.image-upload-area {
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

.image-upload-area:hover {
    border-color: #7b1fa2;
    background: #f9f5ff;
}

.image-upload-area.dragover {
    border-color: #7b1fa2;
    background: #f9f5ff;
}

.image-preview img {
    max-height: 300px;
    object-fit: contain;
}
</style>

<script>
let selectedImageFile = null;

document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('imageUploadArea');
    const imageInput = document.getElementById('imageInput');
    
    // Click to upload
    uploadArea.addEventListener('click', function() {
        imageInput.click();
    });
    
    // File input change
    imageInput.addEventListener('change', function(e) {
        handleImageFile(e.target.files[0]);
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
            handleImageFile(files[0]);
        }
    });
});

function handleImageFile(file) {
    if (!file) return;
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        showNotification('Please select a valid image file', 'error');
        return;
    }
    
    // Validate file size (10MB)
    if (file.size > 10 * 1024 * 1024) {
        showNotification('Image file size must be less than 10MB', 'error');
        return;
    }
    
    selectedImageFile = file;
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('uploadPlaceholder').style.display = 'none';
        document.getElementById('imagePreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function removeImage() {
    selectedImageFile = null;
    document.getElementById('uploadPlaceholder').style.display = 'block';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('imageInput').value = '';
}

function saveImageBlock() {
    if (!selectedImageFile) {
        showNotification('Please select an image', 'error');
        return;
    }
    
    // In a real implementation, you would upload the file first
    // For now, we'll simulate with a placeholder URL
    const content = {
        url: URL.createObjectURL(selectedImageFile), // Temporary URL for demo
        alt: document.getElementById('imageAlt').value,
        alignment: document.getElementById('imageAlignment').value,
        size: document.getElementById('imageSize').value,
        rounding: document.getElementById('imageRounding').value,
        caption: document.getElementById('imageCaption').value,
        lightbox: document.getElementById('imageLightbox').checked,
        filename: selectedImageFile.name,
        filesize: selectedImageFile.size
    };
    
    saveContentBlock('image', content);
}
</script>
