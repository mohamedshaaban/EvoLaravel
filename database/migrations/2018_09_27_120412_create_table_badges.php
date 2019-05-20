<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('logo');
	        $table->boolean('user_type');
	        $table->boolean('target_gender')->default(0);
            $table->boolean('badge_type');
            $table->unsignedInteger('no_of_transactions_from')->nullable();
            $table->unsignedInteger('no_of_transactions_to')->nullable();
            $table->unsignedInteger('no_eas_from')->nullable();
            $table->unsignedInteger('no_eas_to')->nullable();
            $table->boolean('include_rating')->default(0);
            $table->unsignedInteger('rating_from')->nullable();
            $table->unsignedInteger('rating_to')->nullable();
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
        Schema::table('badges', function (Blueprint $table) {
            //
        });
    }
}
