<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_content_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->enum('content_type', ['folder', 'lesson', 'test', 'file']);
            $table->unsignedBigInteger('content_id');
            $table->boolean('has_access')->default(true);
            $table->unsignedBigInteger('granted_by')->nullable();
            $table->timestamp('granted_at')->nullable();
            $table->timestamps();

            $table->index(['student_id', 'course_id']);
            $table->index(['content_type', 'content_id']);
            $table->unique(['student_id', 'course_id', 'content_type', 'content_id'], 'uniq_student_course_content');

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('granted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_content_permissions');
    }
};

