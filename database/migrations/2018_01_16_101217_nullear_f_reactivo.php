<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullearFReactivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examen_seccion_parametros', function (Blueprint $table) {
          $table->integer('f_reactivo')->unsigned()->nullable();
          $table->foreign('f_reactivo')->references('id')->on('reactivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examen_seccion_parametros', function (Blueprint $table) {
            //
        });
    }
}
