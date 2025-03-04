<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique(); // SEO-friendly URL
            $table->text('description')->nullable(); // Optional category description
            $table->unsignedBigInteger('parent_id')->nullable(); // For nested categories
            $table->string('image')->nullable(); // Optional category image
            $table->boolean('is_active')->default(true); // Enable/disable category
            $table->timestamps();

            // Foreign key for parent category (self-referencing)
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
