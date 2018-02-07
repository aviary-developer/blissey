@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'requisiciones.store','method' =>'POST'])!!}
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Requisición<small>Nueva</small></h2>
        <div class="clearfix"></div>
      </div>
      @php
        if(!isset($fecha)){
        $fecha = Carbon\Carbon::now();
        }
        $pantalla=1;//Crear
      @endphp
      @include('Requisiciones.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
