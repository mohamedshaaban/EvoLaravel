<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reporter_id')->references('id')->on('users');
            $table->unsignedInteger('event_id')->references('id')->on('event');
            $table->text('problem');
            $table->integer('status')->default(0);
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
        Schema::table('report_event', function (Blueprint $table) {
            //
        });
    }
}
