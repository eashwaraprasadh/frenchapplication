<div class="content-block" data-block-id="{{ $block->id ?? 'new' }}" data-block-type="{{ $block->type ?? $type }}">
    <div class="block-header">
        <div class="block-type">
            @switch($block->type ?? $type)
                @case('title')
                    <i class="bi bi-type content-type-title"></i>
                    <span>Title/Heading</span>
                    @break
                @case('text')
                    <i class="bi bi-text-paragraph content-type-text"></i>
                    <span>Text</span>
                    @break
                @case('image')
                    <i class="bi bi-image content-type-image"></i>
                    <span>Image</span>
                    @break
                @case('video')
                    <i class="bi bi-play-circle content-type-video"></i>
                    <span>Video</span>
                    @break
                @case('audio')
                    <i class="bi bi-music-note content-type-audio"></i>
                    <span>Audio</span>
                    @break
                @case('document')
                    <i class="bi bi-file-earmark content-type-document"></i>
                    <span>Document</span>
                    @break
                @case('exercise')
                    <i class="bi bi-puzzle content-type-exercise"></i>
                    <span>Exercise</span>
                    @break
            @endswitch
        </div>
        <div class="block-actions">
            <span class="drag-handle">
                <i class="bi bi-grip-vertical"></i>
            </span>
            @if(isset($block))
                <button class="block-btn" onclick="editBlock({{ $block->id }})">Edit</button>
                <button class="block-btn btn-danger" onclick="deleteBlock({{ $block->id }})">Delete</button>
            @else
                <button class="block-btn btn-primary" onclick="saveNewBlock(this)">Save</button>
                <button class="block-btn" onclick="cancelNewBlock(this)">Cancel</button>
            @endif
        </div>
    </div>
    
    <div class="block-content">
        @if(isset($block))
            <!-- Existing Block Display Mode -->
            @switch($block->type)
                @case('title')
                    <div class="title-display">
                        <h2 style="margin: 0; color: #202124;">{{ $block->content['text'] ?? '' }}</h2>
                    </div>
                    @break

                @case('text')
                    <div class="text-display">
                        {!! $block->content['text'] ?? '' !!}
                    </div>
                    @break

                @case('image')
                    <div class="image-display">
                        @if(isset($block->content['image_url']))
                            <img src="{{ $block->content['image_url'] }}"
                                 alt="{{ $block->content['alt_text'] ?? '' }}"
                                 class="img-fluid rounded"
                                 style="max-height: 400px; object-fit: contain;">
                            @if(isset($block->content['caption']))
                                <p class="text-muted mt-2 mb-0">{{ $block->content['caption'] }}</p>
                            @endif
                        @endif
                    </div>
                    @break

                @case('video')
                    <div class="video-display">
                        @if(isset($block->content['video_url']))
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $block->content['video_url'] }}" allowfullscreen></iframe>
                            </div>
                            @if(isset($block->content['caption']))
                                <p class="text-muted mt-2 mb-0">{{ $block->content['caption'] }}</p>
                            @endif
                        @endif
                    </div>
                    @break

                @case('audio')
                    <div class="audio-display">
                        @if(isset($block->content['audio_url']))
                            <audio controls class="w-100 mb-2">
                                <source src="{{ $block->content['audio_url'] }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            @if(isset($block->content['title']))
                                <h6 class="mb-1">{{ $block->content['title'] }}</h6>
                            @endif
                            @if(isset($block->content['transcript']))
                                <details class="mt-2">
                                    <summary class="text-muted">Transcript</summary>
                                    <p class="mt-2 mb-0">{{ $block->content['transcript'] }}</p>
                                </details>
                            @endif
                        @endif
                    </div>
                    @break

                @case('document')
                    <div class="document-display" data-alignment="{{ $block->content['alignment'] ?? 'left' }}">
                        @if(isset($block->content['url']))
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-2">
                                        <i class="bi bi-file-earmark me-2"></i>
                                        {{ $block->content['title'] ?? ($block->content['original_name'] ?? 'Document') }}
                                    </h6>
                                    @if(!empty($block->content['description']))
                                        <p class="card-text text-muted doc-description">{{ $block->content['description'] }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <a href="{{ $block->content['url'] }}" class="btn btn-sm btn-outline-primary me-2" target="_blank">Open</a>
                                        @if($block->content['downloadable'] ?? true)
                                            <a href="{{ $block->content['url'] }}" class="btn btn-sm btn-primary" download>Download</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-muted">No document attached.</div>
                        @endif
                    </div>
                    @break

                @case('exercise')
                    <div class="exercise-display">
                        @if(isset($block->content['question']))
                            <h6>{{ $block->content['question'] }}</h6>
                            @if($block->content['type'] === 'multiple_choice')
                                @foreach($block->content['options'] as $index => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" disabled>
                                        <label class="form-check-label">{{ $option }}</label>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    @break
            @endswitch
        @else
            <!-- New Block Edit Mode -->
            @switch($type)
                @case('title')
                    <div class="title-edit">
                        <input type="text" class="form-control form-control-lg" 
                               placeholder="Enter your title or heading..." 
                               style="border: none; font-size: 1.5rem; font-weight: 500;">
                    </div>
                    @break
                    
                @case('text')
                    <div class="text-edit">
                        <div id="textEditor" style="min-height: 150px; border: 1px solid #dee2e6; border-radius: 8px;"></div>
                    </div>
                    @break
                    
                @case('image')
                    <div class="image-edit">
                        <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;">
                            <i class="bi bi-cloud-upload" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem;"></i>
                            <p class="mb-2">Click to upload or drag and drop</p>
                            <small class="text-muted">PNG, JPG, GIF up to 10MB</small>
                            <input type="file" class="d-none" accept="image/*">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control mb-2" placeholder="Alt text (for accessibility)">
                            <input type="text" class="form-control" placeholder="Caption (optional)">
                        </div>
                    </div>
                    @break
                    
                @case('video')
                    <div class="video-edit">
                        <div class="mb-3">
                            <label class="form-label">Video Source</label>
                            <select class="form-select mb-2">
                                <option value="youtube">YouTube</option>
                                <option value="vimeo">Vimeo</option>
                                <option value="upload">Upload File</option>
                            </select>
                            <input type="url" class="form-control" placeholder="Enter video URL...">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Caption (optional)">
                        </div>
                    </div>
                    @break
                    
                @case('audio')
                    <div class="audio-edit">
                        <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;">
                            <i class="bi bi-music-note" style="font-size: 2rem; color: #6c757d; margin-bottom: 1rem;"></i>
                            <p class="mb-2">Click to upload audio file</p>
                            <small class="text-muted">MP3, WAV up to 50MB</small>
                            <input type="file" class="d-none" accept="audio/*">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control mb-2" placeholder="Audio title">
                            <textarea class="form-control" rows="3" placeholder="Transcript (optional)"></textarea>
                        </div>
                    </div>
                    @break
                    
                @case('exercise')
                    <div class="exercise-edit">
                        <div class="mb-3">
                            <label class="form-label">Exercise Type</label>
                            <select class="form-select mb-3">
                                <option value="multiple_choice">Multiple Choice</option>
                                <option value="fill_blanks">Fill in the Blanks</option>
                                <option value="matching">Matching</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <textarea class="form-control" rows="2" placeholder="Enter your question..."></textarea>
                        </div>
                        <div class="options-container">
                            <label class="form-label">Options</label>
                            <div class="option-item mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" name="correct_answer" value="0">
                                    </span>
                                    <input type="text" class="form-control" placeholder="Option 1">
                                </div>
                            </div>
                            <div class="option-item mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input type="radio" name="correct_answer" value="1">
                                    </span>
                                    <input type="text" class="form-control" placeholder="Option 2">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption(this)">
                                <i class="bi bi-plus"></i> Add Option
                            </button>
                        </div>
                    </div>
                    @break
            @endswitch
        @endif
    </div>
</div>

<style>
.upload-area:hover {
    border-color: #28a745;
    background-color: #f8fff9;
}

.upload-area.dragover {
    border-color: #28a745;
    background-color: #f8fff9;
}

.option-item .input-group-text {
    background: white;
    border-right: none;
}

.option-item .form-control {
    border-left: none;
}

.option-item .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}

/* Ensure Quill alignment classes apply in admin preview */
.ql-align-left { text-align: left; }
.ql-align-center { text-align: center; }
.ql-align-right { text-align: right; }
</style>
