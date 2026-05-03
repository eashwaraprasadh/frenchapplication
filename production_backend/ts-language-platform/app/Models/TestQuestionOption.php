<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestQuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'option_text',
        'option_image',
        'is_correct',
        'order',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the question that owns the option.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class, 'question_id');
    }
}
