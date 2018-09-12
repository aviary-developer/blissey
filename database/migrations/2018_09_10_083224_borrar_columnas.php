<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BorrarColumnas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('devolucions', function (Blueprint $table) {
        $table->dropForeign('devolucions_f_detalle_transaccion_foreign');
      });
      Schema::table('devolucions', function (Blueprint $table) {
        $table->dropColumn('f_detalle_transaccion');
        $table->dropColumn('cantidad');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
