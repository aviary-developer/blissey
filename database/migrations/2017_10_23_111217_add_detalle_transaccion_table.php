<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetalleTransaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->integer('localizacion')->change();
          //Valores que localización
          //0-Farmacia
          //1-Recepción
          //2-Lab. clínico
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
        //
    }
}
