<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonContentBlock extends Model
{
    protected $fillable = [
        'lesson_id',
        'type',
        'content',
        'order',
    ];

    protected $casts = [
        'content' => 'array',
        'order' => 'integer',
    ];

    /**
     * Get the lesson that owns the content block.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
