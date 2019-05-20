<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMultiplePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_multiple_price', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('event_id');
	        $table->string('name_en');
	        $table->string('name_ar');
	        $table->decimal('cost', 10, 3);
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
        Schema::dropIfExists('event_multiple_price');
    }
}
