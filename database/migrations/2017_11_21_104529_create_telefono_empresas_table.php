<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonoEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefono_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('telefono',9);
            $table->enum('tipo',array('hospital','farmacia','laboratorio','clinica'));
            $table->integer('f_empresa')->unsigned();
            $table->foreign('f_empresa')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefono_empresas');
    }
}
