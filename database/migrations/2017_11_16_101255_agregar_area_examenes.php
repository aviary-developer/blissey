<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarAreaExamenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->enum('area',array('HEMATOLOGIA','EXAMENES DE ORINA','EXAMENES DE HECES','BACTERIOLOGIA','QUIMICA SANGUINEA','INMUNOLOGIA','ENZIMAS','PRUEBAS ESPECIALES','OTROS'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->enum('area');
        });
    }
}
