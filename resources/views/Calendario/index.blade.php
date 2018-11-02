@extends('principal')
@section('layout')
@include('Calendario.barra')
<div class="col-sm-12">
	<div class="x_panel">
		<div class="col-sm-2">
			<span class="text-monospace">
				Leyenda:
			</span>
		</div>
		<div class="col-sm-2">
			<span style="color:lightseagreen">
				<i class="fas fa-square"></i>
				Todos
			</span>
		</div>
		<div class="col-sm-2">
			<span style="color:dodgerblue">
				<i class="fas fa-square"></i>
				@if(Auth::user()->tipoUsuario == "Gerencia")
					Gerentes
				@elseif (Auth::user()->tipoUsuario == "Médico")
					Médicos
				@elseif (Auth::user()->tipoUsuario == "Laboaratorio")
					Laboratoristas
				@elseif (Auth::user()->tipoUsuario == "Ultrasonografía")
					Laboratoristas de Ultrasonografía
				@elseif (Auth::user()->tipoUsuario == "Rayos X")
					Radiologos
				@elseif (Auth::user()->tipoUsuario == "Recepción")
					Recepcionistas
				@elseif (Auth::user()->tipoUsuario == "Enfermería")
					Enfermeros
				@elseif (Auth::user()->tipoUsuario == "Farmacia")
					Farmacia
				@elseif (Auth::user()->tipoUsuario == "TAC")
					Tomografos
				@endif
			</span>
		</div>
		<div class="col-sm-2">
			<span style="color:crimson">
				<i class="fas fa-square"></i>
				Usuario
			</span>
		</div>
		@if (Auth::user()->tipoUsuario == "Recepción")
			<div class="col-sm-2">
				<span style="color:orange">
					<i class="fas fa-square"></i>
					Médicos
				</span>
			</div>
			<div class="col-sm-2">
				<span style="color:#ccc">
					<i class="fas fa-square"></i>
					Otros usuarios
				</span>
			</div>
		@endif
	</div>
  <div class="x_panel">
    <div id="calendar"></div>
  </div>
  
  @include('Calendario.create')
	@include('Calendario.update')
</div>
{!!Html::script('js/scripts/Calendario.js')!!}
@endsection