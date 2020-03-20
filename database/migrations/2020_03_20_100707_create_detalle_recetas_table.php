<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_recetas', function (Blueprint $table) {
						$table->increments('id');
						$table->integer('f_receta')->unsigned();
						$table->string('nombre_producto')->nullable();
						$table->integer('f_producto')->unsigned()->nullable();
						$table->integer('cantidad_dosis')->nullable();
						$table->integer('forma_dosis')->nullable();
						$table->integer('cantidad_frecuencia')->nullable();
						$table->integer('forma_frecuencia')->nullable();
						$table->integer('cantidad_duracion')->nullable();
						$table->integer('forma_duracion')->nullable();
						$table->text('observacion')->nullable();
						/**Seccion: laboratorio clínico */
						$table->integer('f_examen')->unsigned()->nullable();
						/**Seccion: evaluaciones */
						$table->integer('f_ultrasonografia')->unsigned()->nullable();
						$table->integer('f_rayox')->unsigned()->nullable();
						$table->integer('f_tac')->unsigned()->nullable();
						/**Seccion: Editor de texto */
						$table->text('Texto')->nullable();
						/**Llaves foraneas */
						$table->foreign('f_receta')->references('id')->on('recetas');
						$table->foreign('f_producto')->references('id')->on('productos');
						$table->foreign('f_examen')->references('id')->on('examens');
						$table->foreign('f_ultrasonografia')->references('id')->on('ultrasonografias');
						$table->foreign('f_rayox')->references('id')->on('rayosxes');
						$table->foreign('f_tac')->references('id')->on('tacs');
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
        Schema::dropIfExists('detalle_recetas');
    }
}
