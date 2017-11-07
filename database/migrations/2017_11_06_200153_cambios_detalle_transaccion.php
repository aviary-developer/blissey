<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiosDetalleTransaccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->dropColumn('f_producto');
      });
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->integer('f_producto')->unsigned()->nullable();
          $table->foreign('f_producto')->references('id')->on('detalle_transacions');
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
          $table->dropColumn('f_producto');
      });
    }
}
