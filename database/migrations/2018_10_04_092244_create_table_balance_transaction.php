<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBalanceTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_package_id')->references('id')->on('packages')->nullable();
            $table->unsignedInteger('use_eas_id')->references('id')->on('eas_price')->nullable();
            $table->string('purchase_date');
            $table->string('duration_date');
            $table->string('number_of_events');
            $table->string('number_of_activity');
            $table->string('number_of_services');
            $table->string('total');

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
        Schema::drop('balance_transaction', function (Blueprint $table) {
            //
        });
    }
}
