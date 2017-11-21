<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarImagenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('logo_hospital');
            $table->dropColumn('logo_clinica');
            $table->dropColumn('logo_laboratorio');
            $table->dropColumn('logo_farmacia');
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
            $table->dropColumn('logo_hospital');
            $table->dropColumn('logo_clinica');
            $table->dropColumn('logo_laboratorio');
            $table->dropColumn('logo_farmacia');
        });
    }
}
