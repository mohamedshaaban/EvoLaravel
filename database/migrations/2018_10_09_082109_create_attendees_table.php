<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'attendees', function ( Blueprint $table ) {
			$table->increments( 'id' );

			$table->unsignedInteger( 'booking_id' );
			$table->unsignedInteger( 'event_id' );
			$table->unsignedInteger( 'ticket_type' );
			$table->string( 'seat_no', 10 )->default( '' );
			$table->string( 'seat_id', 15 )->default( '' );
			$table->string( 'name' );
			$table->string( 'email' );
			$table->string( 'qr' )->default( '' );
			$table->string( 'mobile' );
			$table->boolean( 'status' )->default( 0 );
			$table->date( 'canceled_at' )->nullable();
			$table->date( 'arrived_at' )->nullable();

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'attendees' );
	}
}
