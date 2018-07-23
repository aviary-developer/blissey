<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioImporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_cajas', function (Blueprint $table) {
          $table->dropColumn('importe');
      });
      Schema::table('detalle_cajas', function (Blueprint $table) {
        $table->double('importe');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('detalle_cajas', function (Blueprint $table) {
          $table->dropColumn('importe');
      });
    }
}
