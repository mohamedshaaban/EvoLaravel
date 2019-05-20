<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventGroupPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_group_price', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('event_id');
	        $table->unsignedInteger('price_type_id');
	        $table->integer('ticket_no');
	        $table->decimal('price', 10, 3);
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
        Schema::dropIfExists('event_group_price');
    }
}
