<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarLocalizacionInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inventario_farmacias', function (Blueprint $table) {
          $table->integer('localizacion')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('inventario_farmacias', function (Blueprint $table) {
          $table->dropColumn('localizacion');
      });
    }
}
