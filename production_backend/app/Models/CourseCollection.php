<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCollection extends Model
{
    protected $fillable = [
        'name',
        'parent_collection_id',
        'order_index',
        'status',
    ];

    protected $casts = [
        'order_index' => 'integer',
    ];

    public function parentCollection(): BelongsTo
    {
        return $this->belongsTo(CourseCollection::class, 'parent_collection_id');
    }

    public function subcollections(): HasMany
    {
        return $this->hasMany(CourseCollection::class, 'parent_collection_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'collection_id');
    }
}

