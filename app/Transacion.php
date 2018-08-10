<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','f_cliente','f_proveedor','f_usuario','localizacion','factura','descuento','tipo','comentario'
  ];
  protected $dates = ['fecha'];

  public static function buscar($buscar,$tipo){
    return Transacion::factura($buscar)->tipo($tipo)->Localizacion()->orderBy('fecha','DESC')->paginate(10);
  }
  public static function pendientes($buscar,$tipo){
    return Transacion::factura($buscar)->tipo($tipo)->orderBy('fecha','DESC')->paginate(10);
  }
  public function scopeFactura($query, $buscar){
    if(trim($buscar)!=""){
      $query->where('factura', 'like','%'.$buscar.'%');
    }
  }
  public function scopeTipo($query, $tipo){
    if($tipo!=5){
      $query->where('tipo', '=',$tipo);
    }else{
      $query->where('tipo', '=',$tipo)->orWhere('tipo', '=',6);
    }
  }
  public function scopeLocalizacion($query){
    $tipoUsuario=Transacion::tipoUsuario();
    $query->where('localizacion', '=',$tipoUsuario);
  }
  public function scopeEstado($query, $estado){
    if($estado==1 || $estado==""){
      $query->where('factura', '=',null)->orWhere('factura','=','');
    }elseif($estado==0){
      $query->where('factura', '<>',null)->orWhere('factura','<>','');
    }
  }
  public function scopeAnulado($query, $anulado){
    if($anulado==0 || $anulado==""){
      $query->where('anulado',0);
    }elseif($anulado==1){
      $query->where('anulado',1);
    }
  }
  public static function arrayClientes(){ //Retorna los pacientes activos usando la función buscar
    $pacientes=Paciente::where('estado','=',true)->get();
    $arrayP = [];
    foreach($pacientes as $paciente){
      $arrayP[$paciente->id]=$paciente->apellido.", ".$paciente->nombre;
    }
    return $arrayP;
  }
  public static function arrayProveedores(){ //Retorna los pacientes activos usando la función buscar
    $proveedores=Proveedor::where('estado','=',true)->get();
    $arrayP = [];
    foreach($proveedores as $proveedor){
      $arrayP[$proveedor->id]=$proveedor->nombre;
    }
    return $arrayP;
  }
  public function cliente(){
    return $this->belongsTo('App\Paciente','f_cliente');
  }
  public function proveedor(){
    return $this->belongsTo('App\Proveedor','f_proveedor');
  }
  public function usuario(){
    return $this->belongsTo('App\User');
  }
  public function detalleTransaccion(){
    return $this->hasMany('App\DetalleTransacion','f_transaccion');
  }
  public function solicitud(){
    return $this->hasMany('App\SolicitudExamen', 'f_transaccion');
  }
  public static function tipoUsuario(){
    if(Auth::user()->tipoUsuario=='Recepción' || Auth::user()->tipoUsuario == "Enfermería"){
      return 1;
    }elseif(Auth::user()->tipoUsuario=='Farmacia'){
      return 0;
    }elseif(Auth::user()->tipoUsuario=='Laboratorio'){
      return 2;
    }
  }
  public function abono(){
    return $this->hasMany('App\Abono', 'f_transaccion');
  }
  public static function llenar(){
    //COMPONENTES
    if (Componente::count()==0) {
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
      }
      //PRESENTACIONES
      if (Presentacion::count()==0) {
        $presentaciones=[
          'Grageas','Inyectable','Comprimidos','Endoceptivos',
          'Cápsulas','Ampolla','Suspensión','Viales','Comprimidos recubiertos',
          'Cápsulas blandas','Tabletas','Tabletas efervescentes','Sachet','Solución oftálmica','Crema'];
          foreach ($presentaciones as $key => $p) {
            $pre= new Presentacion();
            $pre->nombre=$p;
            $pre->save();
          }
        }
        //DIVISIONES
        if (Division::count()==0) {
          $divisiones=[
            'Caja','Dispensador','Frasco','Tubo','Spray',
            'Blizter','Tarro','Jeringa prellenada','Lata'];
            foreach ($divisiones as $key => $d) {
              $div= new Division();
              $div->nombre=$d;
              $div->save();
            }
          }
          //PROVEEDORES
          if (Proveedor::count()==0) {
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
          }
          //CATEGORIA DE PRODUCTOS
          if (CategoriaProducto::count()==0) {
            $categorias=['Anticonceptivos','Cardiológicos','Antibióticos','Antiparasitarios','Anticoagulantes',
            'Oftalmológicos'];
            foreach ($categorias as $key => $c) {
              $cat= new CategoriaProducto();
              $cat->nombre=$c;
              $cat->save();
            }
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Gynera','Grageas','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Etinilestradiol',$producto,0.03,'Mg');
            Transacion::crearComponente('Gestodeno',$producto,0.075,'Mg');
            Transacion::crearDivision('Caja',$producto,11.14,21,"","0004",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Gynera 75/20','Grageas','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Etinilestradiol',$producto,0.02,'Mg');
            Transacion::crearComponente('Gestodeno',$producto,0.075,'Mg');
            Transacion::crearDivision('Caja',$producto,10.55,21,"","0005",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Mesigyna','Inyectable','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Valerato de estradiol',$producto,5,'Mg');
            Transacion::crearComponente('Enantato de noretisterona',$producto,50,'Mg');
            Transacion::crearDivision('Jeringa prellenada',$producto,6.17,1,'Ml',"0006",10);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Microgynon','Grageas','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Etinilestradiol',$producto,0.03,'Mg');
            Transacion::crearComponente('Levonorgestrel',$producto,0.15,'Mg');
            Transacion::crearDivision('Caja',$producto,5.15,21,"","0007",30);
            Transacion::crearDivision('Caja',$producto,7.19,28,"","0008",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Mirelle','comprimidos recubiertos','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Etinilestradiol',$producto,0.015,'Mg');
            Transacion::crearComponente('Gestodeno',$producto,0.06,'Mg');
            Transacion::crearDivision('Caja',$producto,10.84,28,"","0009",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Mirena evo','Endoceptivos','Bayer','Anticonceptivos');
          if($producto!=0){
            Transacion::crearComponente('Levonorgestrel',$producto,52,'Mg');
            Transacion::crearDivision('Caja',$producto,133.8,1,"","0010",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Adalat 10 mg','Cápsulas','Bayer','Cardiológicos');
          if($producto!=0){
            Transacion::crearComponente('Nifedipino',$producto,10,'Mg');
            Transacion::crearDivision('Caja',$producto,20.18,30,"","0011",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Adalat Oros 20 mg','Comprimidos recubiertos','Bayer','Cardiológicos');
          if($producto!=0){
            Transacion::crearComponente('Nifedipino',$producto,20,'Mg');
            Transacion::crearDivision('Caja',$producto,11.68,30,"","0012",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Adalat Oros 30 mg','Comprimidos recubiertos','Bayer','Cardiológicos');
          if($producto!=0){
            Transacion::crearComponente('Nifedipino',$producto,30,'Mg');
            Transacion::crearDivision('Caja',$producto,21.90,30,"","0013",30);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Alerfín','Solución oftálmica','Laboratorio López','Oftalmológicos');
          if($producto!=0){
            Transacion::crearComponente('Nafazolina',$producto,0.5,'Mg');
            Transacion::crearComponente('Antazolina fosfato',$producto,2.5,'Mg');
            Transacion::crearDivision('Frasco',$producto,1.45,15,'Ml',"0014",20);
          }
          //LLENADO DE PRODUCTOS
          $producto=Transacion::crearProducto('Alerfín crema','Crema','Laboratorio López','Antibióticos');
          if($producto!=0){
            Transacion::crearComponente('Clorfenamina maleato',$producto,10,'Mg');
            Transacion::crearDivision('Lata',$producto,0.90,12,'G',"0015",15);
          }
        }
        public static function crearProducto($nom,$pre,$pro,$cat){
          if(Producto::where('nombre',$nom)->count()==0){
            $prod=new Producto();
            $prod->nombre=$nom;
            $prod->f_presentacion=Presentacion::where('nombre',$pre)->get()->first()->id;
            $prod->f_proveedor=Proveedor::where('nombre',$pro)->get()->first()->id;
            $prod->f_categoria=CategoriaProducto::where('nombre',$cat)->get()->first()->id;
            $prod->save();
            return $prod->id;
          }else{
            return 0;
          }
        }
        public static function crearComponente($com,$id,$can,$uni){
          $c=new ComponenteProducto();
          $c->f_componente=Componente::where('nombre',$com)->get()->first()->id;
          $c->f_producto=$id;
          $c->cantidad=$can;
          $c->f_unidad=Unidad::where('nombre',$uni)->get()->first()->id;
          $c->save();

        }
        public static function crearDivision($div,$id,$pre,$can,$con,$cod,$stock){
          $d= new DivisionProducto();
          $d->f_division=Division::where('nombre',$div)->get()->first()->id;
          $d->f_producto=$id;
          $d->precio=$pre;
          $d->cantidad=$can;
          if($con!="")
          {$d->contenido=Unidad::where('nombre',$con)->get()->first()->id;}
          $d->codigo=$cod;
          $d->stock=$stock;
          $d->save();
        }
        public static function movimentosCaja($f_usuario){
          return Transacion::where('f_usuario',$f_usuario)->where('fecha',date('Y').'-'.date('m').'-'.date('d'))->get();
        }
        public static function tipo($t){
          $tipos= array(0 =>'Pedido',1=>'Compra',2=>'Venta',3=>'Venta anulada',4=>'Requisición de farmacia',5=>'Requisición atendida',6=>'Requisición recibida',7=>'Removido');
          return $tipos[$t];
        }
        public static function foreanos($id){
          $divisiones=DivisionProducto::where('f_producto',$id)->get();
          foreach ($divisiones as $div) {
            if(DetalleTransacion::where('f_producto',$div->id)->count()>0){
              return true;
            }else{
              return false;
            }
          }
        }
      }
