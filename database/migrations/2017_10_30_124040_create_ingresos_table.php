<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha_ingreso');
            $table->datetime('fecha_alta')->nullable();
            $table->integer('f_paciente')->unsigned();
            $table->integer('f_responsable')->unsigned();
            $table->integer('f_medico')->unsigned();
            $table->integer('f_habitacion')->unsigned();
            $table->foreign('f_paciente')->references('id')->on('pacientes');
            $table->foreign('f_responsable')->references('id')->on('pacientes');
            $table->foreign('f_medico')->references('id')->on('users');
            $table->foreign('f_habitacion')->references('id')->on('habitacions');
            $table->boolean('estado')->default(true);
            /*
            Estado---------------
            true: Ingresado
            false: de alta
            ---------------------
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
        Schema::dropIfExists('ingresos');
    }
}
