<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVariosProductoDivisionproducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('productos', function (Blueprint $table) {
        $table->integer('f_categoria')->unsigned()->nullable();
        $table->foreign('f_categoria')->references('id')->on('categoria_productos');
      });
      Schema::table('division_productos', function (Blueprint $table) {
        $table->integer('stock')->default(40);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('productos', function (Blueprint $table) {
          $table->dropColumn('f_categoria');
      });
      Schema::table('division_productos', function (Blueprint $table) {
        $table->dropColumn('stock');
      });
    }
}
