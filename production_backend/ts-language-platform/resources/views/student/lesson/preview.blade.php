@extends('layouts.app')

@section('title', 'Lesson Preview - ' . $lesson->title)

@section('content')
<style>
/* Lesson Preview Styles */
.lesson-preview-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
    background: #f8f9fa;
    min-height: 100vh;
}

.lesson-header {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.lesson-title {
    color: #2d3748;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.lesson-description {
    color: #718096;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.lesson-info {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.info-item {
    text-align: center;
}

.info-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 600;
    color: #38a169;
}

.info-label {
    font-size: 0.9rem;
    color: #718096;
    margin-top: 0.25rem;
}

.preview-notice {
    background: #e6fffa;
    border: 1px solid #81e6d9;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 2rem;
    text-align: center;
}

.preview-notice i {
    color: #319795;
    margin-right: 0.5rem;
}

.content-block {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.content-block-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.content-block-number {
    background: #38a169;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
}

.content-type-badge {
    background: #e2e8f0;
    color: #4a5568;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    margin-left: auto;
}

.content-title {
    font-size: 1.5rem;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 1rem;
}

.content-text {
    font-size: 1.1rem;
    color: #2d3748;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.content-media {
    margin-bottom: 1.5rem;
    text-align: center;
}

.content-media img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.content-media video {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

.content-media audio {
    width: 100%;
    max-width: 500px;
}

.exercise-content {
    background: #f7fafc;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.exercise-title {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .lesson-preview-container {
        padding: 1rem;
    }
    
    .lesson-info {
        gap: 1rem;
    }
    
    .content-block {
        padding: 1.5rem;
    }
}
</style>

<div class="lesson-preview-container">
    <!-- Preview Notice -->
    <div class="preview-notice">
        <i class="bi bi-eye"></i>
        <strong>Preview Mode:</strong> This is how students will see this lesson.
    </div>

    <!-- Lesson Header -->
    <div class="lesson-header">
        <h1 class="lesson-title">{{ $lesson->title }}</h1>
        @if($lesson->description)
            <p class="lesson-description">{{ $lesson->description }}</p>
        @endif
        
        <div class="lesson-info">
            <div class="info-item">
                <span class="info-value">{{ $lesson->contentBlocks->count() }}</span>
                <div class="info-label">Content Blocks</div>
            </div>
            @if($lesson->duration)
                <div class="info-item">
                    <span class="info-value">{{ $lesson->duration }}</span>
                    <div class="info-label">Minutes</div>
                </div>
            @endif
            <div class="info-item">
                <span class="info-value">{{ ucfirst($lesson->status) }}</span>
                <div class="info-label">Status</div>
            </div>
        </div>
    </div>

    <!-- Content Blocks -->
    @foreach($lesson->contentBlocks->sortBy('order') as $index => $block)
        <div class="content-block">
            <div class="content-block-header">
                <div class="content-block-number">{{ $index + 1 }}</div>
                <div class="content-type-badge">
                    {{ ucfirst(str_replace('_', ' ', $block->type)) }}
                </div>
            </div>

            @php
                // Content is already an array due to casting in the model
                $blockData = $block->content;
            @endphp

            @if($block->type === 'title')
                <h2 class="content-title">{{ $blockData['title'] ?? $blockData['text'] ?? 'Untitled' }}</h2>
            @elseif($block->type === 'text')
                <div class="content-text">{!! $blockData['content'] ?? $blockData['text'] ?? 'No content' !!}</div>
            @elseif($block->type === 'image')
                @if(isset($blockData['image_url']) && $blockData['image_url'])
                    <div class="content-media">
                        <img src="{{ $blockData['image_url'] }}" alt="{{ $blockData['alt_text'] ?? 'Image' }}">
                    </div>
                @endif
                @if(isset($blockData['caption']) && $blockData['caption'])
                    <p class="text-center text-muted mt-2">{{ $blockData['caption'] }}</p>
                @endif
            @elseif($block->type === 'video')
                @if(isset($blockData['video_url']) && $blockData['video_url'])
                    <div class="content-media">
                        @if(str_contains($blockData['video_url'], 'youtube.com') || str_contains($blockData['video_url'], 'youtu.be'))
                            <iframe width="560" height="315" src="{{ $blockData['video_url'] }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <video controls>
                                <source src="{{ $blockData['video_url'] }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endif
                @if(isset($blockData['caption']) && $blockData['caption'])
                    <p class="text-center text-muted mt-2">{{ $blockData['caption'] }}</p>
                @endif
            @elseif($block->type === 'audio')
                @if(isset($blockData['audio_url']) && $blockData['audio_url'])
                    <div class="content-media">
                        <audio controls>
                            <source src="{{ $blockData['audio_url'] }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif
                @if(isset($blockData['caption']) && $blockData['caption'])
                    <p class="text-center text-muted mt-2">{{ $blockData['caption'] }}</p>
                @endif
            @elseif($block->type === 'exercise')
                <div class="exercise-content">
                    @if(isset($blockData['title']))
                        <div class="exercise-title">{{ $blockData['title'] }}</div>
                    @endif
                    @if(isset($blockData['instructions']))
                        <div class="content-text">{{ $blockData['instructions'] }}</div>
                    @endif
                    @if(isset($blockData['content']))
                        <div class="content-text">{!! $blockData['content'] !!}</div>
                    @endif
                </div>
            @endif
        </div>
    @endforeach

    @if($lesson->contentBlocks->count() === 0)
        <div class="content-block text-center">
            <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #cbd5e0;"></i>
            <h3 class="mt-3 text-muted">No Content Yet</h3>
            <p class="text-muted">Add content blocks to this lesson to see the preview.</p>
        </div>
    @endif
</div>
@endsection
