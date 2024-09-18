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
        Schema::create('category_wise_assign_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('section_content_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_wise_assign_videos');
    }
};
