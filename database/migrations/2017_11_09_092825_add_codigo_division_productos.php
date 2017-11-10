<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodigoDivisionProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('productos', function (Blueprint $table) {
          $table->dropColumn('codigo');
      });
      Schema::table('division_productos', function (Blueprint $table) {
            $table->string('codigo',15)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('codigo');
    }
}
