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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('price');
            $table->string('level')->enum('beginner','intermediate','advanced');
            $table->integer('instructor_id')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->string('duration');
            $table->string('resource')->nullable();
            $table->string('prerequisite')->nullable();
            $table->boolean('certificate')->default(true);
            $table->string('image')->nullable();
            $table->boolean('FOC')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
