<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadoDetalleTransaccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_transacions', function (Blueprint $table) {
            $table->boolean('estado')->default(true);
            /**
             * Estado
             * 0: Inactivo
             * 1: Activo
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
        Schema::table('detalle_transacions', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
