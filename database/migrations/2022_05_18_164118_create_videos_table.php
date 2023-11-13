<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('video_url');
            $table->text('description')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('series_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->foreignId('reference_video_id')->nullable();
            $table->string('class_number')->nullable();
            $table->string('tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
