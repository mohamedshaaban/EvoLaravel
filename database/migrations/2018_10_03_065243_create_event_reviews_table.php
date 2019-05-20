<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event-reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->references('id')->on('event');
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
        Schema::drop('event-reviews', function (Blueprint $table) {
            //
        });
    }
}
