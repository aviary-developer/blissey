@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
	@endphp
	@include('Reactivos.Barra.show')

	<div class="col-sm-8">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Movimientos</h5>
				</center>
			</div>
			@include('Reactivos.Partes.info_i')
		</div>
	</div>

	<div class="col-sm-4">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Información General</h5>
				</center>
			</div>
			@include('Reactivos.Partes.info_d')
		</div>
	</div>
@endsection
