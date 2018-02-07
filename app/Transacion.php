<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','factura','f_cliente','f_proveedor','descuento','tipo','f_usuario','localizacion','anulado','comentario'
  ];
  protected $dates = ['fecha'];

  public static function buscar($buscar,$tipo,$estado,$anulado){
    return Transacion::factura($buscar)->tipo($tipo)->Localizacion()->estado($estado)->anulado($anulado)->orderBy('fecha','DESC')->paginate(10);
  }
  public function scopeFactura($query, $buscar){
    if(trim($buscar)!=""){
      $query->where('factura', 'ilike','%'.$buscar.'%');
    }
  }
  public function scopeTipo($query, $tipo){
      $query->where('tipo', '=',$tipo);
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
  public static function tipoUsuario(){
    if(Auth::user()->tipoUsuario=='Recepción'){
      return 1;
    }elseif(Auth::user()->tipoUsuario=='Farmacia'){
      return 0;
    }elseif(Auth::user()->tipoUsuario=='Laboratorio'){
      return 2;
    }
  }
  public static function llenar(){
    //COMPONENTES
    $componentes = [
      "Ibuprofeno","Ácido Acetilsalicilico","Clotrimazol","Dexametazona","Dexapantenol",
      "Plus multivitaminicos","Plantago ovata","Senna","Cafeína","Citrato de calcio",
      "Vitamina D","Clorfenamina maleato","Vitaminas antioxidantes","Naproxeno","Vitamina C",
      "Zinc","Etinilestradiol","Gestodeno","Valerato de estradiol","Enantato de noretisterona",
      "Levonorgestrel","Drospirenona","Levomefolato cálcico","Nifedipino","Iloprost trometanol",
      "Riociguat","Moxifloxacino","Ciprofloxacino","Vardenafil","Nimodipino",
      "Acetato de ciproterona","Rivaroxaban","Nifurtimox","Sorafenib","Interferon beta 1-b",
      "Gadobutrol"];

      foreach ($componentes as $key => $c) {
        if(Componente::where('id',$key+1)->count()==0){
          $comp= new Componente();
        }else{
          $comp=Componente::find($key+1);
        }
        $comp->id=$key+1;
        $comp->nombre=$c;
        $comp->save();
      }
      //PRESENTACIONES
      $presentaciones=[
        'Grageas','Jeringa prellenada','Comprimidos','Endoceptivos',
        'Cápsulas','Ampolla','Suspensión','viales','comprimidos recubiertos',
        'Cápsulas blandas','Tabletas','Tabletas efervescentes','Sachet'];
      foreach ($presentaciones as $key => $p) {
        if(Presentacion::where('id',$key+1)->count()==0){
          $pre= new Presentacion();
        }else{
          $pre=Presentacion::find($key+1);
        }
          $pre->id=$key+1;
          $pre->nombre=$p;
          $pre->save();
        }
        //DIVISIONES
      $divisiones=[
        'Caja','Dispensador','Frasco','Tubo','Spray',
        'Blizter','Tarro'];
        foreach ($divisiones as $key => $d) {
          if(Division::where('id',$key+1)->count()==0){
            $div= new Division();
          }else{
            $div=Division::find($key+1);
          }
            $div->id=$key+1;
            $div->nombre=$d;
            $div->save();
          }
          //PROVEEDORES
        $pnombre=['Bayer','Laboratorio López','Laboratorios Cofarma S.A','Laboratorios Suizos'];
        $pcorreo=['bayer@bayer.com','lopez@gmail.com','cofarma@hotmail.com','labs@suizos.es'];
        $ptelefono=['2345-5678','2256-7890','2456-6789','2123-2499'];
        for ($i=0; $i <count($pnombre) ; $i++) {
          if(Proveedor::where('id',$i+1)->count()==0){
            $prov= new Proveedor();
          }else{
            $prov=Proveedor::find($i+1);
          }
            $prov->id=$i+1;
            $prov->nombre=$pnombre[$i];
            $prov->correo=$pcorreo[$i];
            $prov->telefono=$ptelefono[$i];
            $prov->save();
        }


  }
}
