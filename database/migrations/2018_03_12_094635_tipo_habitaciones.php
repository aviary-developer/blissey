<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoHabitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitacions', function (Blueprint $table) {
            $table->integer('tipo')->nullable();
            /*
            0 - Observación
            1 - Hospital
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
        Schema::table('habitacions', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
