<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRayoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_rayoxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_resultado')->unsigned();
            $table->foreign('f_resultado')->references('id')->on('resultados');
            $table->string('rayox')->default('noImgen');
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
        Schema::dropIfExists('detalle_rayoxes');
    }
}
