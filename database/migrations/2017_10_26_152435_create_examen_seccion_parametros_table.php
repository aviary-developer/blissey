<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenSeccionParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_seccion_parametros', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('f_examen')->unsigned();
          $table->integer('f_seccion')->unsigned();
          $table->integer('f_parametro')->unsigned();
          $table->foreign('f_examen')->references('id')->on('examens');
          $table->foreign('f_seccion')->references('id')->on('seccions');
          $table->foreign('f_parametro')->references('id')->on('parametros');
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
        Schema::dropIfExists('examen_seccion_parametros');
    }
}
