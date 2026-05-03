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
        Schema::table('tests', function (Blueprint $table) {
            $table->string('type')->default('standard')->after('id'); // 'standard' or 'expression_ecrite'
        });

        // Add word limits to test_questions table
        Schema::table('test_questions', function (Blueprint $table) {
            $table->integer('min_words')->nullable()->after('points');
            $table->integer('max_words')->nullable()->after('min_words');
        });

        // Update the enum to include 'expression_ecrite'
        // We need to be careful with SQLite vs MySQL syntax here.
        // But since the user's previous migration used DB::statement standard syntax, we'll try that.
        // Note: 'expression_ecrite' needs to be added to the enum.

        // This relies on the previous migration being run. 
        // We will just execute a raw statement to modify the column again.
        // Assuming MySQL/MariaDB from the syntax in previous migration.
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq', 'expression_ecrite') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('test_questions', function (Blueprint $table) {
            $table->dropColumn(['min_words', 'max_words']);
        });

        // Revert enum
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq') NOT NULL");
    }
};
