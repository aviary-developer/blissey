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
              <a href="#tab_show_1" id="tab_s_1" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            @if ($ingreso->estado != 0) 
              <li role="presentation" class="">
                <a href="#tab_show_4" id="tab_s_4" role="tab" data-toggle="tab" aria-expanded="false">Estado Financiero</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_show_6" id="tab_s_6" role="tab" data-toggle="tab" aria-expanded="false">Servicios Médicos</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_show_3" id="tab_s_3" role="tab" data-toggle="tab" aria-expanded="false">Laboratorio Clínico</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_show_2" id="tab_s_2" role="tab" data-toggle="tab" aria-expanded="false">Tratamiento</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_show_5" id="tab_s_5" role="tab" data-toggle="tab" aria-expanded="false">Servicios Hospitalarios</a>
              </li>
            @endif
          </ul>
        </div>
        {{-- Contenido del tab --}}
        <div class="col-xs-10">
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_show_1" aria-labelledby="tab_s_1">
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
                    <a href="#" data-toggle="modal" data-target="#modal_datos_paciente">
                      {{$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}
                    </a>
                    <input type="hidden" id="f_paciente" value={{$ingreso->f_paciente}}>
                    <input type="hidden" id="id" value={{$ingreso->id}}>
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
            @if ($ingreso->estado != 0)    
              <div class="tab-pane fade" role="tabpanel" id="tab_show_2" aria-labelledby="tab_s_2">
                @include('Ingresos.Formularios.show.medicamento')
              </div>
              <div class="tab-pane fade" role="tabpanel" id="tab_show_4" aria-labelledby="tab_s_4">
                @include('Ingresos.Formularios.show.financiero')
              </div>
              <div class="tab-pane fade" role="tabpanel" id="tab_show_3" aria-labelledby="tab_s_3">
                @include('Ingresos.Formularios.show.laboratorio')
              </div>
              <div class="tab-pane fade" role="tabpanel" id="tab_show_5" aria-labelledby="tab_s_5">
                @include('Ingresos.Formularios.show.servicio')
              </div>
              <div class="tab-pane fade" role="tabpanel" id="tab_show_6" aria-labelledby="tab_s_6">
                @include('Ingresos.Formularios.show.medicos')
              </div>
              <input type="hidden" id="transaccion" value={{$ingreso->transaccion->id}}>
              <input type="hidden" id="tokenTransaccion" name="tokenTransaccion" value="<?php echo csrf_token(); ?>">
              @include('Ingresos.Formularios.modal_examen')
              @include('Ingresos.Formularios.show.modal_transaccion')
              @include('Ingresos.Formularios.show.modal_medico')
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('Ingresos.Formularios.show.modal_datos_paciente')
@endsection
