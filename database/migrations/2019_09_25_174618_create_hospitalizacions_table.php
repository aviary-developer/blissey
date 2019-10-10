<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitalizacions', function (Blueprint $table) {
						$table->increments('id');
						$table->datetime('fecha_entrada');
						$table->datetime('fecha_salida')->nullable();
						$table->integer('f_paciente')->unsigned();
						$table->foreign('f_paciente')->references('id')->on('pacientes');
						$table->integer('f_responsable')->unsigned();
						$table->foreign('f_responsable')->references('id')->on('pacientes')->nullable();
						$table->integer('f_medico')->unsigned();
						$table->foreign('f_medico')->references('id')->on('users');
						$table->integer('expediente');
						$table->boolean('estado')->default(1);
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
        Schema::dropIfExists('hospitalizacions');
    }
}
