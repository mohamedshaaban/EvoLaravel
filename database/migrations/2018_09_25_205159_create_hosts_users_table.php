<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->integer('starting_year')->nullable();
            $table->integer('company_certificate')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobile');
            $table->string('whatsapp')->nullable();
            $table->string('work_from');
            $table->string('work_to');
            $table->string('break_from')->nullable();
            $table->string('break_to')->nullable();


            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts_users');
    }
}
