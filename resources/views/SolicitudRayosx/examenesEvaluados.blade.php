@extends('principal')
@section('layout')
	@php
    setlocale(LC_ALL,'es');
    $est = "evaluados";
  @endphp
  
  @include('SolicitudRayosx.Barra.index')
  <div class="col-sm-8">
    <div class="x_content">
      <div class="col-sm-12">
        @if($vista == "paciente")
          @include('SolicitudRayosx.Partes.lista_paciente_ev')
        @else
          @include('SolicitudRayosx.Partes.lista_rayos_ev')
        @endif
      </div>
    </div>
  </div>

<script type="text/javascript">
	function imprimirExaEvaPacie(solicitudes,paciente){
		var bandera=true;
		var url="{{URL::to('/impresionExamenesPorPaciente')}}"+"/"+paciente+"/"+bandera;
		window.open(url,'_blank');
		$.ajax({
			url: $('#guardarruta').val() + "/impresionExamenesPorPaciente/",
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
