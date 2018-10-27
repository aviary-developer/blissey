@extends('principal')
@section('layout')
	@php
		$fecha = Carbon\Carbon::now();
		$create = true;
	@endphp
	@include('CategoriaServicios.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'categoria_servicios.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
		@include('CategoriaServicios.Formularios.form')
	</div>
	<input type="hidden" id="method" value="create">
  {!!Form::close()!!}
@endsection
