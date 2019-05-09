<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoDevolucions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devolucions', function (Blueprint $table) {
            $table->integer('tipo')->default(0);
        });
        Schema::table('detalle_devolucions', function (Blueprint $table) {
            $table->integer('tipo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devolucions', function (Blueprint $table) {
            $table->dropColumn('tipo');
          });
        Schema::table('detalle_devolucions', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
