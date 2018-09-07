<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioVariableEstante extends Migration
{
    public function up()
    {
      Schema::table('estantes', function (Blueprint $table) {
        $table->dropColumn('codigo');
      });
        Schema::table('estantes', function (Blueprint $table) {
          $table->integer('codigo')->default(0);
        });
    }
    public function down()
    {
      Schema::table('estantes', function (Blueprint $table) {
        $table->dropColumn('codigo');
      });
    }
}
