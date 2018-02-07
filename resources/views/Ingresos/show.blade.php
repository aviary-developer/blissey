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
        Hospitalización <small>{{ $ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y') }}</small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          @include('Ingresos.Formularios.desactivate')
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
                  <th>Expediente</th>
                  <td>{{ $ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y') }}</td>
                </tr>
                <tr>
                  <th>Habitación</th>
                  <td>
                    <a href={{asset('/habitaciones/'.$ingreso->f_habitacion)}}>
                      {{'Habitación '.$ingreso->habitacion->numero}}
                    </a>
                  </td>
                </tr>
                <tr>
                  <th>Paciente</th>
                  <td>
                    <a href={{asset('/pacientes/'.$ingreso->f_paciente)}}>
                      {{$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}
                    </a>
                  </td>
                </tr>
                @if ($ingreso->f_paciente != $ingreso->f_responsable)
                  <tr>
                    <th>Responsable</th>
                    <td>
                      <a href={{asset('/pacientes/'.$ingreso->f_responsable)}}>
                        {{$ingreso->responsable->nombre.' '.$ingreso->responsable->apellido}}
                      </a>
                    </td>
                  </tr>
                @endif
                <tr>
                  <th>Médico</th>
                  <td>
                    <a href={{asset('/usuarios/'.$ingreso->f_medico)}}>
                      {{(($ingreso->medico->sexo)?'Dr. ':'Dra. ').$ingreso->medico->nombre.' '.$ingreso->medico->apellido}}
                    </a>
                  </td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($ingreso->estado==1)
                      <span class="label label-lg label-primary col-xs-4">{{($ingreso->paciente->sexo)?"Hospitalizado":"Hospitalizada"}}</span>
                    @elseif($ingreso->estado == 0)
                      <span class="label label-lg label-warning col-xs-4">Pendiente de acta</span>
                    @else
                      <span class="label label-lg label-success col-xs-4">Con alta</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de ingreso</th>
                  <td>{{ $ingreso->fecha_ingreso->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $ingreso->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $ingreso->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
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
