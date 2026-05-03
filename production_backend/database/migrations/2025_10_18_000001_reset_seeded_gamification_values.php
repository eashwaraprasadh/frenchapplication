<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Reset known seeded accounts to default gamification values
        DB::table('users')->where('email', 'student@gmail.com')->update([
            'points' => 0,
            'level' => 1,
            'current_streak' => 0,
            'longest_streak' => 0,
            'total_study_time' => 0,
        ]);

        // Optionally reset teacher/demo account if present
        DB::table('users')->where('email', 'teacher@gmail.com')->update([
            'points' => 0,
            'level' => 1,
            'current_streak' => 0,
            'longest_streak' => 0,
            'total_study_time' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: we won't attempt to restore prior values
    }
};
