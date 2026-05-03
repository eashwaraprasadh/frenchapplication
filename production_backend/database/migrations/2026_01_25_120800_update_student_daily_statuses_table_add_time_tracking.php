<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_daily_statuses', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn([
                'listening_activity',
                'speaking_activity',
                'reading_activity',
                'writing_activity',
                'extra_activity'
            ]);

            // Add new columns
            $table->text('starting_time')->nullable();
            $table->text('ending_time')->nullable();
            $table->text('topics_learned')->nullable();
            $table->text('total_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_daily_statuses', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn([
                'starting_time',
                'ending_time',
                'topics_learned',
                'total_time'
            ]);

            // Add old columns back
            $table->text('listening_activity')->nullable();
            $table->text('reading_activity')->nullable();
            $table->text('speaking_activity')->nullable();
            $table->text('writing_activity')->nullable();
            $table->text('extra_activity')->nullable();
        });
    }
};
