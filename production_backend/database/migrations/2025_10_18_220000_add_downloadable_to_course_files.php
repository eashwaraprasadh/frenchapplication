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
        Schema::table('course_files', function (Blueprint $table) {
            $table->boolean('downloadable')->default(true)->after('mime_type');
            $table->boolean('viewable')->default(true)->after('downloadable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_files', function (Blueprint $table) {
            $table->dropColumn(['downloadable', 'viewable']);
        });
    }
};

