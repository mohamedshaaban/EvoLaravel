<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('logo')->nullable();
            $table->string('num_of_events')->nullable();
            $table->string('num_of_activity')->nullable();
            $table->string('num_of_services')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->integer('status')->default(1);

            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages', function (Blueprint $table) {
            //
        });
    }
}
