<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero')->unsigned();
            $table->double('precio');
            $table->boolean('estado')->default(false);
            /*Estado----------------------
            true: Ocupado
            false: Vacio
            ------------------------------
            */
            $table->integer('f_habitacion')->unsigned()->nullable();
            $table->foreign('f_habitacion')->references('id')->on('habitacions');
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
        Schema::dropIfExists('camas');
    }
}
