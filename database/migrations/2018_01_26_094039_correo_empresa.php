<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorreoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('correo_hospital')->nullable();
            $table->string('correo_laboratorio')->nullable();
            $table->string('correo_clinica')->nullable();
            $table->string('correo_farmacia')->nullable();
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
            $table->dropColumn('correo_hospital');
            $table->dropColumn('correo_laboratorio');
            $table->dropColumn('correo_clinica');
            $table->dropColumn('correo_farmacia');
        });
    }
}
