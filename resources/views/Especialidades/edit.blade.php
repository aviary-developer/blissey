@extends('dashboard')
@section('layout')
  {!!Form::model($especialidades,['class' =>'form-horizontal form-label-left input_mask','route' =>['especialidades.update',$especialidades->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Especialidad<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Especialidades.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
