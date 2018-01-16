<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioFarmaciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_farmacias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_producto')->unsigned()->nullable();
            $table->foreign('f_producto')->references('id')->on('division_productos');
            $table->boolean('tipo');
            //1 - Ingreso / 0 - Egreso
            $table->integer('existencia_anterior');
            $table->integer('cantidad');
            $table->integer('existencia_nueva');
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
        Schema::dropIfExists('inventario_farmacias');
    }
}
