<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarImagenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('logo_hospital')->default('noImgen');
            $table->string('logo_clinica')->default('noImgen');
            $table->string('logo_farmacia')->default('noImgen');
            $table->string('logo_laboratorio')->default('noImgen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('logo_hospital')->default('noImgen');
            $table->string('logo_clinica')->default('noImgen');
            $table->string('logo_farmacia')->default('noImgen');
            $table->string('logo_laboratorio')->default('noImgen');
        });
    }
}
