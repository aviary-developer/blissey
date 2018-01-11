<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
    <div class="row">
      <input type="hidden" value="" id="idoculto">
      <input type="hidden" value="" id="divoculto">
      <input type="hidden" value="" id="nomoculto">
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
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
        {!! Form::text('factura',null,['class'=>'form-control has-feedback-left']) !!}
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
        {!! Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
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
        {!! Form::submit('Confirmar',['class'=>'btn btn-primary']) !!}
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <h4 class="StepTitle">Detalles</h4>
        <table class="table" id="tablaDetalle">
          <thead>
            <th>Cantidad</th>
            <th colspan="2">Detalle</th>
            <th>Descuento</th>
            <th>Fecha de vencimiento</th>
            <th>Precio</th>
            <th>Lote</th>
            <th style="width : 80px">Acción</th>
          </thead>
            @php
            $detalles=$transaccion->detalleTransaccion;
            @endphp
            @foreach ($detalles as $key => $detalle)
              <tr>
                <td style="width: 10%">
                  {!! Form::number('cantidad[]',$detalle->cantidad,['class'=>'form-control','placeholder'=>'Cantidad','min'=>'1','onKeyPress' => 'return entero( this, event,this.value);']) !!}
                </td>
                <td style="width: 20%">
                @if ($detalle->divisionProducto->unidad==null)
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                @else
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                @endif
                </td>
                <td style="width: 15%">{{$detalle->divisionProducto->producto->nombre}}</td>
                <td style="width: 10%">
                    {!! Form::number('descuento[]',null,['class'=>'form-control','placeholder'=>'%','min'=>'0']) !!}
                </td>
                <td style="width: 10%">
                  {!! Form::date('fecha_vencimiento[]',null,['class'=>'form-control']) !!}
                </td>
                <td style="width: 10%">
                  {!! Form::number('precio[]',null,['class'=>'form-control','placeholder'=>'Precio']) !!}
                </td>
                <td style="width: 10%">
                  {!! Form::text('lote[]',null,['class'=>'form-control','placeholder'=>'N° de lote']) !!}
                </td>
                <td>
                  <input type="hidden" id={{"f_prod".$key}} value={{$detalle->f_producto}}>
                  <input type='hidden' name='estado[]' value ='{{$detalle->id}}'>
                  <input type='hidden' name='f_producto[]' value ={{$detalle->f_producto}}>
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
      </div>
      </div>
@include('Transacciones.Formularios.modalBuscarProducto')
    </div>
