@php
  $presentaciones=App\Producto::arrayPresentaciones();
@endphp
<div class="flex-row">
  <center>
    <h5>Datos Personales</h5>
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
            'placeholder'=>'Nombre del proveedor',
            'id'=>'nombre'
          ]
        ) !!}
      </div>
    </div>

    <div class="form-group col-sm-6">
      <label class="" for="nombre">Presentación *</label>
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
        <label class="" for="nombre">Categoría *</label>
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
          <label class="" for="nombre">Proveedor *</label>
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
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_agregar">
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
                    @else
                      {{$division->cantidad.' '.$productos->nombrePresentacion($productos->f_presentacion)}}
                    @endif</td>
                    <td>{{'$ '.number_format($division->precio,2,'.',',')}}</td>
                    <td>{{$division->stock}}</td>
                    <td>{{$division->num_meses($division->n_meses)}}
                    <td>
                      <input type="hidden" id={{"division".$key}} value={{$division->f_division.$division->cantidad}}>
                      <input type="hidden" value={{$division->id}}>
                      @if(App\DetalleTransacion::cuenta($division->id))
                        <button type="button" name="button" class="btn btn-xs btn-danger" id="eliminar_division_antigua">
                          <i class="fa fa-remove"></i>
                        </button>
                      @else
                        <button type="button" class="btn btn-xs btn-danger disabled" data-toggle="tooltip" data-placement="top" title="Esta división no puede ser eliminada">
                          <i class="fa fa-warning"></i>
                        </button>
                      @endif
                      <a data-toggle="tooltip" data-placement="top" title="Editar">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal2" onclick="llenarDivision({{$division->id}},'{{$division->codigo}}',{{$division->precio}},{{$division->stock}},{{$division->n_meses}})">
                          <i class="fa fa-edit"></i>
                        </button>
                      </a>
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
@include('Productos.Formularios.modales.modal_division')
    <script type="text/javascript">
    function llenarDivision(id,codigo,precio,stock,meses){
      $('#idDiv').val(id);
      $('#pre').val(precio);
      $('#stock').val(stock);
      $('#cod').val(codigo);
      $('#mes').val(meses);
    }
  </script>
