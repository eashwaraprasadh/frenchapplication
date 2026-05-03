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
        Schema::create('lesson_content_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->enum('type', ['text', 'image', 'audio', 'video', 'exercise'])->default('text');
            $table->json('content'); // Store content data as JSON for flexibility
            $table->integer('order')->default(0);
            $table->timestamps();

            // MySQL specific indexes
            $table->index(['lesson_id', 'order']);
            $table->index(['lesson_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_content_blocks');
    }
};
