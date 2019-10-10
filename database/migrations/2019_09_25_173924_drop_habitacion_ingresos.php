<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropHabitacionIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingresos', function (Blueprint $table) {
						$table->dropForeign(['f_habitacion']);
						$table->dropColumn('f_habitacion');
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
						$table->integer('f_habitacion')->unsigned();
						$table->foreign('f_habitacion')->references('id')->on('habitacions');
        });
    }
}
