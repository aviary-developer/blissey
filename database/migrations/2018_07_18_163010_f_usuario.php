<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FUsuario extends Migration
{
    public function up()
    {
      Schema::table('detalle_cajas', function (Blueprint $table) {
        $table->integer('f_usuario')->unsigned()->nullable();
        $table->foreign('f_usuario')->references('id')->on('users');
    });
    }

    public function down()
    {
      Schema::table('detalle_cajas', function (Blueprint $table) {
          $table->dropColumn('f_usuario');
      });
    }
}
