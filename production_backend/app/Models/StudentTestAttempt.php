<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class StudentTestAttempt extends Model
{
    protected $fillable = [
        'student_id',
        'test_id',
        'attempt_number',
        'status',
        'started_at',
        'completed_at',
        'score',
        'passed',
        'answers',
        'time_taken'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'score' => 'decimal:2',
        'passed' => 'boolean',
        'answers' => 'array'
    ];

    /**
     * Get the student that owns the attempt.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the test that owns the attempt.
     */
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
