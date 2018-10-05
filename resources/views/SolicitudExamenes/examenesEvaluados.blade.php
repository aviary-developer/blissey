@extends('principal')
@section('layout')
	@php
    setlocale(LC_ALL,'es');
    $est = "evaluados"
  @endphp
  @include('SolicitudExamenes.Barra.index')
  <div class="col-md-8 col-sm-8 col-xs-8">
    <div class="x_content">
      <div class="col-sm-12">
        @if($vista == "paciente")
          @include('SolicitudExamenes.Partes.lista_paciente_ev')
        @else
          @include('SolicitudExamenes.Partes.lista_examen_ev')
        @endif
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
