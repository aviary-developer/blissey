<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCantidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('division_productos', function (Blueprint $table) {
            $table->double('cantidadd')->nullable();
        });
        $dp=App\DivisionProducto::all();
        foreach($dp as $d){
            $d->cantidadd=$d->cantidad;
            $d->save();
        }
        Schema::table('division_productos', function (Blueprint $table) {
            $table->dropColumn('cantidad');
          });
          Schema::table('division_productos', function (Blueprint $table) {
            $table->renameColumn('cantidadd', 'cantidad');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
