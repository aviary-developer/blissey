<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiodeValorPredeterminado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parametros', function (Blueprint $table) {
          $table->dropColumn('valorMinimo');
          $table->dropColumn('valorMaximo');
          $table->dropColumn('valorPredeterminado');
        });
        Schema::table('parametros', function (Blueprint $table) {
          $table->double('valorMinimo')->nullable();
          $table->double('valorMaximo')->nullable();
          $table->string('valorPredeterminado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parametros', function (Blueprint $table) {
            //
        });
    }
}
