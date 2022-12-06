<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_books', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->date('borrowing_day');
            $table->time('borrowing_time');
            $table->date('return_day');
            $table->time('return_time');
            $table->integer('status')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            //
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('borrow_books');
    }
}
