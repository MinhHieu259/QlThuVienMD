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
            $table->string('name')->nullable();
            $table->string('year_publisher')->nullable();
            $table->string('image')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('deleted')->default(null);

            // foreign
            $table->foreign('categories')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('publishers')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('authors')->references('id')->on('authors')->onDelete('cascade');
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
