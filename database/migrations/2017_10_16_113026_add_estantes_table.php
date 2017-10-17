<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estantes', function (Blueprint $table) {
            $table->boolean('localizacion');
            /*
            Localización---------------------
            1: Recepción
            0: Farmacia
            -------------------------
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
        Schema::table('estantes', function (Blueprint $table) {
            //
        });
    }
}
