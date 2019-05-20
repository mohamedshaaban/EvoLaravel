<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHostuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hosts_users', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('sponsored')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hosts_users', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('location');
            $table->dropColumn('sponsored');
        });
    }
}
