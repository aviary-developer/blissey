<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposExamenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examens', function (Blueprint $table) {
          $table->string('nombreExamen');
          $table->boolean('estado')->default(true);
          $table->enum('tipoMuestra',array('Sangre','Heces','Orina','Secreción'));
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
          $table->dropColumn('nombreExamen');
          $table->dropColumn('tipoMuestra');
          $table->dropColumn('estado');
        });
    }
}
