<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancoSangresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco_sangres', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipoSangre',array('A+','A-','B+','B-','AB+','AB-','O+','O-'));
            $table->string('anticuerpos');
            $table->string('pruebaCruzada');
            $table->date('fechaVencimiento');
            $table->integer('estado')->default(true);
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
        Schema::dropIfExists('banco_sangres');
    }
}
