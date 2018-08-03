<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamaActiva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camas', function (Blueprint $table) {
            $table->boolean('activo')->default(true);
            /*Activo----------------------
            true: Activo
            false: Inactivo
            ------------------------------
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
        Schema::table('camas', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
}
