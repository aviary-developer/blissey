@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        Reactivo
        <small>
          {{ $reactivo->nombre.' '.$reactivo->apellido }}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Reactivos.Formularios.activate')
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Movimiento de existencias</a>
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
                  <td>{{ $reactivo->nombre }}</td>
                </tr>
                <tr>
                  <th>Fecha de vencimiento</th>
                  <td>{{ $reactivo->fechaVencimiento }}</td>
                </tr>
                <tr>
                  <th>Existencias</th>
                  <td>{{ $reactivo->contenidoPorEnvase.' ' }}</td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($reactivo->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $reactivo->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $reactivo->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
            {{-- Otra pestaña --}}
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              <h3>Movimientos de existencias</h3>
              <table class="table table-striped" id="index-table">
                <thead>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Anterior</th>
                <th>Movimiento</th>
                <th>Posterior</th>
              </thead>
              <tbody>
              @foreach ($movimientos as $key => $movimiento)
              <tr>
                <td>{{$movimiento->created_at->formatLocalized('%d/%m/%Y  %H:%M:%S')}}</td>
                <td>{{$movimiento->descripcionExistencias}}</td>
                <td align="right">{{$movimiento->anterior}}</td>
                <td align="right">{{$movimiento->movimiento}}</td>
                <td align="right">{{$movimiento->posterior}}</td>
              </tr>
              @endforeach
            </tbody>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
