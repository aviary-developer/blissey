@if (!App\DetalleCaja::cajaApertura())
  <meta http-equiv="refresh" content="0;URL=/blissey/public/detalleCajas/create">
@endif
@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url'=>['guardarDevoluciones',$transaccion->id],'method' =>'POST','autocomplete'=>'off','id'=>'dev'])!!}
  @php
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Devoluciones
            @if ($transaccion->tipo==1)
              <small class="label-white badge red ">Sobre compra</small>
            @else
              <small class="label-white badge red ">Sobre venta</small>
            @endif
          </h3>
        </center>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jusficar *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('justificacion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Justificar las devoluciones','id'=>'justificacion']) !!}
            </div>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Devolver</th>
                <th>Cantidad</th>
                <th colspan="2">Producto</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($detalles as $detalle)
              @php
                $restar=App\DetalleDevolucion::total($detalle->id);
                $resta=$detalle->cantidad-$restar;
              @endphp
              @if ($resta!=0)
              <tr>
                <td style="width:25%;">
                      {!! Form::number('cantidad'.$detalle->id,0,['id'=>'cantidad'.$detalle->id,'class'=>'form-control','onKeyPress' => 'return cantidadDev( this, event,this.value,'.$detalle->id.');','placeholder'=>'Cantidad','min'=>'0']) !!}
                </td>
                <td>{{$resta}}
                  <input type="hidden" id="existencia{{$detalle->id}}" value="{{$resta}}">
                </td>
                <td>
                  @if($detalle->divisionProducto->unidad==null)
                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                  @else
                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                  @endif
                </td>
                <td>{{$detalle->divisionProducto->producto->nombre}}</td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        {!! Form::button('Confirmar',['class'=>'btn btn-primary','onclick'=>'justificar();']) !!}
      </div>
    </div>
  </div>
  {!!Form::close()!!}
  <script type="text/javascript">
    function cantidadDev(obj,e,valor,id){
      if(!entero(obj,e,valor)){
        return false;
      }else{
        cantidad=parseInt($('#cantidad'+id).val()+e.key);
        existe=parseInt($('#existencia'+id).val());
        if(cantidad>existe){
          notaError('La cantidad no debe superar las existencias');
          return false;
        }else{
          return true;
        }
      }
    }
    function justificar(){
      var cadena=$('#justificacion').val();
      if(cadena.length<1){
        notaError("Debe justificar la devolución");
      }else if(cadena.length<5){
        notaError("La justificación es muy corta");
      }else{
        $('#dev').submit();
      }
    }
  </script>
@endsection
