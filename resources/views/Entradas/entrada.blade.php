@extends('principal')
@section('layout')
  @php
    $tipo=0;
		$pantalla=2;//Confirmar
		$fecha = Carbon\Carbon::now();
	@endphp
	@include('Entradas.Barra.entrada')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'cambio_productos.store','method' =>'POST','autocomplete'=>'off','id'=>'formIngreso'])!!}
  <div class="col-sm-12">
		@include('Entradas.Formularios.form')
	</div>
{!!Form::close()!!}
@endsection

