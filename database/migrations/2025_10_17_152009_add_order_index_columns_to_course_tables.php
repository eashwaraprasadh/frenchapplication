<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add order_index column to course_folders table
        Schema::table('course_folders', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('name');
            $table->text('description')->nullable()->after('name');
        });

        // Add missing columns to lessons table
        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('estimated_time');
            $table->string('lesson_type')->default('content')->after('status');
            $table->integer('duration')->nullable()->after('estimated_time'); // Add duration column
        });

        // Add order_index column to tests table
        Schema::table('tests', function (Blueprint $table) {
            $table->integer('order_index')->default(0)->after('total_questions');
            $table->integer('duration')->nullable()->after('time_limit'); // Add duration column for consistency
        });

        // Copy data from 'order' to 'order_index' columns
        DB::statement('UPDATE course_folders SET order_index = `order`');
        DB::statement('UPDATE lessons SET order_index = `order`');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_folders', function (Blueprint $table) {
            $table->dropColumn(['order_index', 'description']);
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn(['order_index', 'lesson_type', 'duration']);
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn(['order_index', 'duration']);
        });
    }
};
