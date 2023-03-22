<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_categories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('categoryId');
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subCategoryId');
            $table->foreign('subCategoryId')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->string('title' )->nullable();
            $table->string('icon')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(0);
            $table->integer('top')->default(0);
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
        Schema::dropIfExists('child_categories');
    }
}
