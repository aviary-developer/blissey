<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnasIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingresos', function (Blueprint $table) {
					$table->dropForeign(['f_paciente']);
					$table->dropColumn('f_paciente');
					$table->dropForeign(['f_responsable']);
					$table->dropColumn('f_responsable');
					$table->dropForeign(['f_medico']);
					$table->dropColumn('f_medico');
					$table->integer('f_hospitalizacion')->unsigned();
					$table->foreign('f_hospitalizacion')->references('id')->on('hospitalizacions');
					$table->dropColumn('expediente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingresos', function (Blueprint $table) {
					$table->integer('f_paciente')->unsigned();
					$table->foreign('f_paciente')->references('id')->on('pacientes');
					$table->integer('f_responsable')->unsigned();
					$table->foreign('f_responsable')->references('id')->on('pacientes');
					$table->integer('f_medico')->unsigned();
					$table->foreign('f_medico')->references('id')->on('users');
					$table->dropForeign(['f_hospitalizacion']);
					$table->dropColumn('f_hospitalizacion');
					$table->integer('expediente');
        });
    }
}
