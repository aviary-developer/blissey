<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregandoUltrayRayosXaSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_examens', function (Blueprint $table) {
          $table->integer('f_ultrasonografia')->unsigned()->nullable();
          $table->foreign('f_ultrasonografia')->references('id')->on('ultrasonografias');
          $table->integer('f_rayox')->unsigned()->nullable();
          $table->foreign('f_rayox')->references('id')->on('rayosxes');
          $table->integer('f_examen')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_examens', function (Blueprint $table) {
          $table->dropColumn('f_ultrasonografia');
          $table->dropColumn('f_rayox');
          $table->integer('f_examen')->unsigned();
          $table->foreign('f_examen')->references('id')->on('examens');
        });
    }
}
