<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDailyStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'log_date' => 'date'
    ];

    public function topics()
    {
        return $this->hasMany(StudentDailyTopic::class, 'student_daily_status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper to calculate total time from topics if needed, 
    // though we might store it in the total_time column for caching/performance
    public function recalculateTotalTime()
    {
        // Logic to sum up durations could go here
    }
}
