<div class="page">

  <div>
    <center>
      <h3>HOJA DE CONFORMIDAD DE GASTOS HOSPITALARIOS</h3>
      <br>
      <h4>GENERALES DEL CLIENTE</h4>
    </center>
	</div>
	<div class="row px">
		{{-- Datos del paciente --}}
		<div class="col-xs-7">
			<div class="row">
				<span class="text-monospace">Paciente:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->hospitalizacion->paciente->nombre.' '.$ingreso->hospitalizacion->paciente->apellido}}</b> 
				<span class="label label-default">
					{{' '.$ingreso->hospitalizacion->paciente->fechaNacimiento->age.' años'}}
				</span>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Dirección:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->hospitalizacion->paciente->direccion}}</b>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Teléfono:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->hospitalizacion->paciente->telefono}}</b>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Recepcionista:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->recepcion->nombre.' '.$ingreso->recepcion->apellido}}</b>
			</div>
			<hr class="my">
		</div>

		<div class="col-xs-5">
			<div class="row">
				<span class="text-monospace">Expediente:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->hospitalizacion->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}</b>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Fecha de ingreso:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->fecha_ingreso->format('d / m / Y g:i a')}}</b>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Habitación:</span>
			</div>
			<div class="row">
				<b>{{$ingreso->habitacion->servicio->nombre}}</b>
			</div>
			<hr class="my">

			<div class="row">
				<span class="text-monospace">Médico que autoriza el ingreso:</span>
			</div>
			<div class="row">
				<b>
          @if ($ingreso->hospitalizacion->medico->sexo)
            {{" Dr. "}}
          @else
            {{" Dra. "}}
          @endif
          {{$ingreso->hospitalizacion->medico->nombre.' '.$ingreso->hospitalizacion->medico->apellido}}
        </b>
			</div>
			<hr class="my">
		</div>
	</div>

  <div class="col-xs-12">
    <br>
    <center>
      <h4>CONSENTIMIENTO DEL REPRESENTANTE LEGAL O RESPONSABLE DEL PACIENTE</h4>
    </center>
  </div>
  <div class="col-xs-12 text-justify">
    <p class="col-xs-12">
      Yo, <b class="">{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido.', '}}</b>&nbsp; mayor de edad con Documento Único de Identidad, número &nbsp;<b class="">{{$ingreso->hospitalizacion->responsable->dui}}</b>, &nbsp;actuando en calidad de responsable del paciente de generales antes expresadas, estoy conforme y enterado de los costos hospitalarios que implica el tratamiento y la enfermedad por lo cual esta {{($ingreso->hospitalizacion->paciente->sexo)?"ingresado":"ingresada"}} y acepto que diariamente se me informe el estado de cuenta al que me comprometo cancelar.
    </p>
		<br>
		<!--
    	<div class="col-xs-12">
      <table class="">
        <thead>
          <th style="width: 120px;">FECHA</th>
          <th style="width: 90px;">HORA</th>
          <th style="width: 100px;">ESTIMADO POR 24 HORAS</th>
          <th style="width: 150px;">ESTADO DE CUENTA</th>
          <th>NOMBRE</th>
          <th>FIRMA</th>
        </thead>
        <tbody>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
          <tr>
            <td>01 / 01 / 2000</td>
            <td>12:00 pm</td>
            <td>$ 999.99</td>
            <td>Contenido</td>
            <td>{{$ingreso->hospitalizacion->responsable->nombre.' '.$ingreso->hospitalizacion->responsable->apellido}}</td>
            <td>Firma</td>
          </tr>
        </tbody>
      </table>
		</div>
		-->
  </div>
</div>