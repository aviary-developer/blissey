@extends('dashboard')
@section('layout')
	@php
		setlocale(LC_ALL,'es');
	@endphp
  <div class="col-md-8 col-sm-8 col-xs-8">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          TAC evaluadas
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="btn-group">
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
                  <li><a href={{asset("/examenesEvaluados")}}>Por TAC</a>
                  </li>
                  <li><a href={{asset("/examenesEvaluados?vista=paciente")}}>Por Paciente</a>
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
											<ul class="nav navbar-right">
                      <li>
                      </li>
                    </ul>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th>TAC</th>
													<th>Fecha de evaluación</th>
													<th>Opciones</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_paciente == $paciente->f_paciente)
                              <tr>
                                <td>{{$solicitud->tac->nombre}}</td>
																<td>{{$solicitud->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S')}}</td>
																<td><a id="editar" href= {!! asset('/solicitudex/'.$solicitud->id.'/edit')!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar"/>
															    <i class="fa fa-edit"></i>
															  </a>
															  <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_tac)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
															    <i class="fa fa-envelope"></i>
															  </a></td>
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
                      {{$examen->nombreTac($examen->f_tac)}} <small><i class="fa fa-chevron-down"></i></small>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th>Paciente</th>
													<th>Fecha de evaluación</th>
													<th>Opciones</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_tac== $examen->f_tac)
                              <tr>
                                <td>
                                  {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
                                </td>
																<td>{{$solicitud->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S')}}</td>
																<td><a id="editar" href= {!! asset('/solicitudex/'.$solicitud->id.'/edit')!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar"/>
															    <i class="fa fa-edit"></i>
															  </a>
															  <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_tac)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
															    <i class="fa fa-envelope"></i>
															  </a></td>
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
	<input type="hidden" id="tokenExaPac" name="token" value="<?php echo csrf_token(); ?>">
	<script type="text/javascript">
	function imprimirExaEvaPacie(solicitudes,paciente){
		var bandera=true;
		var url="{{URL::to('/impresionExamenesPorPaciente')}}"+"/"+paciente+"/"+bandera;
		window.open(url,'_blank');
		token=$("#tokenExaPac").val();
		$.ajax({
			url: "/blissey/public/impresionExamenesPorPaciente/",
			headers: { 'X-CSRF-TOKEN': token },
			type: 'POST',
			data: {
				bandera:true,
				paciente:paciente
			},
			beforeSend: function () {
      },
			success: function () {
				location.reload();
			},
			error: function(data){
			}
		});
	}
	</script>
@endsection