@extends('dashboard')
@section('layout')
  {!!Form::model($estante,['class' =>'form-horizontal form-label-left input_mask','route' =>['estantes.update',$estante->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Estante<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Estantes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
