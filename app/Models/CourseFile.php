<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseFile extends Model
{
    protected $fillable = [
        'course_id',
        'folder_id',
        'original_name',
        'filename',
        'path',
        'size',
        'mime_type',
        'uploaded_by',
        'order_index',
        'downloadable',
        'viewable',
    ];

    protected $casts = [
        'size' => 'integer',
        'order_index' => 'integer',
        'downloadable' => 'boolean',
        'viewable' => 'boolean',
    ];

    /**
     * Get the course that owns the file.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the folder that owns the file.
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(CourseFolder::class, 'folder_id');
    }

    /**
     * Get the user who uploaded the file.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the file icon based on mime type
     */
    public function getIconAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'bi-file-earmark-pdf text-danger',
            str_contains($this->mime_type, 'word') || str_contains($this->mime_type, 'document') => 'bi-file-earmark-word text-primary',
            str_contains($this->mime_type, 'powerpoint') || str_contains($this->mime_type, 'presentation') => 'bi-file-earmark-ppt text-warning',
            str_contains($this->mime_type, 'excel') || str_contains($this->mime_type, 'spreadsheet') => 'bi-file-earmark-spreadsheet text-success',
            str_contains($this->mime_type, 'image') => 'bi-file-earmark-image text-info',
            str_contains($this->mime_type, 'audio') => 'bi-file-earmark-music text-secondary',
            str_contains($this->mime_type, 'video') => 'bi-file-earmark-play text-secondary',
            default => 'bi-file-earmark text-muted',
        };
    }

    /**
     * Get the file type label
     */
    public function getTypeAttribute(): string
    {
        return match (true) {
            str_contains($this->mime_type, 'pdf') => 'PDF',
            str_contains($this->mime_type, 'powerpoint') || str_contains($this->mime_type, 'presentation') => 'PowerPoint',
            str_contains($this->mime_type, 'excel') || str_contains($this->mime_type, 'spreadsheet') => 'Excel',
            str_contains($this->mime_type, 'word') || str_contains($this->mime_type, 'document') => 'Word', // Checked last as 'document' is generic
            str_contains($this->mime_type, 'image') => 'Image',
            str_contains($this->mime_type, 'audio') => 'Audio',
            str_contains($this->mime_type, 'video') => 'Video',
            default => 'File',
        };
    }

    /**
     * Get the download URL
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('serve-storage', ['path' => $this->path]);
    }
}

