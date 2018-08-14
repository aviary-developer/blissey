@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="row bg-blue">
      <center>
        <h3>Proveedor
            <small class="label-white badge blue ">{{ $proveedor->nombre}}</small>
        </h3>
      </center>
    </div>
    @include('Proveedores.Formularios.activate')
</div>
<div class="x_panel">
    <div class="x_content">
      <div class="row">
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="datos-tab2" role="tab" data-toggle="tab" aria-expanded="False">Visitadores</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content3" id="datos-tab3" role="tab" data-toggle="tab" aria-expanded="False">Productos</a>
            </li>
          </ul>
        </div>
        {{-- Contenido del tab --}}
        <div class="col-xs-10">
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <h3>Información General</h3>
              <table class="table">
                <tr>
                  <th>Nombre</th>
                  <td>{{ $proveedor->nombre }}</td>
                </tr>
                <tr>
                  <th>Correo</th>
                  <td>{{ $proveedor->correo }}</td>
                </tr>
                <tr>
                  <th>Teléfono</th>
                  <td>{{ $proveedor->telefono }}</td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($proveedor->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $proveedor->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $proveedor->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="datos-tab2">
              <h3>Visitadores</h3>
              @if (count($proveedor->visitador)>0)
                <div class="col-xs-10">

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Ver</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $correlativo = 1;
                      @endphp
                      @foreach ($proveedor->visitador as $visitador)
                        <tr>
                          <td>{{ $correlativo }}</td>
                          <td>
                            <a href={{asset('/visitadores/'.$visitador->id)}}>
                              {{ $visitador->nombre }}
                            </a>
                          </td>
                          <td>
                            <a href={{asset('/visitadores/'.$visitador->id)}}>
                              {{ $visitador->apellido }}
                            </a>
                          </td>
                          <td>{{ $visitador->telefono }}</td>
                          <td>
                            <a href={{asset('/visitadores/'.$visitador->id)}} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-info-circle"></i></a>
                          </td>
                        </tr>
                        @php
                        $correlativo++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <span>No hay visitadores asociados a este proveedor</span>
              @endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="datos-tab3">
              <h3>Productos del proveedor: <small>{{$proveedor->nombre}}</small></h3>
              <table class="table">
                @php
                $productos=App\Proveedor::productos($proveedor->id);
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
                      No hay productos asociados a este proveedor
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
@endsection
