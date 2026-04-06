<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends Model
{
    protected $fillable = [
        'student_id',
        'lesson_id',
        'status',
        'completed_at',
        'time_spent'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'time_spent' => 'integer'
    ];

    /**
     * Get the user that owns the lesson progress.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the lesson that owns the progress.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
