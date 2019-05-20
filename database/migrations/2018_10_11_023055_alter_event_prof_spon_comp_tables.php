<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventProfSponCompTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_professional', function(Blueprint $table){
        	$table->boolean('connection')->default('1');
        });

        Schema::table('event_sponsor', function(Blueprint $table){
        	$table->boolean('connection')->default('1');
        });

        Schema::table('event_company', function(Blueprint $table){
        	$table->boolean('connection')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

	    Schema::table('event_professional', function(Blueprint $table){
		    $table->dropColumn('connection');
	    });

	    Schema::table('event_sponsor', function(Blueprint $table){
		    $table->dropColumn('connection');
	    });

	    Schema::table('event_company', function(Blueprint $table){
		    $table->dropColumn('connection');
	    });
    }
}
