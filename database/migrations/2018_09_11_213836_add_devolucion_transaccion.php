<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDevolucionTransaccion extends Migration
{
    public function up()
    {
      Schema::table('transacions', function (Blueprint $table) {
        $table->double('devolucion')->default(0);
      });
    }

    public function down()
    {
      Schema::table('transacions', function (Blueprint $table) {
          $table->dropColumn('devolucion');
          });
    }
}
