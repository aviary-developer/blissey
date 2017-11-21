<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarCodigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('codigo_hospital');
            $table->dropColumn('codigo_clinica');
            $table->dropColumn('codigo_laboratorio');
            $table->dropColumn('codigo_farmacia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('codigo_hospital');
            $table->dropColumn('codigo_clinica');
            $table->dropColumn('codigo_laboratorio');
            $table->dropColumn('codigo_farmacia');
        });
    }
}
