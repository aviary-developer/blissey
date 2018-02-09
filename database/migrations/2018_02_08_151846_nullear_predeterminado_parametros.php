<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullearPredeterminadoParametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('parametros', function (Blueprint $table) {
          $table->dropColumn('valorPredeterminado');
      });
      Schema::table('parametros', function (Blueprint $table) {
        $table->string('valorPredeterminado')->nullable();
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
