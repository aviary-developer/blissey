@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('Servicios.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'servicios.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="alert alert-danger" id="mout">
	<center>
	  <p class="mb-1">El campo marcado con un * es <b>obligatorio, los elementos agregados no son editables</b>.</p>
	</center>
  </div>
  <div class="col-sm-6">
		@include('Servicios.Formularios.form')
  </div>
  <div class="col-sm-6">
	@include('Servicios.Formularios.form2')
</div>
@include('Servicios.Formularios.modalBuscarPromocion')
  {!!Form::close()!!}
@endsection
