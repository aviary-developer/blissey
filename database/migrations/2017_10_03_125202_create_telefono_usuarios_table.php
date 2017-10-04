<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefono_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('telefono',9);
            $table->integer('f_usuario')->unsigned();
            $table->foreign('f_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefono_usuarios');
    }
}
