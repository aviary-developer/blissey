@extends('dashboard')
@section('layout')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Solicitud de exámenes
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="btn-group">
              <a href={{asset('/solicitudex/create')}} class="btn btn-ms btn-dark">
                <i class="fa fa-plus"></i> Nuevo
              </a>
              <a href={{asset('#')}} class="btn btn-ms btn-dark">
                <i class="fa fa-file"></i> Reporte
              </a>
              <a href={{'#'}} class="btn btn-primary btn-ms">
                <i class="fa fa-question"></i> Ayuda
              </a>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($pacientes as $k => $paciente) 
              <div class="panel">
                <a class="panel-heading collapsed" role="tab" id={{"H".$k}} data-toggle="collapse" data-parent="#accordion" href={{"#C".$k}}        aria-expanded="false" aria-controls={{"C".$k}}>
                  <h4 class="panel-title">
                    {{$paciente->nombrePaciente($paciente->f_paciente)}}
                  </h4>
                </a>
                <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                  <div class="panel-body">
                    <table class="table">
                      <thead>
                        <th class="col-md-2 col-sm-2">Código</th>
                        <th>Examen</th>
                        <th>Opción</th>
                      </thead>
                      <tbody>
                        @foreach($solicitudes as $solicitud)
                          @if($solicitud->f_paciente == $paciente->f_paciente)  
                            <tr>
                              <td>{{$solicitud->codigo_muestra}}</td>
                              <td>{{$solicitud->nombreExamen($solicitud->f_examen)}}</td>
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
        </div>
      </div>
    </div>
  </div>  
@endsection