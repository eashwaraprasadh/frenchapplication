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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('folder_id')->nullable()->constrained('course_folders')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('passing_score')->default(70); // percentage
            $table->integer('max_attempts')->default(3);
            $table->integer('time_limit')->nullable(); // in minutes
            $table->boolean('randomize_questions')->default(false);
            $table->boolean('show_answers')->default(true);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->integer('total_questions')->default(0);
            $table->timestamps();

            // MySQL indexes
            $table->index(['course_id', 'folder_id']);
            $table->index(['course_id', 'status']);
            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
