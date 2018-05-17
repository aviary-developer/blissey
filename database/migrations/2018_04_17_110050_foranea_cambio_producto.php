<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForaneaCambioProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cambio_productos', function (Blueprint $table) {
        $table->integer('f_detalle_transaccion')->unsigned();
        $table->foreign('f_detalle_transaccion')->references('id')->on('detalle_transacions');
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
