<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    protected $fillable = [
        'course_id',
        'folder_id',
        'title',
        'description',
        'instructions',
        'passing_score',
        'max_attempts',
        'time_limit',
        'order_index',
        'status',
        'show_answers',
        'randomize_questions',
        'total_questions',
        'type',
    ];

    protected $casts = [
        'passing_score' => 'integer',
        'max_attempts' => 'integer',
        'time_limit' => 'integer',
        'order_index' => 'integer',
        'show_answers' => 'boolean',
        'randomize_questions' => 'boolean',
        'total_questions' => 'integer',
    ];

    /**
     * Get the course that owns the test.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the folder that owns the test.
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(CourseFolder::class, 'folder_id');
    }

    /**
     * Get the questions for the test.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(TestQuestion::class);
    }

    /**
     * Get the submissions for the test.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(TestSubmission::class);
    }

    /**
     * Get the attempts for the test.
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(StudentTestAttempt::class);
    }
}
