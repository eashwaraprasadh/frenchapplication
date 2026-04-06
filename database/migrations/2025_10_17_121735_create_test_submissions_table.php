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
        Schema::create('test_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->decimal('score', 5, 2)->default(0.00); // percentage score
            $table->boolean('passed')->default(false);
            $table->timestamp('submitted_at')->useCurrent();
            $table->json('answers'); // Store all answers as JSON
            $table->integer('time_taken')->nullable(); // in minutes
            $table->integer('attempt_number')->default(1);
            $table->timestamps();

            // MySQL specific indexes
            $table->index(['student_id', 'test_id', 'submitted_at']);
            $table->index(['test_id', 'passed']);
            $table->index(['student_id', 'passed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_submissions');
    }
};
