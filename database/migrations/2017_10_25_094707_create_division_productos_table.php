<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_productos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('f_division')->unsigned();
          $table->integer('f_producto')->unsigned();
          $table->integer('cantidad');
          $table->double('ganancia');
          $table->foreign('f_division')->references('id')->on('divisions');
          $table->foreign('f_producto')->references('id')->on('productos');
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
        Schema::dropIfExists('division_productos');
    }
}
