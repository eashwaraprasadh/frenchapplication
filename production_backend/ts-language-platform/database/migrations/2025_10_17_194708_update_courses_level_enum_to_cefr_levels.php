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
        // First, add a temporary column
        Schema::table('courses', function (Blueprint $table) {
            $table->string('level_temp')->nullable();
        });

        // Update data to new CEFR levels in temp column
        DB::table('courses')->where('level', 'beginner')->update(['level_temp' => 'A1']);
        DB::table('courses')->where('level', 'intermediate')->update(['level_temp' => 'B1']);
        DB::table('courses')->where('level', 'advanced')->update(['level_temp' => 'C1']);

        // Drop the old column and rename temp column
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('level');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->enum('level', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'])->default('A1');
        });

        // Copy data from temp column to new level column
        DB::statement('UPDATE courses SET level = level_temp WHERE level_temp IS NOT NULL');

        // Drop the temporary column
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('level_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add temporary column
        Schema::table('courses', function (Blueprint $table) {
            $table->string('level_temp')->nullable();
        });

        // Map CEFR levels back to simple levels in temp column
        DB::table('courses')->whereIn('level', ['A1', 'A2'])->update(['level_temp' => 'beginner']);
        DB::table('courses')->whereIn('level', ['B1', 'B2'])->update(['level_temp' => 'intermediate']);
        DB::table('courses')->whereIn('level', ['C1', 'C2'])->update(['level_temp' => 'advanced']);

        // Drop the CEFR level column
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('level');
        });

        // Recreate with original enum
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
        });

        // Copy data back
        DB::statement('UPDATE courses SET level = level_temp WHERE level_temp IS NOT NULL');

        // Drop temp column
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('level_temp');
        });
    }
};
