<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="col-sm-5 col-xs-12">
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

    <center>
      <h5 class="mb-1">
        @if ($tipo == 2)
          Datos de la venta
        @else
          Datos de la compra
        @endif
      </h5>
    </center>
    <div class="ln_solid mb-1 mt-1"></div>
    <div class="row">
      @if ($tipo==2)
        <div class="form-group col-sm-12">
          <input type="hidden"name="estado" value="0">
          <label class="" for="factura"># Factura *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-barcode"></i></div>
            </div>
            {!! Form::text('factura',null,['class'=>'form-control form-control-sm','placeholder'=>'Factura']) !!}
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label class="" for="factura">Cliente *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            {!! Form::text('f_clientea',null,['class'=>'form-control form-control-sm','placeholder'=>'Cliente','id'=>'f_clientea','readonly'=>'readonly']) !!}
            <span class="input-group-btn">
              <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal2" onclick="limpiarTabla()">
                <i class="fas fa-save"></i>
              </a>
              <a class="btn btn-danger btn-sm" onclick="limpiarCliente()">
                <i class="fas fa-times" style="color:#fff;"></i>
              </a>
            </span>
          </div>
        </div>
      @else
        <input type="hidden"name="estado" value="1">
        <div class="form-group col-sm-12">
          <label class="" for="factura">Fecha *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-calendar"></i></div>
            </div>
            {!! Form::date('fecha',$fecha,['class'=>'form-control form-control-sm']) !!}
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label class="" for="factura">Proveedor *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            {!!Form::select('f_proveedor',
              App\Transacion::arrayProveedores()
              ,null, ['class'=>'form-control form-control-sm','id'=>'f_proveedor'])!!}
          </div>
        </div>
      @endif
    </div>
    <center>
      <h5 class="mb-1">
        Búsqueda
      </h5>
    </center>
    <div class="ln_solid mb-1 mt-1"></div>
    <div class="row">
      <div class="form-group col-sm-12">
        <label class="" for="codigo">Código *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-barcode"></i></div>
          </div>
          {!! Form::text('codigo',null,['id'=>'codigoBuscar','class'=>'form-control form-control-sm','placeholder'=>'Código']) !!}
        </div>
      </div>
      <div class="form-group col-sm-12">
        <label class="" for="producto">Producto *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-shopping-cart"></i></div>
          </div>
          {!! Form::text('producto',null,['readonly' => 'readonly','id'=>'producto','class'=>'form-control form-control-sm','placeholder'=>'Producto']) !!}
        </div>
      </div>
      <div class="form-group col-sm-12">
        <label class="" for="producto">Cantidad *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-cubes"></i></div>
          </div>
          {!! Form::number('cantidadp',1,['id'=>'cantidadp','class'=>'form-control form-control-sm','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
        </div>
      </div>
    </div>
    <div class="x_panel">
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
  </div>

  <div class="x_panel">
    <center>
      <div class="btn-group">
        {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
        <a href="/blissey/public/transacciones?tipo={{$tipo}}" class="btn btn-default btn-sm">Cancelar</a>
      </div>
    </center>
  </div>
</div>
<div class="col-sm-7 col-xs-12">
  <div class="x_panel">
    <center>
      <h5 class="mb-1">
          Detalles de venta *
      </h5>
    </center>
    <div class="ln_solid mb-1 mt-1"></div>
    <table class="table table-sm" id="tablaDetalle">
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
@if ($tipo==2)
  @include('Transacciones.Formularios.modalBuscarVenta')
  @include('Recetas.modal.medicamento')
@endif
@if($tipo==0)
  @include('Transacciones.Formularios.modalBuscarProducto')
@endif
@include('Transacciones.Formularios.modalBuscarCliente')
