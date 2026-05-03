<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseFolder extends Model
{
    protected $fillable = [
        'course_id',
        'parent_folder_id',
        'name',
        'description',
        'order_index',
        'status',
    ];

    protected $casts = [
        'order_index' => 'integer',
    ];

    /**
     * Get the course that owns the folder.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the parent folder.
     */
    public function parentFolder(): BelongsTo
    {
        return $this->belongsTo(CourseFolder::class, 'parent_folder_id');
    }

    /**
     * Get the subfolders.
     */
    public function subfolders(): HasMany
    {
        return $this->hasMany(CourseFolder::class, 'parent_folder_id');
    }

    /**
     * Get the lessons in this folder.
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'folder_id');
    }

    /**
     * Get the tests in this folder.
     */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'folder_id');
    }
}
