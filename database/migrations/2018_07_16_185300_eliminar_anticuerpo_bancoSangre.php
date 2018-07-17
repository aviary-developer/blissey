<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarAnticuerpoBancoSangre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banco_sangres', function (Blueprint $table) {
            $table->dropColumn('anticuerpos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banco_sangres', function (Blueprint $table) {
            $table->string('anticuerpos');
        });
    }
}
