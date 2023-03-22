<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

   

    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('instructors')->onDelete('cascade');
            $table->integer('categoryId');
            $table->integer('subCategoryId');
            $table->integer('childCategoryId');
            $table->integer('languageId');
            $table->string('title')->nullable();
            $table->string('level')->nullable();
            $table->text('short_detail')->nullable();
            $table->text('detail')->nullable();
            $table->text('requirement')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('date')->nullable();                
            $table->text('image')->nullable();
            $table->text('slug')->nullable();
            $table->integer('status')->default(0);
            $table->integer('duration')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable(); 
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
        Schema::dropIfExists('courses');
    }
}
