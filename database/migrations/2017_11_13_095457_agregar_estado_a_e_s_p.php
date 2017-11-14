<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarEstadoAESP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examen_seccion_parametros', function (Blueprint $table) {
          $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examen_seccion_parametros', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
