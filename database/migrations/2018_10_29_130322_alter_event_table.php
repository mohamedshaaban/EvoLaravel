<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('event', function (Blueprint $table) {
		    $table->integer('location_id')->unsigned();
		    $table->integer('venue_id')->unsigned();
		    $table->integer('cols')->unsigned();
		    $table->string('rows');
		    $table->string('seat_map_img')->nullable();
		    $table->text('seat_map_data')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('event', function (Blueprint $table) {
		    $table->dropColumn('location_id');
		    $table->dropColumn('venue_id');
		    $table->dropColumn('cols');
		    $table->dropColumn('rows');
	    });
    }
}
