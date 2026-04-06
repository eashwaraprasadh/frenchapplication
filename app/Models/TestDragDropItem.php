<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestDragDropItem extends Model
{
    protected $fillable = [
        'question_id',
        'item_text',
        'match_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the question that owns the drag drop item.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class, 'question_id');
    }
}
