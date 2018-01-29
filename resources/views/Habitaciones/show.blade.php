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
        Habitación {{ $habitacion->numero }}
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
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Otros</a>
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
                  <th>Número</th>
                  <td>{{ 'Habitación '.$habitacion->numero }}</td>
                </tr>
                <tr>
                  <th>Precio</th>
                  <td>{{ '$ '.number_format($habitacion->precio,2,'.',',') }}</td>
                </tr>
                <tr>
                  <th>Disponibilidad</th>
                  <td>
                    @if ($habitacion->ocupado)
                      <span class="label label-danger col-md-4 col-sm-4 col-xs-4 label-lg">Ocupada</span>
                    @else
                      <span class="label label-success col-md-4 col-sm-4 col-xs-4 label-lg">Disponible</span>
                    @endif
                  </td>
                </tr>
                @if ($habitacion->ocupado)
                  <tr>
                    <th>Paciente en la habitación</th>
                    <td>
                      <a href={{asset('/ingresos/'.$paciente->id)}}>
                        {{$paciente->paciente->apellido.', '.$paciente->paciente->nombre}}
                      </a>
                    </td>
                  </tr>
                @endif
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($habitacion->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
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
</div>
@endsection
