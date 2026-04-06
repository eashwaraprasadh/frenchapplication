<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Include all existing types plus the new 'document' (MySQL only)
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE lesson_content_blocks MODIFY COLUMN type ENUM('title','text','image','audio','video','exercise','document')");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert by removing 'document' (MySQL only)
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE lesson_content_blocks MODIFY COLUMN type ENUM('title','text','image','audio','video','exercise')");
        }
    }
};

