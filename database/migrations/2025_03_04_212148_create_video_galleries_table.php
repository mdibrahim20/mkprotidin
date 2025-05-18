<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('video_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title1');
            $table->string('video1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_galleries');
    }
};
