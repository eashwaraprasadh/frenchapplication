<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'phone',
        'date_of_birth',
        'language_level',
        'learning_goals',
        'preferences',
        'status',
        'last_login_at',
        'total_study_time',
        'current_streak',
        'longest_streak',
        'points',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'last_login_at' => 'datetime',
            'preferences' => 'array',
            'learning_goals' => 'array',
            'total_study_time' => 'integer',
            'current_streak' => 'integer',
            'longest_streak' => 'integer',
            'points' => 'integer',
            'level' => 'integer',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is teacher
     */
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Get user's enrolled courses
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get user's courses (for teachers)
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    /**
     * Get user's lesson progress
     */
    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class, 'student_id');
    }

    /**
     * Get user's test submissions
     */
    public function testSubmissions()
    {
        return $this->hasMany(TestSubmission::class);
    }

    /**
     * Get user's achievements
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    /**
     * Get user's bookmarks
     */
    public function bookmarks()
    {
        return $this->hasMany(LessonBookmark::class);
    }

    /**
     * Get user's admin logs (for admins)
     */
    public function adminLogs()
    {
        return $this->hasMany(AdminLog::class);
    }

    /**
     * Get user's avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get user's initials
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return substr($initials, 0, 2);
    }

    /**
     * Get user's progress percentage
     */
    public function getProgressPercentageAttribute()
    {
        $totalLessons = $this->enrollments()
            ->with('course.lessons')
            ->get()
            ->pluck('course.lessons')
            ->flatten()
            ->count();

        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = $this->lessonProgress()
            ->where('status', 'completed')
            ->count();

        return round(($completedLessons / $totalLessons) * 100);
    }
}
