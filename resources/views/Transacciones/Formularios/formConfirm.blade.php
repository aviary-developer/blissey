<div class="x_content">
    <div class="row">
      <input type="hidden" value="" id="idoculto">
      <input type="hidden" value="" id="divoculto">
      <input type="hidden" value="" id="nomoculto">
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
      @php
        $estantes=App\Estante::arrayEstante();
        $cadena="<option value=''>Seleccione un estante</option>";
        foreach ($estantes as $key => $e) {
          $cadena=$cadena."<option value='".$key."'>".$e."</option>";
        }
      @endphp
      <input type="hidden" id="opciones" value="{{$cadena}}">
      <input type="hidden" id="confirmar" name="confirmar" value="{{true}}">
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::date('fecha',$transaccion->fecha,['class'=>'form-control has-feedback-left']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Proveedor *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
        {!!Form::select('f_proveedor',
          App\Transacion::arrayProveedores()
          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'f_proveedor'])!!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">N° de factura *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('factura',null,['class'=>'form-control has-feedback-left','id'=>'fac']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Descuento general *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-percent form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('descuentog',0,['class'=>'form-control has-feedback-left']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Código </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('codigo',null,['id'=>'codigoBuscar','class'=>'form-control has-feedback-left','placeholder'=>'Código']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Producto </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('producto',null,['id'=>'producto','class'=>'form-control has-feedback-left','placeholder'=>'Producto']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Cantidad </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('cantidadp',1,['id'=>'cantidadp','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">IVA incluido</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
          <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success" onclick="cambio()">
            <label id="iva">No</label>
          </button>
          <input type="checkbox" class="hidden" name="desactivate" value="1">
          <input type="hidden" name="ivaincluido" value="0" id="ivaincluido">
        </span>
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Opciones </label>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="#" class="btn btn-default" id="agregar">Agregar</a>
      </div>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <button type="button" name="button" data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-default" id="agregar_paciente">
          Buscar
        </button>
      </div>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="#" class="btn btn-default">Cancelar</a>
      </div>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        {{-- {!! Form::submit('Confirmar',['class'=>'btn btn-primary']) !!} --}}
        {!!Form::button('Confirmar',['class'=>'btn btn-primary','id'=>'confirmarPedido'])!!}
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <h4 class="StepTitle">Detalles</h4>
        <table class="table" id="tablaDetalle">
          <thead>
            <th style="width : 8%">Cantidad</th>
            <th colspan="2">Detalle</th>
            <th style="width : 8%">Descuento</th>
            <th>Fecha de vencimiento</th>
            <th>Precio unitario</th>
            <th>Lote</th>
            <th>Estante</th>
            <th style="width : 8%">Nivel</th>
            <th style="width : 80px">Acción</th>
          </thead>
            @php
            $detalles=$transaccion->detalleTransaccion;
            @endphp
            @foreach ($detalles as $key => $detalle)
              <tr>
                <td>
                  {!! Form::number('cantidad[]',$detalle->cantidad,['class'=>'form-control valu','placeholder'=>'Cantidad','min'=>'1','onKeyPress' => 'return entero( this, event,this.value);']) !!}
                </td>
                <td>
                @if ($detalle->divisionProducto->unidad==null)
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                @else
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                @endif
                </td>
                <td>{{$detalle->divisionProducto->producto->nombre}}</td>
                <td>
                    {!! Form::number('descuento[]',null,['class'=>'form-control vald','placeholder'=>'%','min'=>'0']) !!}
                </td>
                <td>
                  {!! Form::date('fecha_vencimiento[]',null,['class'=>'form-control valt']) !!}
                </td>
                <td>
                  {!! Form::number('precio[]',null,['class'=>'form-control valc','placeholder'=>'Precio']) !!}
                </td>
                <td>
                  {!! Form::text('lote[]',null,['class'=>'form-control vali','placeholder'=>'N° de lote']) !!}
                </td>
                <td>{!!Form::select('f_estante[]',
                  App\Estante::arrayEstante()
                  ,null, ['placeholder' => 'Seleccione un estante','class'=>'form-control vals','id'=>'f_estante'.$detalle->f_producto,'onChange'=>'cambioEstante('.$detalle->f_producto.')'])!!}
              </td>
                <td>{!!Form::select('nivel[]',[]
                  ,null, ['placeholder' => 'Nivel','class'=>'form-control','id'=>'nivel'.$detalle->f_producto])!!}
                </td>
                <td>
                  <input type="hidden" id='{{"f_prod".$key}}' value='{{$detalle->f_producto}}'>
                  <input type='hidden' name='estado[]' value ='{{$detalle->id}}'>
                  <input type='hidden' name='f_producto[]' value ='{{$detalle->f_producto}}'>
                  <button type='button' class='btn btn-xs btn-danger' id='eliminar_fila_pedido'>
                  <i class='fa fa-remove'></i>
                  </button>
                </td>
            </tr>
            @php
              $auxiliar_contador = $key;
            @endphp
            @endforeach
            <input type="hidden" id="contador" value={{$auxiliar_contador}}>
            <div id="eliminados"></div>
        </table>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
      </div>
      </div>
@include('Transacciones.Formularios.modalBuscarProducto')
    </div>
    <script type="text/javascript">
function cambioEstante(idp){
  console.log(idp);
  idEstante=$('#f_estante'+idp).find('option:selected').val();
  console.log(idEstante);
  $('#nivel'+idp).empty();
  if(idEstante!=""){
    var ruta = "/blissey/public/niveles/"+idEstante;
    $.get(ruta,function(res){
      cantidad=parseFloat(res);
      for(i=1;i<=cantidad;i++){
        $('#nivel'+idp).append("<option value="+i+">"+i+"</option>");
      }
    });
  }
}
function cambio(){
  texto=$('#iva').text();
  if(texto=="No"){
    $('#iva').text("Si");
    $('#ivaincluido').value("1");
  }else{
    $('#iva').text("No");
    $('#ivaincluido').value("0");
  }
}
    </script>
