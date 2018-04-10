<?php use App\Http\Controllers\TransaccionController; ?>
<div class="x_content">
    <div class="row">
      <input type="hidden" value="" id="idoculto">
      <input type="hidden" value="" id="divoculto">
      <input type="hidden" value="" id="nomoculto">
      <input type="hidden" value="" id="exioculto">
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
      <input type="hidden" id="confirmar" name="confirmar" value="{{false}}">

      <input type="hidden"name="estado" value="1">
      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Fecha *</label>
      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
      </div>

          <label class="col-md-2 col-sm-12 col-xs-12 form-group">Proveedor </label>
          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
            <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
            <input type="hidden" name="f_proveedor" id="f_proveedor" value="{{$f_proveedor}}">
            {!!Form::text('lfp',App\Proveedor::find($f_proveedor)->nombre,['class'=>'form-control has-feedback-left','readonly'=>'readonly'])!!}
          </div>
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

      <label class="col-md-2 col-sm-12 col-xs-12 form-group">Opciones </label>
      <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <a href="#" class="btn btn-default" id="agregarStock">Agregar</a>
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
        <h4 class="StepTitle">Detalles *</h4>
        <table class="table" id="tablaDetalle">
          <thead>
            <th>Cantidad</th>
            <th colspan="2">Detalle</th>
            <th style="width : 100px">Acción</th>
          </thead>
          <tbody>
            @php
              $contador=0;
            @endphp
            @foreach ($divisiones as $division)
              <tr id="fila{{$division->id}}">
                <td style="width:15%">
                  {!!Form::text('cantidad[]',null,['class'=>'form-control'])!!}
                </td>
                <td>{{$division->nombreDivision($division->f_division)}}
                @if ($division->contenido!=null)
                  {{$division->cantidad.' '.$division->unidad->nombre}}
                @else
                {{$division->cantidad.' '.$division->producto->nombrePresentacion($division->producto->f_presentacion)}}
              @endif</td>
              <td>{{$division->producto->nombre}}</td>
              <input type='hidden' name='f_producto[]' value ='{{$division->id}}'>
              <td><button type='button' class='btn btn-xs btn-danger' onclick="borrarFila({{$division->id}})">
              <i class='fa fa-remove'></i>
              </button></td>
              </tr>
              <input type="hidden" id="f_prod{{$contador}}" value="{{$division->id}}">
              @php
                $contador++;
              @endphp
            @endforeach
              <input type="hidden" id="contador" value="{{$contador-1}}">
          </tbody>
        </table>
      </div>
      </div>
      <center>
        <p style="color:red">El campo marcado con un * es <b>obligatorio</b>.</p>
      </center>
    </div>
    @if($tipo==0)
      @include('Transacciones.Formularios.modalBuscarProducto')
    @endif
