<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('main_type_id');
	        $table->integer('host_id');
	        $table->string('title_en');
	        $table->string('title_ar');
	        $table->text('description_en')->nullable();
	        $table->text('description_ar')->nullable();
	        $table->integer('category_id');
	        $table->integer('age_from')->nullable();
	        $table->integer('age_to')->nullable();
	        $table->date('date_from');
	        $table->date('date_to');
	        $table->time('time_from');
	        $table->time('time_to');
	        $table->string('location_name_en');
	        $table->string('location_name_ar');
	        $table->string('address_lat');
	        $table->string('address_long');
	        $table->string('address_text')->nullable();
	        $table->integer('address_type');
	        $table->integer('address_city');
	        $table->string('address_block')->nullable();
	        $table->string('address_street');
	        $table->string('address_avenue')->nullable();
	        $table->string('address_building');
	        $table->string('address_floor')->nullable();
	        $table->boolean('private_event');
	        $table->boolean('cancellation');
	        $table->tinyInteger('cancellation_days');
	        $table->tinyInteger('capacity');
	        $table->decimal('fee', 10, 3);
	        $table->boolean('multi_price');
	        $table->boolean('group_price');
	        $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('event');
    }
}
