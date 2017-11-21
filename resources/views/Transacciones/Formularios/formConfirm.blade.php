<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
    <div class="row">
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
      <input type="hidden" id="confirmar" name="confirmar" value="{{true}}">
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::date('fecha',$transaccion->fecha,['class'=>'form-control has-feedback-left']) !!}
      </div>
      @if ($tipo==1)
          <label class="col-md-1 col-sm-12 col-xs-12 form-group">Cliente *</label>
          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
            <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
            {!!Form::select('f_cliente',
              App\Transacion::arrayClientes()
              ,null, ['placeholder' => 'Seleccione un proveedor','class'=>'form-control has-feedback-left'])!!}
          </div>
      @else
          <label class="col-md-2 col-sm-12 col-xs-12 form-group">Proveedor *</label>
          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
            <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
            {!!Form::select('f_proveedor',
              App\Transacion::arrayProveedores()
              ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'f_proveedor'])!!}
          </div>
      @endif
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">N° de factura *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('factura',null,['class'=>'form-control has-feedback-left']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Descuento general *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-percent form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('factura',0,['class'=>'form-control has-feedback-left']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Código </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('codigo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Código']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Producto </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('producto',null,['class'=>'form-control has-feedback-left','placeholder'=>'Producto']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Cantidad </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Opciones </label>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="#" class="btn btn-default">Agegar</a>
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
        {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
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
            @foreach ($detalles as $detalle)
              <tr>
                <td style="width: 10%">
                  {!! Form::number('cantidad[]',$detalle->cantidad,['class'=>'form-control','placeholder'=>'Cantidad']) !!}
                </td>
                <td style="width: 20%">{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}</td>
                <td style="width: 15%">{{$detalle->divisionProducto->producto->nombre}}</td>
                <td style="width: 10%">
                    {!! Form::number('descuento[]',null,['class'=>'form-control','placeholder'=>'%']) !!}
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
                  <input type='hidden' name='f_producto[]' value ='{{$detalle->f_producto}}'>
                  <button type='button' class='btn btn-xs btn-danger' id='eliminar_fila_pedido'>
                  <i class='fa fa-remove'></i>
                  </button>
                </td>
            </tr>
            @endforeach
        </table>
      </div>
      </div>
      {{--  MODAL INICIO--}}
      <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Buscar</h4>
            </div>

            <div class="modal-body">
              <div class="x_panel" style="height:600px">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
                    {!! Form::text('resultado',null,['id'=>'resultado','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
                    {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12"></div>
                  <div class="col-md-8 col-xs-12">
                    <h4 class="StepTitle">Resultado de busqueda</h4>
                    <table class="table" id="tablaBuscar">
                      <thead>
                        <th colspan="2">Resultado</th>
                        <th style="width : 80px">Acción</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
        {{-- MODAL FINAL --}}
    </div>
