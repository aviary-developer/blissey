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
    return Transacion::factura($buscar)->tipo($tipo)->localizacion()->orderBy('fecha','DESC')->paginate(10);
  }
  public static function pendientes($buscar,$tipo){
    $contrario=Transacion::contrario(Transacion::tipoUsuario());
    return Transacion::factura($buscar)->tipo($tipo)->where('localizacion',$contrario)->orderBy('fecha','DESC')->paginate(10);
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
  public function ingreso(){
    return $this->belongsTo('App\Ingreso', 'f_ingreso');
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
        public static function movimentosCaja($f_usuario,$apertura,$fecha){
          if(Transacion::tipoUsuario()==0){
            return Transacion::where('f_usuario',$f_usuario)->where('fecha',$fecha)->filtroTipo()->filtroHora($apertura)->orderBy('updated_at','asc')->get();
          }else{
            return Transacion::where('f_usuario',$f_usuario)->filtroFecha($fecha)->filtroTipo()->filtroHora($apertura)->orderBy('updated_at','asc')->get();
          }
        }
        public function scopeFiltroFecha($query,$fecha){
          $query->where('fecha',$fecha)->orWhere('updated_at',"<",\Carbon\Carbon::now()->toDateString()." 07:00:00");
        }
        public function scopefiltroTipo($query){
            $query->where('tipo',1)->orWhere('tipo',2)->orWhere('tipo',8)->orWhere('tipo',9);
        }
        public function scopefiltroHora($query,$apertura){
          $query->where('updated_at','>',$apertura);
        }
        public static function tipo($t){
          $tipos= array(0 =>'Pedido',1=>'Compra',2=>'Venta',3=>'Venta anulada',4=>'Requisición de farmacia',5=>'Requisición atendida',6=>'Requisición recibida',7=>'Removido',8=>'Devoluciones/Compras',9=>'Devoluciones/Ventas');
          return $tipos[$t];
        }
        public static function foraneos($id){
          $divisiones=DivisionProducto::where('f_producto',$id)->get();
          foreach ($divisiones as $div) {
            if(DetalleTransacion::where('f_producto',$div->id)->count()>0){
              return true;
            }else{
              return false;
            }
          }
        }
        public static function valorTotal($id){
          $detalles=DetalleTransacion::where('f_transaccion',$id)->get();
          $total=0;
          foreach ($detalles as $d) {
            $descontado=$d->precio-($d->precio*($d->descuento/100));
            $subtotal=$d->cantidad*$descontado;
            $total=$total+$subtotal;
          }
          $des=DetalleTransacion::descuento($id);
          if($des>0){
            $total=$total-($total*($des/100));
          }
          $iva=Transacion::find($id)->iva;
          if(!$iva){
            $total=$total*1.13;
          }
          return $total;
        }
        public static function contrario($tipo){
          if($tipo==0){
            return 1;
          }elseif($tipo==1){
            return 0;
          }
        }
      }
