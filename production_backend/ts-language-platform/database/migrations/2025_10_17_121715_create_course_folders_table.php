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
        Schema::create('course_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('parent_folder_id')->nullable()->constrained('course_folders')->onDelete('cascade');
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();

            // MySQL specific indexes
            $table->index(['course_id', 'parent_folder_id']);
            $table->index(['course_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_folders');
    }
};
