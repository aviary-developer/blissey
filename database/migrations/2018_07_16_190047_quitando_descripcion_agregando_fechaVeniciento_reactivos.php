<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuitandoDescripcionAgregandoFechaVenicientoReactivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reactivos', function (Blueprint $table) {
            $table->dropColumn('descripcion');
        });
        Schema::table('reactivos', function (Blueprint $table) {
            $table->date('fechaVencimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reactivos', function (Blueprint $table) {
            $table->string('descripcion');
        });
    }
}
