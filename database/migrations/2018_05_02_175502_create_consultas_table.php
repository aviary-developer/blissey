<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('motivo')->nullable();
            $table->text('historia')->nullable();
            $table->text('examen_fisico')->nullable();
            $table->text('diagnostico')->nullable();
            $table->integer('resumen')->default(2);
            /**
             * 0: Excelente
             * 1: Bien
             * 2: Estable
             * 3: Mal
             * 4: Critico
             */
            $table->date('cita')->nullable();
            $table->integer('f_ingreso')->unsigned();
            $table->foreign('f_ingreso')->references('id')->on('ingresos');
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
        Schema::dropIfExists('consultas');
    }
}
