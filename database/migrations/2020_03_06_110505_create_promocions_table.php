<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_servicio')->unsigned();
            $table->foreign('f_servicio')->references('id')->on('servicios');
            $table->integer('f_serviciop')->unsigned()->nullable();
            $table->foreign('f_serviciop')->references('id')->on('servicios');
            $table->integer('f_divisionproducto')->unsigned()->nullable();
            $table->foreign('f_divisionproducto')->references('id')->on('division_productos');
            $table->integer('cantidad')->unsigned();
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
        Schema::dropIfExists('promocions');
    }
}
