<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleDevolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_devolucions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_devolucion')->unsigned();
            $table->foreign('f_devolucion')->references('id')->on('devolucions');
            $table->integer('f_detalle_transaccion')->unsigned();
            $table->foreign('f_detalle_transaccion')->references('id')->on('detalle_transacions');
            $table->integer('cantidad');
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
        Schema::dropIfExists('detalle_devolucions');
    }
}
