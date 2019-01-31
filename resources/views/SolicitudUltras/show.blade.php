@extends('dashboard')
@section('layout')
  @php
  $index = false;
  $show= true;
  setlocale(LC_ALL,'es');
  $hoy = Carbon\Carbon::now();
  @endphp
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
        {{$solicitud->ultrasonografia->nombre}} evaluada
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
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
                <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Observación</a>
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
                    <th>Paciente</th>
                    <td>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</td>
                  </tr>
                  <tr>
                    <th>Imágenes de Rayos X</th>
                    <td>
                    <button type="button" class="btn btn-xs btn-success col-xs-4" data-toggle="modal" data-target="#verRadiografia">
                      <i class="fa fa-eye"></i>
                      Ver imagen
                    </button></td>
                  </tr>
                  <tr>
                    <th>Fecha de creación de solicitud</th>
                    <td>{{ $solicitud->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de modificación</th>
                    <td>{{ $solicitud->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                </table>
              </div>
              {{-- Otra pestaña --}}
              <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                <div class="x_panel">
                @php
    						echo $resultado->observacion;
    						@endphp
              </div>
              <div class="x_panel">
                <div class="flex-row">
                  <center>
                    <h5>Evaluó:</h5>
                  </center>
                </div>
                <div class="flex-row">
                  <center>
                    <span>
                      Lic. {{$resultado->laboratorista->nombre}} {{$resultado->laboratorista->apellido}}
                    </span>
                  </center>
                </div>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@include('SolicitudUltras.Formularios.verUltrasonografia')
@endsection
