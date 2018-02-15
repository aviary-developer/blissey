<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitudExamenIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_examens', function (Blueprint $table) {
            $table->integer('f_ingreso')->unsigned()->nullable();
            $table->foreign('f_ingreso')->references('id')->on('ingresos');
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
            $table->dropColumn('f_ingreso');
        });
    }
}
