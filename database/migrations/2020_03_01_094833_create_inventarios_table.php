<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_divisionproducto')->unsigned()->nullable();
            $table->foreign('f_divisionproducto')->references('id')->on('division_productos');
            $table->integer('localizacion');
            $table->integer('tipo_movimiento');
            $table->integer('existencia_anterior');
            $table->integer('cantidad');
            $table->integer('existencia_nueva');
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
        Schema::dropIfExists('inventarios');
    }
}
