<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddedCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('added_company', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name_en');
	        $table->string('name_ar');
	        $table->string('img')->nullable();
	        $table->boolean('status');
	        $table->integer('added_by');
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
        Schema::dropIfExists('added_company');
    }
}
