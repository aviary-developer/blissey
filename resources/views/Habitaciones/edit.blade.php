@extends('principal')
@section('layout')
	@php
		$create = false;
		$ruta = '/habitaciones';
	@endphp
	@include('Habitaciones.Barra.create')
  {!!Form::model($habitaciones,['class' =>'form-horizontal form-label-left input_mask','route' =>['habitaciones.update',$habitaciones->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-5">
        <div class="x_panel" style="height:363px">
          @include('Habitaciones.Formularios.habitacion')
        </div>
      </div>
      <div class="col-sm-7">
        <div class="x_panel">
          @include('Habitaciones.Formularios.camas')
        </div>
      </div>
    </div>
    <div class="x_panel">
      <div class="flex-row">
        <center>
          <a href={!! asset($ruta) !!} class="btn btn-outline-primary btn-sm">Cancelar</a>
        </center>
      </div>
    </div>
  </div>
  <input type="hidden" id="count_ci" value={{$count_ci}}>
  <input type="hidden" id="count_co" value={{$count_co}}>
  <input type="hidden" id="count_cm" value={{$count_cm}}>
	{!!Form::close()!!}
	{!!Html::script('js/scripts/Habitacion.js')!!}
@endsection
