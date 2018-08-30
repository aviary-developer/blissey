<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarImagenExamenesYResultado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->boolean('imagen')->default(false);
        });
        Schema::table('resultados', function (Blueprint $table) {
            $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('examens', function (Blueprint $table) {
          $table->dropColumn('imagen');
      });
      Schema::table('resultados', function (Blueprint $table) {
        $table->dropColumn('imagen');
      });
    }
}
