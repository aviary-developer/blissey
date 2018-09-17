<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValoresNormalesFemeninos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parametros', function (Blueprint $table) {
          // $table->dropColumn('observacion');
          $table->double('valorMinimoFemenino')->nullable();
          $table->double('valorMaximoFemenino')->nullable();
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
            $table->dropColumn('valorMaximoFemenino');
            $table->dropColumn('valorMinimoFemenino');
            $table->string('observacion');
        });
    }
}
