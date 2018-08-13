@extends('PDF.hoja')
@section('layout')
	@php
  $fecha = Carbon\Carbon::now();
@endphp
<div class="col-md-12 col-sm-12 col-xs-12">
			<center>
      <span><big>Tomografía Axial Computarizada: <strong><u>{{$solicitud->tac->nombre}}</u></strong></big><span>
		</center>
		<div><span style="float:right"> Edad: <strong><u>{{$solicitud->paciente->fechaNacimiento->age}} años</u></strong></span><span>Paciente: <strong><u>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}}</u></strong></span></div>
		<div class="clearfix"></div>
		<center>
				<div class="x_content">
				<div class="row">
					<center>
						<br>
						@php
						echo $resultado->observacion;
						@endphp
					</center>
			<div class="col-md-12 col-sm-12 col-12">
				<center>
				<div><span> Realizó: <strong><i>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</i></strong></span> &nbsp
					<span> Sello:<img src={{asset(Storage::url(Auth::user()->sello))}} class="logo-pdf"> Firma:<img src={{asset(Storage::url(Auth::user()->firma))}} width="150" height="110"></span>
					<span> Fecha: <strong><i>{{$resultado->created_at->format('d/m/Y')}}</i></strong></span>
				</div>
			</center>
			</div>
		</div>
		</div>
	</center>
  </div>
	@endsection
