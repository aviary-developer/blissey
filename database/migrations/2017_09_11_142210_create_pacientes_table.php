<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',30);
            $table->string('apellido',30);
            $table->boolean('sexo');
            /*
            Sexo---------------------
            true: Masculino
            false: Femenino
            -------------------------
            */
            $table->string('telefono',9)->nullable();
            $table->text('direccion')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->boolean('estado')->default(true);
            /*
            Estado-------------------
            true: Activo
            false: Inactivo
            -------------------------
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
        Schema::dropIfExists('pacientes');
    }
}
