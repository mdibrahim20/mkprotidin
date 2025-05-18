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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // SEO-friendly URL
            $table->text('content');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Journalist/Admin
            
            $table->string('image')->nullable(); // Image path storage
            $table->text('meta_title')->nullable(); // SEO meta title
            $table->text('meta_description')->nullable(); // SEO meta description
            $table->integer('views')->default(0);
            $table->enum('status', ['pending', 'published', 'inactive'])->default('pending');
            $table->timestamp('published_at')->nullable(); // Schedule articles

            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('tag_id');
        
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
        });
    
        Schema::dropIfExists('articles');
    }
};


