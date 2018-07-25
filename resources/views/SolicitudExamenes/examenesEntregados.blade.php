@extends('dashboard')
@section('layout')
	@php
		setlocale(LC_ALL,'es');
	@endphp
  <div class="col-md-8 col-sm-8 col-xs-8">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Exámenes entregados
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
                  <li><a href={{asset("/examenesEntregados")}}>Por Examen</a>
                  </li>
                  <li><a href={{asset("/examenesEntregados?vista=paciente")}}>Por Paciente</a>
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
                      <li><spam onclick={!! "'imprimirExaEvaPacie(".$solicitudes.",".$paciente->f_paciente.");'" !!} class="fa fa-print"></spam>
                      </li>
                    </ul>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th class="col-md-2 col-sm-2">Código</th>
                          <th>Examen</th>
													<th>Fecha de evaluación</th>
													<th>Opciones</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_paciente == $paciente->f_paciente)
                              <tr>
                                <td>{{$solicitud->codigo_muestra}}</td>
                                <td>{{$solicitud->examen->nombreExamen}}</td>
																<td>{{$solicitud->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S')}}</td>
																<td>
																<a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
															    <i class="fa fa-envelope"></i>
															  </a><td>
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
                      {{$examen->nombreExamen($examen->f_examen)}} <small><i class="fa fa-chevron-down"></i></small>
                    </h4>
                  </a>
                  <div id={{"C".$k}} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{"H".$k}}>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <th class="col-md-2 col-sm-2">Código</th>
                          <th>Paciente</th>
													<th>Opciones</th>
                        </thead>
                        <tbody>
                          @foreach($solicitudes as $solicitud)
                            @if($solicitud->f_examen == $examen->f_examen)
                              <tr>
                                <td>{{$solicitud->codigo_muestra}}</td>
                                <td>
                                  {{$solicitud->nombrePaciente($solicitud->f_paciente)}}
                                </td>
																<td>
																<a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_examen)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
															    <i class="fa fa-envelope"></i>
															  </a><td>
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
