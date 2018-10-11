{{-- @extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="row bg-blue">
      <center>
        <h3>Categoría de Producto
            <small class="label-white badge blue ">{{ $categoria->nombre}}</small>
        </h3>
      </center>
    </div>
    @include('CategoriaProductos.Formularios.activate')
</div>
  <div class="x_panel">
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
        </div>
      </div>
      <br>

      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Productos</a>
            </li>
          </ul>
        </div>
        <div class="col-xs-10">

          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <h3>Información General</h3>
              <table class="table">
                <tr>
                  <th>Nombre</th>
                  <td>{{ $categoria->nombre }}</td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($categoria->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $categoria->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $categoria->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>

            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              <h3>Productos de la categoría: <small>{{$categoria->nombre}}</small></h3>
              <table class="table">
                @php
                $productos=App\CategoriaProducto::productos($categoria->id);
                $contador=1;
                @endphp
                @if (count($productos)>0)
                <tr>
                  <th>#</th>
                  <th>Productos</th>
                </tr>
                  @foreach ($productos as $producto)
                    <tr>
                      <td>{{$contador}}</td>
                      <td>{{$producto->nombre}}</td>
                  </tr>
                  @php
                  $contador++;
                  @endphp
                  @endforeach
                @else
                  <tr><td colspan="2">
                    <center>
                      No hay productos asociados a esta categoría
                    </center>
                  </td></tr>
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection --}}


@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('CategoriaProductos.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          Productos
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('CategoriaProductos.Partes.datos_productos')
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  @include('CategoriaProductos.Partes.datos_categoria')
</div>
<input type="hidden" id="id-p" value={{$categoria->id}}>
@endsection
