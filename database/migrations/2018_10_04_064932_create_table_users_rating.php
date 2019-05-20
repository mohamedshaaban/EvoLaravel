<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsersRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('host_id')->references('id')->on('users');
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->text('comment')->nullable();
            $table->integer('rating')->nullable();
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
        Schema::drop('users_ratings', function (Blueprint $table) {
            //
        });
    }
}
