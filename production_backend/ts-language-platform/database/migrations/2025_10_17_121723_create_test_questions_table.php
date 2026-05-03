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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->enum('type', ['mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks']);
            $table->text('question_text');
            $table->string('question_media')->nullable(); // path to audio/video/image file
            $table->json('correct_answer'); // flexible storage for different answer types
            $table->text('explanation')->nullable();
            $table->integer('points')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();

            // MySQL indexes
            $table->index(['test_id', 'order']);
            $table->index(['test_id', 'type']);
            $table->fullText(['question_text']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};
