<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConsultaMedico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->integer('f_medico')->unsigned()->nullable();
            $table->foreign('f_medico')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropColumn('f_medico');
        });
    }
}
