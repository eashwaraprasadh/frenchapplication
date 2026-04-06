<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add type column to tests table
        if (!Schema::hasColumn('tests', 'type')) {
            Schema::table('tests', function (Blueprint $table) {
                $table->string('type')->default('standard')->after('id');
            });
        }

        // Add word limits to test_questions table
        if (!Schema::hasColumn('test_questions', 'min_words')) {
            Schema::table('test_questions', function (Blueprint $table) {
                $table->integer('min_words')->nullable()->after('points');
                $table->integer('max_words')->nullable()->after('min_words');
            });
        }

        // Update the enum to include 'expression_ecrite' (MySQL only)
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq', 'expression_ecrite') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('tests', 'type')) {
            Schema::table('tests', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }

        if (Schema::hasColumn('test_questions', 'min_words')) {
            Schema::table('test_questions', function (Blueprint $table) {
                $table->dropColumn(['min_words', 'max_words']);
            });
        }

        // Revert enum (MySQL only)
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq') NOT NULL");
        }
    }
};
