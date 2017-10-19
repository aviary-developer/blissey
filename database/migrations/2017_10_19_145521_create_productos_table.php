<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',40);
            $table->string('codigo',15);
            $table->integer('f_presentacion')->unsigned();
            $table->integer('f_proveedor')->unsigned();
            $table->boolean('estado')->default(true);
            $table->double('precio');
            $table->foreign('f_presentacion')->references('id')->on('presentacions');
            $table->foreign('f_proveedor')->references('id')->on('proveedors');
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
        Schema::dropIfExists('productos');
    }
}
