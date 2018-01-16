<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_examens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_muestra',12);
            $table->integer('f_examen')->unsigned();
            $table->foreign('f_examen')->references('id')->on('examens');
            $table->integer('f_paciente')->unsigned();
            $table->foreign('f_paciente')->references('id')->on('pacientes');
            $table->integer('estado');
            /*
             * Estado ------------------------
             * 0: Pendiente
             * 1: Aceptado
             * 2: Realizado
             * 3: Entregado
             */
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
        Schema::dropIfExists('solicitud_examens');
    }
}
