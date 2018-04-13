<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UltrasRayosxServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicios', function (Blueprint $table) {
          $table->integer('f_ultrasonografia')->unsigned()->nullable();
          $table->foreign('f_ultrasonografia')->references('id')->on('ultrasonografias');
          $table->integer('f_rayox')->unsigned()->nullable();
          $table->foreign('f_rayox')->references('id')->on('rayosxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicios', function (Blueprint $table) {
          $table->dropColumn('f_ultrasonografia');
          $table->dropColumn('f_rayox');
        });
    }
}
