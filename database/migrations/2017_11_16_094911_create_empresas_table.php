<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_hospital');
            $table->string('nombre_hospital');
            $table->text('direccion_hospital');
            $table->string('telefono_hospital',9);
            $table->string('logo_hospital');
            //---Clinica---------------------------
            $table->string('codigo_clinica');
            $table->string('nombre_clinica');
            $table->text('direccion_clinica');
            $table->string('telefono_clinica',9);
            $table->string('logo_clinica');
            //---Laboratorio-----------------------
            $table->string('codigo_laboratorio');
            $table->string('nombre_laboratorio');
            $table->text('direccion_laboratorio');
            $table->string('telefono_laboratorio',9);
            $table->string('logo_laboratorio');
            //---Farmacia---------------------------
            $table->string('codigo_farmacia');
            $table->string('nombre_farmacia');
            $table->text('direccion_farmacia');
            $table->string('telefono_farmacia',9);
            $table->string('logo_farmacia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
