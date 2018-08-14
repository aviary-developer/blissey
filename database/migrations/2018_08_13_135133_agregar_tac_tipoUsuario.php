<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTacTipoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('tipoUsuario');
      });
        Schema::table('users', function (Blueprint $table) {
          $table->enum('tipoUsuario',array('Administración','Gerencia','Médico','Recepción','Laboaratorio','Ultrasonografía','Rayos X','Farmacia','Enfermería','TAC'));
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
