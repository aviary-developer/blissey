<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignoVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signo_vitals', function (Blueprint $table) {
            $table->increments('id');
            $table->double('temperatura')->nullable();
            $table->integer('sistole')->nullable();
            $table->integer('diastole')->nullable();
            $table->integer('pulso')->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->integer('frecuencia_respiratoria')->nullable();
            $table->double('peso')->nullable();
            $table->boolean('medida')->default(true);
            /**
             * 0: Libras
             * 1: Kilogramos
             */
            $table->double('glucosa')->nullable();
            $table->integer('altura')->nullable();
            $table->integer('f_ingreso')->unsigned()->nullable();
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
        Schema::dropIfExists('signo_vitals');
    }
}
