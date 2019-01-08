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
      <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
      <input type="hidden" id="confirmar" name="confirmar" value="{{false}}">
  
      <center>
        <h5 class="mb-1">
            Datos de la compra
        </h5>
      </center>
      <div class="ln_solid mb-1 mt-1"></div>
      <div class="row">
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
            <input type="hidden" name="f_proveedor" id="f_proveedor" value="{{$f_proveedor}}">
            {!!Form::text('lfp',App\Proveedor::find($f_proveedor)->nombre,['class'=>'form-control form-control-sm','readonly'=>'readonly'])!!}
            </div>
          </div>
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
      </div>
      <div class="x_panel">
        <center>
          <div class="btn-group">
            <a href="#" class="btn btn-success btn-sm" id="agregarStock">
              <i class="fa fa-plus"></i> Agregar
            </a>
          </div>
  
          <div class="btn-group">
            <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-success btn-sm" title="Buscar">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </center>
      </div>
    </div>
  
    <div class="x_panel">
      <center>
        <div class="btn-group">
          {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
          <a href="../transacciones?tipo={{$tipo}}" class="btn btn-light btn-sm">Cancelar</a>
        </div>
      </center>
    </div>
  </div>
  <div class="col-sm-7 col-xs-12">
    <div class="x_panel">
      <center>
        <h5 class="mb-1">
            Detalles*
        </h5>
      </center>
      <div class="ln_solid mb-1 mt-1"></div>
      <table class="table table-sm" id="tablaDetalle">
        <thead>
          <th>Cant</th>
          <th colspan="2">Detalle</th>
          <th style="width : 80px">Acción</th>
        </thead>
        <tbody>
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
                  <td><button type='button' class='btn btn-sm btn-danger' onclick="borrarFila({{$division->id}})">
                  <i class='fas fa-times'></i>
                  </button></td>
                  </tr>
                  <input type="hidden" id="f_prod{{$contador}}" value="{{$division->id}}">
                  @php
                    $contador++;
                  @endphp
                @endforeach
                  <input type="hidden" id="contador" value="{{$contador-1}}">
              </tbody>
        </tbody>
      </table>
    </div>
  </div>
    @include('Transacciones.Formularios.modalBuscarProducto')
  