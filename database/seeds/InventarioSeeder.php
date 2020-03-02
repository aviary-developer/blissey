<?php

use Illuminate\Database\Seeder;
use App\Producto;
use App\DivisionProducto;
use App\Inventario;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos=Producto::where('estado',1)->orderBy('nombre')->get();
        foreach ($productos as $producto) {
            $divisiones=$producto->divisionProducto;
            foreach ($divisiones as $division) {
                echo $division->id;
                $farmacia=DivisionProducto::inventario($division->id,2);
                if($farmacia!=0){
                    Inventario::Actualizar($division->id,0,10,$farmacia);
                }
                $recepcion=DivisionProducto::inventario($division->id,3);
                if($recepcion!=0){
                  Inventario::Actualizar($division->id,1,10,$recepcion);
                }
  
            }
        }
    }
}
