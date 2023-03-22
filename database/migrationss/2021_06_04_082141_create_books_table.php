<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->nullable();
            $table->integer('categoryId')->nullable();
            $table->integer('subCategoryId')->nullable();
            $table->integer('languageId')->nullable();
            $table->integer('countryId');
            $table->string('name')->nullable();
            $table->float('price')->nullable();
            $table->string('date')->nullable();
            $table->string('pages')->nullable();
            $table->string('licensing_authority')->nullable();
            $table->string('isbn_num')->nullable();
            $table->string('license_number')->nullable();
            $table->string('License_year')->nullable();

            
            $table->text('description')->nullable();
            $table->text('photo')->nullable();
            $table->text('file')->nullable();
            $table->integer('status')->default(0);
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable(); 
            $table->text('slug')->nullable();
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
        Schema::dropIfExists('books');
    }
}
