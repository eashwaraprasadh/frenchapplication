<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestQuestion extends Model
{
    protected $fillable = [
        'test_id',
        'type',
        'question_text',
        'question_media',
        'correct_answer',
        'explanation',
        'points',
        'order',
    ];

    protected $casts = [
        'correct_answer' => 'array',
        'points' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get the test that owns the question.
     */
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Get the options for the question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(TestQuestionOption::class, 'question_id');
    }

    /**
     * Get the drag drop items for the question.
     */
    public function dragDropItems(): HasMany
    {
        return $this->hasMany(TestDragDropItem::class, 'question_id');
    }
}
