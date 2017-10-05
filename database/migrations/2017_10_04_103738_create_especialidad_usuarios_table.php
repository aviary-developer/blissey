<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidad_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('principal');
            /*
            Principal-------------------
            true: Especialidad
            false: Subespecialidad
            -------------------------
            */
            $table->integer('f_especialidad')->unsigned();
            $table->foreign('f_especialidad')->references('id')->on('especialidads');
            $table->integer('f_usuario')->unsigned();
            $table->foreign('f_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidad_usuarios');
    }
}
