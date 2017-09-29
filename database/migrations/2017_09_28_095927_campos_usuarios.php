<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombre',40);
            $table->string('apellido',40);
            $table->text('direccion');
            $table->date('fechaNacimiento');
            $table->string('dui',10);
            $table->boolean('sexo');
            /*
            Sexo---------------------
            true: Masculino
            false: Femenino
            -------------------------
            */
            $table->enum('tipoUsuario',array('Administración','Gerencia','Médico','Recepción','Laboaratorio','Ultrasonografía','Rayos X','Farmacia','Enfermería'));
            $table->string('juntaVigilancia')->nullable();
            $table->boolean('estado')->defaul(true);
            /*
            Estado-------------------
            true: Activo
            false: Inactivo
            -------------------------
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
