@extends('dashboard')
@section('layout')
  {!!Form::model($division,['class' =>'form-horizontal form-label-left input_mask','route' =>['divisiones.update',$division->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>División<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Componentes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
