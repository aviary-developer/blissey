<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuarioDetalleTransaccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_transacions', function (Blueprint $table) {
            $table->integer('f_usuario')->unsigned()->nullable();
            $table->foreign('f_usuario')->references('id')->on('users');
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
            $table->dropColumn('f_usuario');
        });
    }
}
