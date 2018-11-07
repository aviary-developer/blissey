<?php

use Illuminate\Database\Seeder;
use App\Componente;
use App\Presentacion;
use App\Division;
use App\Proveedor;
use App\CategoriaProducto;
use App\Unidad;
use App\Transacion;

class LlenarProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               //Función para truncar la base de datos
               DB::statement("SET foreign_key_checks=0");
               $databaseName = DB::getDatabaseName();
               $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
               foreach ($tables as $table) {
                   $name = $table->TABLE_NAME;
                   if ($name == 'migrations') {
                       continue;
                   }
                   DB::table($name)->truncate();
               }
               DB::statement("SET foreign_key_checks=1");
               //Fin de la función
               $componentes = [
                   "Ibuprofeno","Ácido Acetilsalicilico","Clotrimazol","Dexametazona","Dexapantenol",
                   "Plus multivitaminicos","Plantago ovata","Senna","Cafeína","Citrato de calcio",
                   "Vitamina D","Clorfenamina maleato","Vitaminas antioxidantes","Naproxeno","Vitamina C",
                   "Zinc","Etinilestradiol","Gestodeno","Valerato de estradiol","Enantato de noretisterona",
                   "Levonorgestrel","Drospirenona","Levomefolato cálcico","Nifedipino","Iloprost trometanol",
                   "Riociguat","Moxifloxacino","Ciprofloxacino","Vardenafil","Nimodipino",
                   "Acetato de ciproterona","Rivaroxaban","Nifurtimox","Sorafenib","Interferon beta 1-b",
                   "Gadobutrol",'Metocarbamol','Acetaminofén','Etinilestradiol','Nafazolina','Antazolina fosfato'];
                   foreach ($componentes as $key => $c) {
                       $comp= new Componente();
                       $comp->nombre=$c;
                       $comp->save();
                   }
       
               $presentaciones=[
                   'Grageas','Inyectable','Comprimidos','Endoceptivos','Óvulo',
                   'Cápsulas','Ampolla','Suspensión','Viales','Comprimidos recubiertos',
                   'Cápsulas blandas','Tabletas','Tabletas efervescentes','Sachet','Solución oftálmica',
                   'Crema'];
                   foreach ($presentaciones as $key => $p) {
                       $pre= new Presentacion();
                       $pre->nombre=$p;
                       $pre->save();
                   }
               $divisiones=[
                   'Caja','Dispensador','Frasco','Tubo','Spray',
                   'Blister','Tarro','Jeringa prellenada','Lata'];
                   foreach ($divisiones as $key => $d) {
                       $div= new Division();
                       $div->nombre=$d;
                       $div->save();
                   }
       
               $pnombre=['Bayer','Laboratorio López','Laboratorios Cofarma S.A','Laboratorios Suizos'];
               $pcorreo=['bayer@bayer.com','lopez@gmail.com','cofarma@hotmail.com','labs@suizos.es'];
               $ptelefono=['2345-5678','2256-7890','2456-6789','2123-2499'];
               for ($i=0; $i <count($pnombre) ; $i++) {
                   $prov= new Proveedor();
                   $prov->nombre=$pnombre[$i];
                   $prov->correo=$pcorreo[$i];
                   $prov->telefono=$ptelefono[$i];
                   $prov->save();
               }
       
               $categorias=['Anticonceptivos','Cardiológicos','Antibióticos','Antiparasitarios','Anticoagulantes',
                             'Oftalmológicos','Analgésicos','Antiácidos','Antialérgicos','Antidiarreicos',
                             'Antiinfeccioso','Antiinflamatorios','Antipiréticos','Antitusivos'];
                   foreach ($categorias as $key => $c) {
                     $cat= new CategoriaProducto();
                     $cat->nombre=$c;
                     $cat->save();
                   }
               $unidades=['Mg','Ml','G'];
                   foreach ($unidades as $key => $u) {
                     $uni= new Unidad();
                     $uni->nombre=$u;
                     $uni->save();
                   }
                //LLENADO DE PRODUCTOS
                $producto=Transacion::crearProducto('Gynera','Grageas','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Etinilestradiol',$producto,0.03,'Mg');
                  Transacion::crearComponente('Gestodeno',$producto,0.075,'Mg');
                  Transacion::crearDivision('Caja',$producto,11.14,21,"","0004",30);
                }
                $producto=Transacion::crearProducto('Gynera 75/20','Grageas','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Etinilestradiol',$producto,0.02,'Mg');
                  Transacion::crearComponente('Gestodeno',$producto,0.075,'Mg');
                  Transacion::crearDivision('Caja',$producto,10.55,21,"","0005",30);
                }
                $producto=Transacion::crearProducto('Mesigyna','Inyectable','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Valerato de estradiol',$producto,5,'Mg');
                  Transacion::crearComponente('Enantato de noretisterona',$producto,50,'Mg');
                  Transacion::crearDivision('Jeringa prellenada',$producto,6.17,1,'Ml',"0006",10);
                }
                $producto=Transacion::crearProducto('Microgynon','Grageas','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Etinilestradiol',$producto,0.03,'Mg');
                  Transacion::crearComponente('Levonorgestrel',$producto,0.15,'Mg');
                  Transacion::crearDivision('Caja',$producto,5.15,21,"","0007",30);
                  Transacion::crearDivision('Caja',$producto,7.19,28,"","0008",30);
                }
                $producto=Transacion::crearProducto('Mirelle','comprimidos recubiertos','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Etinilestradiol',$producto,0.015,'Mg');
                  Transacion::crearComponente('Gestodeno',$producto,0.06,'Mg');
                  Transacion::crearDivision('Caja',$producto,10.84,28,"","0009",30);
                }
                $producto=Transacion::crearProducto('Mirena evo','Endoceptivos','Bayer','Anticonceptivos');
                if($producto!=0){
                  Transacion::crearComponente('Levonorgestrel',$producto,52,'Mg');
                  Transacion::crearDivision('Caja',$producto,133.8,1,"","0010",30);
                }
                $producto=Transacion::crearProducto('Adalat 10 mg','Cápsulas','Bayer','Cardiológicos');
                if($producto!=0){
                  Transacion::crearComponente('Nifedipino',$producto,10,'Mg');
                  Transacion::crearDivision('Caja',$producto,20.18,30,"","0011",30);
                }
                $producto=Transacion::crearProducto('Adalat Oros 20 mg','Comprimidos recubiertos','Bayer','Cardiológicos');
                if($producto!=0){
                  Transacion::crearComponente('Nifedipino',$producto,20,'Mg');
                  Transacion::crearDivision('Caja',$producto,11.68,30,"","0012",30);
                }
                $producto=Transacion::crearProducto('Adalat Oros 30 mg','Comprimidos recubiertos','Bayer','Cardiológicos');
                if($producto!=0){
                  Transacion::crearComponente('Nifedipino',$producto,30,'Mg');
                  Transacion::crearDivision('Caja',$producto,21.90,30,"","0013",30);
                }
                $producto=Transacion::crearProducto('Alerfín','Solución oftálmica','Laboratorio López','Oftalmológicos');
                if($producto!=0){
                  Transacion::crearComponente('Nafazolina',$producto,0.5,'Mg');
                  Transacion::crearComponente('Antazolina fosfato',$producto,2.5,'Mg');
                  Transacion::crearDivision('Frasco',$producto,1.45,15,'Ml',"0014",20);
                }
                $producto=Transacion::crearProducto('Alerfín crema','Crema','Laboratorio López','Antibióticos');
                if($producto!=0){
                  Transacion::crearComponente('Clorfenamina maleato',$producto,10,'Mg');
                  Transacion::crearDivision('Lata',$producto,0.90,12,'G',"0015",15);
                }
    }
}
