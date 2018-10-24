<?php use App\Http\Controllers\TransaccionController; ?>
<div class="col-sm-5 col-xs-12">
  <div class="alert alert-danger" id="mout">
    <center>
      <p>El campo marcado con un * es <b>obligatorio</b>.</p>
    </center>
  </div>
  <div class="x_panel">
    <input type="hidden" value="" id="idoculto">
    <input type="hidden" value="" id="divoculto">
    <input type="hidden" value="" id="nomoculto">
    <input type="hidden" value="" id="preoculto">
    <input type="hidden" value="" id="exioculto">


    @if($tipo==2)
      <input type="hidden" name="fecha" value="{{$fecha}}">
    @endif
    <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
    <input type="hidden" id="confirmar" name="confirmar" value="{{false}}">

    <div class="row">
      @if ($tipo == 2)
        <center>
          <h4>Datos de la venta</h4>
        </center>
      @else
        <center>
          <h4>Datos de la compra</h4>
        </center>
      @endif
    </div>

    <div class="row">
      @if($tipo==2)
        <input type="hidden"name="estado" value="0">
        <div class="col-xs-12 form-group">
          <label class="col-xs-3 label-control"># Factura: *</label>
          <div class="col-xs-9">
            <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('factura',null,['class'=>'form-control has-feedback-left','placeholder'=>'Factura']) !!}
          </div>
        </div>
      @else
        <input type="hidden"name="estado" value="1">
        <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
        <div class="col-md-4 col-sm-12 col-xs-12 form-group">
          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
        </div>
      @endif

      @if ($tipo==2)
        <div class="col-xs-12 form-group">
          <label class="label-control col-xs-3 ">Cliente: *</label>
          <div class="col-xs-9">
            <div class="input-group">
              {!! Form::text('f_clientea',null,['class'=>'form-control','placeholder'=>'Cliente','id'=>'f_clientea','readonly'=>'readonly']) !!}
              <input type="hidden" name="f_cliente" value="" id="f_cliente">
              <span class="input-group-btn">
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal2" onclick="limpiarTabla()">
                  <i class="fa fa-save"></i>
                </a>
                <a class="btn btn-danger" onclick="limpiarCliente()">
                  <i class="fa fa-remove"></i>
                </a>
              </span>
            </div>
          </div>
        </div>
      @else
        <label class="col-md-2 col-sm-12 col-xs-12 form-group">Proveedor *</label>
        <div class="col-md-4 col-sm-12 col-xs-12 form-group">
          <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
          {!!Form::select('f_proveedor',
            App\Transacion::arrayProveedores()
            ,null, ['class'=>'form-control has-feedback-left','id'=>'f_proveedor'])!!}
        </div>
      @endif
    </div>

  </div>

  <div class="x_panel">
    <div class="row">
      <center>
        <h4>Busqueda</h4>
      </center>
    </div>
    <div class="row">
      <div class="col-xs-12 form-group">
        <label class="col-xs-3 label-control">Código: </label>
        <div class="col-xs-9">
          <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
          {!! Form::text('codigo',null,['id'=>'codigoBuscar','class'=>'form-control has-feedback-left','placeholder'=>'Código']) !!}
        </div>
      </div>

      <div class="col-xs-12 form-group">
        <label class="col-xs-3 label-control">Producto: </label>
        <div class="col-xs-9">
          <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
          {!! Form::text('producto',null,['readonly' => 'readonly','id'=>'producto','class'=>'form-control has-feedback-left','placeholder'=>'Producto']) !!}
        </div>
      </div>

      <div class="col-xs-12 form-group">
        <label class="col-xs-3 label-control">Cantidad: </label>
        <div class="col-xs-9">
          <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
          {!! Form::number('cantidadp',1,['id'=>'cantidadp','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
        </div>
      </div>
    </div>

    <div class="row">
      <center>
        <div class="btn-group">
          <a href="#" class="btn btn-success btn-sm" id="agregar">
            <i class="fa fa-plus"></i> Agregar
          </a>
        </div>

        <div class="btn-group">
          <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-default btn-sm" data-tooltip="tooltip" title="Buscar">
            <i class="fa fa-search"></i>
          </button>

        @if ($tipo == 2)
          <button type="button" data-tooltip="tooltip" title="Buscar Receta" class="btn btn-sm btn-default" data-toggle="modal" data-target="#medicamento_m">
            <i class="fa fa-medkit"></i>
          </button>
        @endif
        </div>
      </center>
    </div>

    <div class="ln_solid"></div>

    <div class="row">
      <center>
        <div class="btn-group">
          <a href="/blissey/public/transacciones?tipo={{$tipo}}" class="btn btn-default btn-sm">Cancelar</a>

           {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
        </div>
      </center>
    </div>
  </div>
</div>

<div class="col-sm-7 col-xs-12">
  <div class="x_panel" style="height: 463px;">
    <div class="row">
      <center>
        <h4>Detalles</h4>
      </center>
    </div>
    <div class="row">
      <table class="table" id="tablaDetalle">
        <thead>
          <th>Cant</th>
          <th colspan="2">Detalle</th>
          @if($tipo==2)
            <th style="width : 80px">Precio</th>
            <th style="width : 100px">Subtotal</th>
          @endif
          <th style="width : 80px">Acción</th>
        </thead>
        @if(isset($f_producto))
          @php
            $conteo;
          @endphp
          @for ($i=0; $i < count($f_producto); $i++)
            <tr>
              <td>{{$cantidad[$i]}}</td>
              @php
                $division=App\DivisionProducto::find($f_producto[$i]);
                $pmp=TransaccionController::nombrePresentacion($division->f_producto,2);//Retorna producto + presentación
              @endphp
              <td>{{TransaccionController::nombreDivision($division->f_division)." ".$division->cantidad." ".$pmp->presentacion->nombre}}</td>
              <td>{{$pmp->nombre}}</td>
              @if ($tipo==2)
                <td>$ {{number_format($precio[$i],2,'.','.')}}</td>
                <td>$ {{number_format($cantidad[$i]*$precio[$i],2,'.','.')}}</td>
              @endif
              <td>
                <input type='hidden' name='f_producto[]' value ={{$f_producto[$i]}}>
                <input type='hidden' name='cantidad[]' value ={{$cantidad[$i]}}>
                @if ($tipo==2)
                <input type='hidden' name='precio[]' value ={{$precio[$i]}}>
                <input type='hidden' name='tipo_detalle[]' value ={{$tipo_detalle[$i]}}>
                @endif
                <button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>
                <i class='fa fa-remove'></i>
                </button>
              </td>
            </tr>
            <input type='hidden' id={{"f_prod".$i}} value ={{$f_producto[$i]}}>
            @php
              $conteo=$i;
            @endphp
          @endfor
          <input type='hidden' id='contador' value ={{$conteo}}>
        @endif
      </table>
    </div>
  </div>
</div>

@if ($tipo==2)
  @include('Transacciones.Formularios.modalBuscarVenta')
  @include('Recetas.modal.medicamento')
@endif
@if($tipo==0)
  @include('Transacciones.Formularios.modalBuscarProducto')
@endif
@include('Transacciones.Formularios.modalBuscarCliente')
