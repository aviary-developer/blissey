<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->dropColumn('precio');
          $table->dropColumn('lote');
      });
      Schema::table('detalle_transacions', function (Blueprint $table) {
          $table->integer('f_transaccion')->unsigned();
          $table->foreign('f_transaccion')->references('id')->on('transacions');
          $table->double('precio')->unsigned()->nullable();
          $table->string('lote',15)->nullable();
      });
      Schema::table('productos', function (Blueprint $table) {
          $table->dropColumn('precio');
      });
      Schema::table('division_productos', function (Blueprint $table) {
          $table->dropColumn('ganancia');
      });
      Schema::table('division_productos', function (Blueprint $table) {
          $table->double('precio')->nullable();
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
