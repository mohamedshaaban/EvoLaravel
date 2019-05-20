<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('event', function (Blueprint $table) {
		    $table->time('break_from')->nullable();
		    $table->time('break_to')->nullable();
		    $table->tinyInteger('gender');
		    $table->boolean('attendees_listing')->default(1);
		    $table->boolean('use_seatmap')->default(1);
		    $table->boolean('seating_booking_type');
		    $table->tinyInteger('booking_per_user');
		    $table->string('qr_code')->default('');
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
		    $table->dropColumn('break_from');
		    $table->dropColumn('break_to');
		    $table->dropColumn('gender');
		    $table->dropColumn('attendees_listing');
		    $table->dropColumn('seating_booking_type');
		    $table->dropColumn('use_seatmap');
		    $table->dropColumn('booking_per_user');
		    $table->dropColumn('qr_code');
	    });
    }
}
