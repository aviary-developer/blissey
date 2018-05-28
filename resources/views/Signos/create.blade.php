@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'signos.store','method' =>'POST','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Signo<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Signos.Formularios.form')
    </div>
  </div>
  <input type="hidden" name="f_ingreso" value="1">
  {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
  {!!Form::close()!!}
@endsection