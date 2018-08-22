<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescripcionReactivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descripcion_reactivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anterior');
            $table->double('movimiento');
            $table->integer('posterior');
            $table->text('descripcionExistencias');
            $table->integer('f_reactivo')->unsigned()->nullable();
            $table->foreign('f_reactivo')->references('id')->on('reactivos');
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
        Schema::dropIfExists('descripcion_reactivos');
    }
}
