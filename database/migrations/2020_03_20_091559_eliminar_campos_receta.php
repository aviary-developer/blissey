<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarCamposReceta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recetas', function (Blueprint $table) {
					/**Llaves foraneas */
					$table->dropForeign(['f_producto']);
					$table->dropForeign(['f_examen']);
					$table->dropForeign(['f_ultrasonografia']);
					$table->dropForeign(['f_rayox']);
					$table->dropForeign(['f_tac']);
					/**Seccion: Medicamento */
					$table->dropColumn('nombre_producto');
					$table->dropColumn('f_producto');
					$table->dropColumn('cantidad_dosis');
					$table->dropColumn('forma_dosis');
					$table->dropColumn('cantidad_frecuencia');
					$table->dropColumn('forma_frecuencia');
					$table->dropColumn('cantidad_duracion');
					$table->dropColumn('forma_duracion');
					$table->dropColumn('observacion');
					/**Seccion: laboratorio clínico */
					$table->dropColumn('f_examen')->unsigned();
					/**Seccion: evaluaciones */
					$table->dropColumn('f_ultrasonografia')->unsigned();
					$table->dropColumn('f_rayox')->unsigned();
					$table->dropColumn('f_tac')->unsigned();
					/**Seccion: Editor de texto */
					$table->dropColumn('Texto');

					//Agregar campo de nombre a la receta
					$table->string('nombre_receta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
					/**Seccion: Medicamento */
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
					$table->foreign('f_producto')->references('id')->on('productos');
					$table->foreign('f_examen')->references('id')->on('examens');
					$table->foreign('f_ultrasonografia')->references('id')->on('ultrasonografias');
					$table->foreign('f_rayox')->references('id')->on('rayosxes');
					$table->foreign('f_tac')->references('id')->on('tacs');
					//Drop campo de nombre de la receta
					$table->dropColumn('nombre_receta');
				});
    }
}
