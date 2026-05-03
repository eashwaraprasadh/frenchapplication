<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add column if it doesn't exist
        if (!Schema::hasColumn('student_test_attempts', 'time_taken')) {
            Schema::table('student_test_attempts', function (Blueprint $table) {
                $table->integer('time_taken')->nullable()->after('passed');
            });
        }

        // 2. Backfill data from test_submissions
        // We match on student_id, test_id, and attempt_number (if available) or approximate timestamp

        $submissions = DB::table('test_submissions')
            ->whereNotNull('time_taken')
            ->select('student_id', 'test_id', 'attempt_number', 'time_taken')
            ->get();

        foreach ($submissions as $submission) {
            DB::table('student_test_attempts')
                ->where('student_id', $submission->student_id)
                ->where('test_id', $submission->test_id)
                ->where('attempt_number', $submission->attempt_number)
                ->update(['time_taken' => $submission->time_taken]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('student_test_attempts', 'time_taken')) {
            Schema::table('student_test_attempts', function (Blueprint $table) {
                $table->dropColumn('time_taken');
            });
        }
    }
};
