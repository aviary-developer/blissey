<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponenteProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componente_productos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('f_componente')->unsigned()->nullable();
          $table->integer('f_producto')->unsigned()->nullable();
          $table->double('cantidad');
          $table->integer('f_unidad')->unsigned()->nullable();
          $table->foreign('f_componente')->references('id')->on('componentes');
          $table->foreign('f_producto')->references('id')->on('productos');
          $table->foreign('f_unidad')->references('id')->on('unidads');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('componente_productos');
    }
}
