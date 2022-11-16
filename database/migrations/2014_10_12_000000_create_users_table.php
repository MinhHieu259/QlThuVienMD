<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->integer('gender')->default(0);
            $table->string('date_of_birth');
            $table->string('phone');
            $table->string('address');
            $table->string('identification')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('details')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('deleted')->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
