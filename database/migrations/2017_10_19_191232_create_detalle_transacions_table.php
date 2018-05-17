<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleTransacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_transacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_servicio')->unsigned()->nullable();
            $table->double('precio');
            $table->double('descuento')->default(0);
            $table->integer('cantidad')->default(0);
            $table->boolean('condicion')->default(true);
            //1 - Entregado / 0 - Pendiente
            $table->date('fecha_vencimiento')->nullable();
            $table->string('lote',15);
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
        Schema::dropIfExists('detalle_transacions');
    }
}
