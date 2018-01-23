<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_resultados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_resultado')->unsigned();
            $table->foreign('f_resultado')->references('id')->on('resultados');
            $table->integer('f_espr')->unsigned();//espr= Examen Seccion Parametro Reactivos
            $table->foreign('f_espr')->references('id')->on('examen_seccion_parametros');
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
        Schema::dropIfExists('detalle_resultados');
    }
}
