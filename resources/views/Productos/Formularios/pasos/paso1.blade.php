@php
$presentaciones=App\Producto::arrayPresentaciones();
@endphp
<div class="flex-row">
  <center>
    <h5>Datos del Producto</h5>
  </center>
</div>
<div class="row">
  <div class="col-sm-12">


    <div class="form-group col-sm-6">
      <label class="" for="nombre">Nombre *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-cog"></i></div>
        </div>
        {!! Form::text(
          'nombre',
          null,
          ['class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre del producto',
          'id'=>'nombre'
        ]
        ) !!}
      </div>
    </div>

    <div class="form-group col-sm-6">
      <label class="" for="f_presentacion">Presentación *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-cube"></i></div>
        </div>
        {!!Form::select('f_presentacion',
          $presentaciones
          ,null, ['class'=>'form-control form-control-sm','id'=>'f_presentacion'])!!}
        </div>
      </div>

      <div class="form-group col-sm-6">
        <label class="" for="f_categoria">Categoría *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-cube"></i></div>
          </div>
          {!!Form::select('f_categoria',
            App\CategoriaProducto::arrayCategorias()
            ,null, ['class'=>'form-control form-control-sm','id'=>'f_categoria'])!!}
          </div>
        </div>

        <div class="form-group col-sm-6">
          <label class="" for="f_proveedor">Fabricante *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-cube"></i></div>
            </div>
            {!!Form::select('f_proveedor',
              App\Proveedor::arrayProveedores()
              ,null, ['class'=>'form-control form-control-sm','id'=>'f_proveedor'])!!}
            </div>
          </div>

          <div class="x_panel">
            @if($bandera==1)
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_agregar">
            @else
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="$('#valor').val($('#f_presentacion').find('option:selected').text())" data-target="#modal_agregar">
            @endif
              <i class="fas fa-plus"></i>
              Agregar División
            </button>
          </div>
          <h5>Divisiones agregadas</h5>

          <table class="table table-sm table-striped" id="tablaDivision">
            <thead>
              <th>Código</th>
              <th>División</th>
              <th>Cant/Cont</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Notificar</th>
              <th style="width : 80px">Acción</th>
            </thead>
            <tbody>
              @if (!$create)
                @php
                $auxiliar_division = 0;
                @endphp
                <input type="hidden" name="divisiones_eliminadas[]" value="ninguno" id="division_eliminada">
                @foreach ($divisiones_productos  as $key => $division)
                  <tr class="divis">
                    <td>{{$division->codigo}}</td>
                    <td>{{$division->nombreDivision($division->f_division)}}</td>
                    <td>@if ($division->contenido!=null)
                      {{$division->cantidad.' '.$division->unidad->nombre}}
                      @php
                          $auxC='Contenido';
                          $auxN=$division->unidad->nombre;
                      @endphp
                    @else
                      {{$division->cantidad.' '.$productos->nombrePresentacion($productos->f_presentacion)}}
                      @php
                          $auxC='Cantidad';
                          $auxN=$productos->nombrePresentacion($productos->f_presentacion);
                      @endphp
                    @endif</td>
                    <td>{{'$ '.number_format($division->precio,2,'.',',')}}</td>
                    <td>{{$division->stock}}</td>
                    <td>{{$division->num_meses($division->n_meses)}}
                      <td style="width:15%">
                        <div class="btn-group">
													@if(App\DetalleTransacion::cuenta($division->id))
													<button type="button" name="button" class="btn btn-sm btn-danger" id="eliminar_division_antigua">
														<i class="fas fa-times"></i>
													</button>
                          @else
													<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="Esta división no puede ser eliminada">
														<i class="fas fa-ban"></i>
													</button>
                          @endif
													<input type="hidden" id={{"division".$key}} value={{$division->f_division.$division->cantidad}}>
													<input type="hidden" value={{$division->id}}>
													<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal2" onclick="llenarDivision({{$division->id}},'{{$division->codigo}}',{{$division->precio}},{{$division->stock}},{{$division->n_meses}},{{$division->f_division}},{{$division->cantidad}},'{{$auxC}}','{{$auxN}}')">
														<i class="fas fa-edit"></i>
													</button>
                        </div>
                      </td>
                    </tr>
                    @php
                    $auxiliar_division = $key;
                    @endphp
                  @endforeach
                  <input type="hidden" id="contador_division" value={{$auxiliar_division}}>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        {{--Modales  --}}
        @include('Productos.Formularios.modales.modal_division')
        @include('Productos.Formularios.modales.modal_p')
        @include('Productos.Formularios.modales.modal_c')
        @include('Productos.Formularios.modales.modal_d')
        @include('Productos.Formularios.modales.modal_u')
        @include('Productos.Formularios.modales.modal_co')
        @include('Productos.Formularios.modales.modal_pr')
        <script type="text/javascript">
        function llenarDivision(id,codigo,precio,stock,meses,idd,cantidad,c,n){
          $('#idDiv').val(id);
          $('#pre').val(precio);
          $('#stock').val(stock);
          $('#cod').text(codigo);
          $('#codi').val(codigo);
          $('#mes').val(meses);
          $('#div').val(idd);
          $('#cante').val(cantidad);
          $('#auxC').text(c);
          $('#auxN').val(n);
        }
        </script>
