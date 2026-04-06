<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_collection_id')->nullable();
            $table->integer('order_index')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('parent_collection_id')
                ->references('id')->on('course_collections')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_collections');
    }
};

