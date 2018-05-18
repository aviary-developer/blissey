<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('factura',10);
            $table->integer('f_cliente')->unsigned()->nullable();
            $table->integer('f_proveedor')->unsigned()->nullable();
            $table->double('descuento')->dafault(0);
            $table->boolean('tipo');
            //1 - Ingreso / 0 - Egreso
            $table->integer('f_usuario')->unsigned()->nullable();
            $table->boolean('localizacion');
            //1 - Recepcion / 0 - Farmacia
            $table->foreign('f_cliente')->references('id')->on('pacientes');
            $table->foreign('f_proveedor')->references('id')->on('proveedors');
            $table->foreign('f_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('transacions');
    }
}
