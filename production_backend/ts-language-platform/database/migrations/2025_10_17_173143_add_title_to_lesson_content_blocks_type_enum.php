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
        // Add 'title' to the existing ENUM values
        DB::statement("ALTER TABLE lesson_content_blocks MODIFY COLUMN type ENUM('title','text','image','audio','video','exercise')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'title' from the ENUM values
        DB::statement("ALTER TABLE lesson_content_blocks MODIFY COLUMN type ENUM('text','image','audio','video','exercise')");
    }
};
