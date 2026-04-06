<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContentPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'content_type',
        'content_id',
        'has_access',
        'granted_by',
        'granted_at',
    ];

    protected $casts = [
        'has_access' => 'boolean',
        'granted_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

