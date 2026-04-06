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
        Schema::table('users', function (Blueprint $table) {
            // Add role column with enum values
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student')->after('email');

            // Add profile fields
            $table->string('avatar')->nullable()->after('password');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('phone', 20)->nullable()->after('bio');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('language_level', ['beginner', 'elementary', 'intermediate', 'upper_intermediate', 'advanced'])->nullable()->after('date_of_birth');
            $table->json('learning_goals')->nullable()->after('language_level');
            $table->json('preferences')->nullable()->after('learning_goals');

            // Add status and verification fields
            $table->enum('status', ['active', 'pending', 'suspended', 'banned'])->default('active')->after('preferences');
            $table->timestamp('last_login_at')->nullable()->after('status');

            // Add learning progress fields
            $table->integer('total_study_time')->default(0)->after('last_login_at'); // in minutes
            $table->integer('current_streak')->default(0)->after('total_study_time');
            $table->integer('longest_streak')->default(0)->after('current_streak');
            $table->integer('points')->default(0)->after('longest_streak');
            $table->integer('level')->default(1)->after('points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'avatar', 'bio', 'phone', 'date_of_birth', 'language_level',
                'learning_goals', 'preferences', 'status', 'last_login_at',
                'total_study_time', 'current_streak', 'longest_streak', 'points', 'level'
            ]);
        });
    }
};
