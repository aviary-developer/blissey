<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SelloLaboratorio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('sello_laboratorio')->default("noImgen.jpg");
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
            $table->dropColumn('sello_laboratorio');
        });
    }
}
