<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCodigosEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('codigo_hospital')->nullable();
            $table->string('codigo_clinica')->nullable();
            $table->string('codigo_laboratorio')->nullable();
            $table->string('codigo_farmacia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('codigo_hospital')->nullable();
            $table->string('codigo_clinica')->nullable();
            $table->string('codigo_laboratorio')->nullable();
            $table->string('codigo_farmacia')->nullable();
        });
    }
}
