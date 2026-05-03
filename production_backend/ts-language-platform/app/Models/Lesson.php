<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'folder_id',
        'title',
        'description',
        'content',
        'lesson_type',
        'order_index',
        'estimated_duration',
        'is_preview',
        'status',
        'video_url',
        'audio_url',
        'attachments',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
        'attachments' => 'array',
        'estimated_duration' => 'integer',
        'order_index' => 'integer',
    ];

    /**
     * Get the course that owns the lesson.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the folder that owns the lesson.
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(CourseFolder::class, 'folder_id');
    }

    /**
     * Get the content blocks for the lesson.
     */
    public function contentBlocks(): HasMany
    {
        return $this->hasMany(LessonContentBlock::class);
    }

    /**
     * Get the progress records for the lesson.
     */
    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    /**
     * Get the bookmarks for the lesson.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(LessonBookmark::class);
    }
}
