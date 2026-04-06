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
        // Backfill existing NULL values to sensible defaults
        DB::table('users')->whereNull('total_study_time')->update(['total_study_time' => 0]);
        DB::table('users')->whereNull('current_streak')->update(['current_streak' => 0]);
        DB::table('users')->whereNull('longest_streak')->update(['longest_streak' => 0]);
        DB::table('users')->whereNull('points')->update(['points' => 0]);
        DB::table('users')->whereNull('level')->update(['level' => 1]);

        // Set database defaults for these columns (if supported by the platform)
        Schema::table('users', function (Blueprint $table) {
            // Use change() to alter column defaults; note: this may require doctrine/dbal on some setups.
            $table->integer('total_study_time')->default(0)->change();
            $table->integer('current_streak')->default(0)->change();
            $table->integer('longest_streak')->default(0)->change();
            $table->integer('points')->default(0)->change();
            $table->integer('level')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to no default (nullable) - be conservative and leave values as-is
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_study_time')->default(0)->change();
            $table->integer('current_streak')->default(0)->change();
            $table->integer('longest_streak')->default(0)->change();
            $table->integer('points')->default(0)->change();
            $table->integer('level')->default(1)->change();
        });
    }
};
