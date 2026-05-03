<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->decimal('progress_percentage', 5, 2)->default(0.00);
            $table->enum('status', ['active', 'completed', 'paused', 'cancelled'])->default('active');
            $table->enum('payment_status', ['free', 'paid', 'pending', 'failed'])->default('free');
            $table->decimal('payment_amount', 8, 2)->default(0.00);
            $table->string('payment_method')->nullable();
            $table->timestamp('certificate_issued_at')->nullable();
            $table->integer('total_time_spent')->default(0); // in minutes
            $table->timestamps();

            // MySQL specific indexes and constraints
            $table->unique(['user_id', 'course_id']); // Prevent duplicate enrollments
            $table->index(['user_id', 'progress_percentage']);
            $table->index(['course_id', 'enrolled_at']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
