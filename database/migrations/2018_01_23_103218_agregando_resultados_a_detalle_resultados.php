<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregandoResultadosADetalleResultados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_resultados', function (Blueprint $table) {
            $table->string('resultado')->nullable();
            $table->integer('dato_controlado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_resultados', function (Blueprint $table) {
            $table->dropColumn('resultado');
            $table->dropColumn('dato_controlado');
        });
    }
}
