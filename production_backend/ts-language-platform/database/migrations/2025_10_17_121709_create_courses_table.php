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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('language', 50)->default('french');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->string('thumbnail')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->integer('duration_hours')->default(0);
            $table->integer('total_lessons')->default(0);
            $table->integer('total_tests')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('total_enrollments')->default(0);
            $table->timestamps();

            // MySQL indexes
            $table->index(['status', 'language']);
            $table->index(['teacher_id', 'status']);
            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
