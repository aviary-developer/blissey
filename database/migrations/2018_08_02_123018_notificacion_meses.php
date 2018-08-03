<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificacionMeses extends Migration
{

    public function up()
    {
      Schema::table('division_productos', function (Blueprint $table) {
        $table->integer('n_meses')->default(3);
    });
    }

    public function down()
    {
      Schema::table('division_productos', function (Blueprint $table) {
        $table->double('n_meses');
    });
    }
}
