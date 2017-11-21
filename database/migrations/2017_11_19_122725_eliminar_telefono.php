<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarTelefono extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('telefono_hospital');
            $table->dropColumn('telefono_clinica');
            $table->dropColumn('telefono_laboratorio');
            $table->dropColumn('telefono_farmacia');
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
            $table->dropColumn('telefono_hospital');
            $table->dropColumn('telefono_clinica');
            $table->dropColumn('telefono_laboratorio');
            $table->dropColumn('telefono_farmacia');
        });
    }
}
