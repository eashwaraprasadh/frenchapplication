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
        // Add expression_ecrite to ENUM
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq', 'expression_ecrite') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: Reverting this might fail if there are 'expression_ecrite' questions. 
        // We generally don't revert adding valid enum values unless necessary.
        // For safety, we keep the new enum list or just omit strict revert if data loss is improved.
        // But to be strictly correct with previous state:
        DB::statement("ALTER TABLE test_questions MODIFY COLUMN type ENUM('mcq', 'mcq_image', 'audio', 'video', 'drag_drop', 'text_input', 'fill_blanks', 'image_mcq', 'image_audio_mcq', 'passage_mcq') NOT NULL");
    }
};
