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
        Habitación
        <small>
          {{ 'número '.$habitacion->numero }}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Habitaciones.Formularios.activate')
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Generales</a>
          </li>
          <li role="presentation" class="">
            <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Otros</a>
          </li>
        </ul>
        {{-- Contenido del tab --}}
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
            <table class="table">
              <tr>
                <th>Número</th>
                <td>{{ $habitacion->numero }}</td>
              </tr>
              <tr>
                <th>Precio</th>
                <td>{{ '$ '.number_format($habitacion->precio,2,'.',',') }}</td>
              </tr>
              <tr>
                <th>Disponibilidad</th>
                <td>{{ ($habitacion->ocupado)?"Ocupada":"Disponible" }}</td>
              </tr>
              <tr>
                <th>Estado</th>
                <td>{{ ($habitacion->estado)?"Activo":"En Papelera" }}</td>
              </tr>
              <tr>
                <th>Fecha de creación</th>
                <td>{{ $habitacion->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
              </tr>
              <tr>
                <th>Fecha de modificación</th>
                <td>{{ $habitacion->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
              </tr>
            </table>
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
