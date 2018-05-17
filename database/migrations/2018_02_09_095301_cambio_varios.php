<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioVarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('transacions', function (Blueprint $table) {
          $table->dropColumn('tipo');
          $table->dropColumn('anulado');
      });
      Schema::table('transacions', function (Blueprint $table) {
          $table->integer('tipo')->default(0);
      });
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->dropColumn('condicion');
      });
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->integer('f_estante')->unsigned()->nullable();
          $table->foreign('f_estante')->references('id')->on('estantes');
          $table->integer('nivel')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('transacions', function (Blueprint $table) {
          $table->dropColumn('tipo');
      });
    }
}
