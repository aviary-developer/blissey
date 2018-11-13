@extends('principal') 
@section('layout') 
@php 
	$fecha = Carbon\Carbon::now(); 
	$create = true;
@endphp
@include('Empresa.Barra.create')
{!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'grupo_promesa.store','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!} 
<div class="col-sm-12">
	<input type="hidden" name="telefono_eliminados[]" value="ninguno" id="telefono_eliminados">
	@include('Empresa.Formularios.form')
</div>
{!!Form::close()!!} 
@endsection