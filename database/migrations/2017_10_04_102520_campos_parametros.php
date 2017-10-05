<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposParametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parametros', function (Blueprint $table) {
          $table->string('nombreParametro');
          $table->double('valorMinimo');
          $table->double('valorMaximo');
          $table->double('valorPredeterminado')->nullable();
          $table->boolean('estado')->default(true);
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
          $table->dropColumn('nombreParametro');
          $table->dropColumn('valorMinimo');
          $table->dropColumn('valorMaximo');
          $table->dropColumn('valorPredeterminado');
          $table->dropColumn('estado');
        });
    }
}
