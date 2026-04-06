<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('test_submissions', function (Blueprint $table) {
            $table->text('remarks')->nullable()->after('score');
            $table->string('status')->default('completed')->after('passed'); // pending, completed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_submissions', function (Blueprint $table) {
            $table->dropColumn(['remarks', 'status']);
        });
    }
};
