<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class TestSubmission extends Model
{
    protected $fillable = [
        'student_id',
        'test_id',
        'score',
        'passed',
        'submitted_at',
        'answers',
        'time_taken',
        'attempt_number',
        'remarks',
        'status'
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'passed' => 'boolean',
        'submitted_at' => 'datetime',
        'answers' => 'array'
    ];

    /**
     * Get the student that owns the submission.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the test that owns the submission.
     */
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
