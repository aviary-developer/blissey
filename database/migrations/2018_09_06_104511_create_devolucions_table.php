<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_detalle_transaccion')->unsigned();
            $table->foreign('f_detalle_transaccion')->references('id')->on('detalle_transacions');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->string('justificacion');
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
        Schema::dropIfExists('devolucions');
    }
}
