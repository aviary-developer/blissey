<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadoOcupadoHabitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitacions', function (Blueprint $table) {
            $table->boolean('estado')->default(true);
            $table->boolean('ocupado')->default(false);
            /*
            Estado -----------------
            true = activos
            false = inactivo
            ------------------------

            Ocupado ----------------
            true = ocupado
            false = vacio
            ------------------------
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
            //
        });
    }
}
