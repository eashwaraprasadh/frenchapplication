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
        // Update the ENUM to include new question types
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq','mcq_image','video','image_mcq','fill_blanks','audio','drag_drop','text_input')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original ENUM values
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq','mcq_image','audio','video','drag_drop','text_input','fill_blanks')");
    }
};
