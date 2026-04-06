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
        // Only add column if it doesn't already exist
        if (!Schema::hasColumn('test_questions', 'passage')) {
            Schema::table('test_questions', function (Blueprint $table) {
                $table->text('passage')->nullable()->after('question_text');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('test_questions', 'passage')) {
            Schema::table('test_questions', function (Blueprint $table) {
                $table->dropColumn('passage');
            });
        }
    }
};

