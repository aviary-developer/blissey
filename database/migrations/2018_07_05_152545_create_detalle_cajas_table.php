<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_caja')->unsigned();
            $table->foreign('f_caja')->references('id')->on('cajas');
            $table->integer('tipo');
            //Valores que localización
            //1-Apertura
            //1-Cierre
            $table->date('fecha');
            $table->integer('importe'); //Para apertura representa el monto inicial y el monto proveniente del día anterior
                                        //Para un cierre representa la salida de efectivo
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
        Schema::dropIfExists('detalle_cajas');
    }
}
