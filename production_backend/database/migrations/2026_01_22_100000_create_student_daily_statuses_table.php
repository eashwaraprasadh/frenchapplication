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
        if (!Schema::hasTable('student_daily_statuses')) {
            Schema::create('student_daily_statuses', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->date('log_date');
                $table->text('listening_activity')->nullable();
                $table->text('reading_activity')->nullable();
                $table->text('speaking_activity')->nullable();
                $table->text('writing_activity')->nullable();
                $table->text('extra_activity')->nullable();
                $table->timestamps();

                // Ensure one entry per student per day
                $table->unique(['user_id', 'log_date']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_daily_statuses');
    }
};
