<?php use App\Http\Controllers\TransaccionController; ?>
<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
    <div class="row">
      <input type="hidden" value="" id="idoculto">
      <input type="hidden" value="" id="divoculto">
      <input type="hidden" value="" id="nomoculto">
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
      <input type="hidden" id="confirmar" name="confirmar" value="{{false}}">
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
      </div>
      @if ($tipo==1)
          <label class="col-md-2 col-sm-12 col-xs-12 form-group">Cliente *</label>
          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
            <div class="input-group">
            <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('f_clientea',null,['class'=>'form-control has-feedback-left','placeholder'=>'Cliente','id'=>'f_clientea','readonly'=>'readonly']) !!}
            <input type="hidden" name="f_cliente" value="" id="f_cliente">
              <span class="input-group-btn">
                <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2" onclick="limpiarTabla()">
                  <i class="fa fa-save"></i>
                </button>
              </span>
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
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Código </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('codigo',null,['id'=>'codigoBuscar','class'=>'form-control has-feedback-left','placeholder'=>'Código']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Producto </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('producto',null,['readonly' => 'readonly','id'=>'producto','class'=>'form-control has-feedback-left','placeholder'=>'Producto']) !!}
      </div>

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Cantidad </label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('cantidadp',1,['id'=>'cantidadp','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
      </div>
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Opciones </label>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="#" class="btn btn-default" id="agregar">Agregar</a>
      </div>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-default">
          Buscar
        </button>
      </div>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="/blissey/public/transacciones?tipo={{$tipo}}" class="btn btn-default">Cancelar</a>
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
            @if($tipo==1)
            <th style="width : 120px">Precio</th>
            <th style="width : 120px">Subtotal</th>
            @endif
            <th style="width : 100px">Acción</th>
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
                <td>
                  <input type='hidden' name='f_producto[]' value ={{$f_producto[$i]}}>
                  <input type='hidden' name='cantidad[]' value ={{$cantidad[$i]}}>
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
      @if ($tipo)
        @include('Transacciones.Formularios.modalBuscarVenta')
      @else
        @include('Transacciones.Formularios.modalBuscarProducto')
      @endif
@include('Transacciones.Formularios.modalBuscarCliente')
    </div>
