<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tacs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('estado')->default(true);
            $table->timestamps();
        });
        Schema::table('servicios', function (Blueprint $table) {
          $table->integer('f_tac')->unsigned()->nullable();
          $table->foreign('f_tac')->references('id')->on('tacs');
      });
      Schema::table('solicitud_examens', function (Blueprint $table) {
          $table->integer('f_tac')->unsigned()->nullable();
          $table->foreign('f_tac')->references('id')->on('tacs');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tacs');
    }
}
