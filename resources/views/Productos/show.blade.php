@extends('dashboard')
@section('layout')
  @php
  $index = false;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Producto
          <small>
            {{ $producto->nombre}}
          </small>
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            @include('Productos.Formularios.activate')
          </div>
        </div>
        <br>
        {{-- Incio de tab --}}
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Personales</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Otro panel</a>
            </li>
          </ul>
          {{-- Contenido del tab --}}
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <div class="col-md-6 col-xs-12">
                <table class="table">
                  <caption>Datos del producto</caption>
                  <tr>
                    <th>Nombre</th>
                    <td>{{ $producto->nombre }}</td>
                  </tr>
                  <tr>
                    <th>Droguería</th>
                    <td>{{$producto->nombreProveedor($producto->f_proveedor)}}</td>
                  </tr>
                  <tr>
                    <th>Presentación</th>
                    <td>{{$producto->nombrePresentacion($producto->f_presentacion)}}</td>
                  </tr>
                  <tr>
                    <th>Estado</th>
                    <td>{{ ($producto->estado)?"Activo":"En Papelera" }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de creación</th>
                    <td>{{ $producto->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de modificación</th>
                    <td>{{ $producto->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6 col-xs-12">
                <table class="table">
                  <caption>Divisiones</caption>
                  <thead>
                    <th>#</th>
                    <th>Código</th>
                    <th>División</th>
                    <th>Cantidad/Contenido</th>
                    <th>Precio</th>
                  </thead>
                  @php
                    $contador_division = 1;
                  @endphp
                  <tbody>
                    @if (count($divisiones)>0)
                      @foreach ($divisiones as $division)
                        <tr>
                          <td>{{$contador_division}}</td>
                          <td>{{$division->codigo}}</td>
                          <td>{{$division->nombreDivision($division->f_division)}}</td>
                          <td>
                            @if ($division->contenido!=null)
                              {{$division->cantidad.' '.$division->unidad->nombre}}
                            @else
                            {{$division->cantidad.' '.$producto->nombrePresentacion($producto->f_presentacion)}}
                          @endif
                          </td>
                          <td>{{'$ '.number_format($division->precio,2,'.','.')}}</td>
                        </tr>
                        @php
                          $contador_division++;
                        @endphp
                      @endforeach
                    @else
                      <tr>
                        <td colspan="4">
                          <center>
                            No hay registros
                          </center>
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                <table class="table">
                  <caption>Componentes</caption>
                  <thead>
                    <th>#</th>
                    <th>Componente</th>
                    <th>Contenido</th>
                  </thead>
                  @php
                    $contador_compoenente = 1;
                  @endphp
                  <tbody>
                    @if (count($componentes)>0)
                      @foreach ($componentes as $componente)
                        <tr>
                          <td>{{$contador_compoenente}}</td>
                          <td>{{$componente->nombreComponente($componente->f_componente)}}</td>
                          <td>{{$componente->cantidad.' '.$componente->nombreUnidad($componente->f_unidad)}}</td>
                        </tr>
                        @php
                          $contador_compoenente++;
                        @endphp
                      @endforeach
                    @else
                      <tr>
                        <td colspan="4">
                          <center>
                            No hay registros
                          </center>
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            {{-- Otra pestaña --}}
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              Otra cosa
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
