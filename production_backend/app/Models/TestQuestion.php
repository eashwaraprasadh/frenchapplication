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
        'passage',
        'question_media',
        'correct_answer',
        'explanation',
        'points',
        'order',
        'min_words',
        'max_words',
    ];

    protected $casts = [
        'correct_answer' => 'array',
        'points' => 'integer',
        'order' => 'integer',
        'min_words' => 'integer',
        'max_words' => 'integer',
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
