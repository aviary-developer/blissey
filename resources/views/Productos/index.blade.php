@extends('principal')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  @include('Productos.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Fabricante</th>
            <th>Categoría</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($productos as $producto)
            <tr>
              <td>{{ $correlativo + $pagina }}</td>
              <td>
                <a href={{asset('/productos/'.$producto->id)}}>
                  {{ $producto->nombre }}
                </a>
              </td>
              <td>
                <a href={{asset('/proveedores/'.$producto->f_proveedor)}}></a>
                {{ $producto->nombreProveedor($producto->f_proveedor) }}
              </td>
              <td>{{$producto->categoriaProducto->nombre}}</td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Productos.Formularios.activate')
                  @else
                    @include('Productos.Formularios.desactivate')
                  @endif
                </center>
              </td>
            </tr>
            @php
            $correlativo++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{--Inicio modal  --}}
  <div class="modal fade" tabindex="-1" role="dialog" id="modal_busqueda" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-search"></i>
                Buscar Producto
              </h4>
            </center>
          </div>
        </div>
      </div>
      {!!Form::open(['route'=>'productos.index','method'=>'GET','role'=>'search'])!!}
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel">
            <div class="ln_solid mb-1 mt-1"></div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="" for="nombre">Proveedor</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  {!!Form::select('f_proveedor',
                    App\Proveedor::arrayProveedores(),
                    null,
                    ['class'=>'form-control has-feedback-left',
                    'id'=>'f_proveedor',
                    'placeholder'=>'Todos los proveedores'
                  ]
                  )!!}
                </div>
              </div>

              <div class="form-group col-sm-12">
                <label class="" for="nombre">Categoria</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-cog"></i></div>
                  </div>
                  {!!Form::select('f_categoria',
                    App\CategoriaProducto::arrayCategorias(),
                    null,
                    ['class'=>'form-control has-feedback-left',
                    'id'=>'f_categoria',
                    'placeholder'=>'Todos las categorías'
                  ]
                  )!!}
                </div>
              </div>
              @if ($estadoOpuesto)
                <input type="hidden" name="estado" value="0">
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="m_panel x_panel bg-transparent" style="border:0px !important">
            <center>
              {!! Form::submit('Buscar',['class'=>'btn btn-primary']) !!}
              <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
