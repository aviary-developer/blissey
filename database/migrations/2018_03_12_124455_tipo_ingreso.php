<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingresos', function (Blueprint $table) {
            $table->integer('tipo')->default(0);
            /**
             * 0: Ingreso
             * 1: Medi ingreso
             * 2: Observación
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
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
