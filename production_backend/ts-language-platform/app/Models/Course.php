<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'language',
        'level',
        'status',
        'featured',
        'thumbnail',
        'price',
        'duration_hours',
        'total_lessons',
        'total_tests',
        'average_rating',
        'total_enrollments',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'featured' => 'boolean',
    ];

    /**
     * Get the teacher that owns the course.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the lessons for the course.
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the enrollments for the course.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the tests for the course.
     */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    /**
     * Get the course folders for the course.
     */
    public function folders(): HasMany
    {
        return $this->hasMany(CourseFolder::class);
    }
}
