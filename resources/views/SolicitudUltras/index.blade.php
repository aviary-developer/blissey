@extends('dashboard')
@section('layout')
  <div class="col-md-8 col-sm-8 col-xs-8">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Solicitud de Ultrasonografías
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="btn-group">
              <a href={{asset('/solicitudex/create')}} class="btn btn-sm btn-dark">
                <i class="fa fa-plus"></i> Nuevo
              </a>
              <a href={{asset('#')}} class="btn btn-sm btn-dark">
                <i class="fa fa-file"></i> Reporte
              </a>
              <div class="btn-group">
                <button type="button" class="btn btn-dark btn-sm">
                  <i class="fa fa-eye"></i> Ver
                </button>
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href={{asset("/solicitudex")}}>Por Examen</a>
                  </li>
                  <li><a href={{asset("/solicitudex?vista=paciente")}}>Por Paciente</a>
                  </li>
                </ul>
              </div>
              <a href={{'#'}} class="btn btn-primary btn-sm">
                <i class="fa fa-question"></i> Ayuda
              </a>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          @if($vista == "paciente")
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
              @foreach($pacientes as $k => $paciente)
                <div class="panel">
                  <a class="panel-heading collapsed" role="tab" id={{"H".$k}} data-toggle="collapse" data-parent="#accordion" href={{"#C".$k}}        aria-expanded="false" aria-controls={{"C".$k}}>
                    <h4 class="panel-title">
                      {{$paciente->nombrePaciente($paciente->f_paciente)}} <small><i class="fa fa-chevron-down"></i></small>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th class="col-md-2 col-sm-2">Código</th>
                          <th>Examen</th>
                          <th style="width: 120px">Opción</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_paciente == $paciente->f_paciente)
                              <tr>
                                <td>{{$solicitud->codigo_muestra}}</td>
                                <td>{{$solicitud->ultrasonografia->nombre}}</td>
                                <td id="celda">
                                  @include('SolicitudUltras.Formularios.delete')
                                </td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
              @foreach($examenes as $k => $examen)
                <div class="panel">
                  <a class="panel-heading collapsed" role="tab" id={{"H".$k}} data-toggle="collapse" data-parent="#accordion" href={{"#C".$k}}        aria-expanded="false" aria-controls={{"C".$k}}>
                    <h4 class="panel-title">
                      {{$examen->ultrasonografia->nombre}} <small><i class="fa fa-chevron-down"></i></small>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th class="col-md-2 col-sm-2">Código</th>
                          <th>Paciente</th>
                          <th style="width: 120px">Opción</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_examen == $examen->f_examen)
                              <tr>
                                <td>{{$solicitud->codigo_muestra}}</td>
                                <td>
                                  {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
                                </td>
                                <td id="celda">
                                  @include('SolicitudExamenes.Formularios.delete')
                                </td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
