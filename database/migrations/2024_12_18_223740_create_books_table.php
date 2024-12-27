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
            $table->string('title', 255);
            $table->string('classification', 255);
            $table->string('shelf', 100);
            $table->string('edition', 50);
            $table->integer('quantity')->unsigned()->default(0);
            $table->integer('year')->unsigned();
            $table->string('country');
            $table->string('city');
            $table->integer('page_count')->unsigned();
            $table->string('language', 50);
            $table->string('isbn', 17)->unique()->nullable();
            $table->text('observations', 50)->nullable();
            $table->date('entry_date')->nullable();
            $table->date('tomb_date')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->unsignedBigInteger('book_type_id');

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('restrict');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('restrict');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('restrict');
            $table->foreign('book_type_id')->references('id')->on('book_types')->onDelete('restrict');
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

