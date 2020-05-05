<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
						$table->increments('id');
						$table->dateTime('fecha');
						$table->text('descripcion');
						$table->integer('f_ingreso')->unsigned();
						$table->integer('f_enfermeria')->unsigned();
						$table->foreign('f_ingreso')->references('id')->on('ingresos');
						$table->foreign('f_enfermeria')->references('id')->on('users');
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
        Schema::dropIfExists('seguimientos');
    }
}
