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
            $table->unsignedBigInteger('courseId');
            $table->foreign('courseId')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('chapterId');
            $table->foreign('chapterId')->references('id')->on('chapters')->onDelete('cascade');
            $table->text('name'); 
            $table->text('url');            
            $table->timestamps();
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
