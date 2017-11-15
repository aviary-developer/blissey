@extends('dashboard')
@section('layout')
  {!!Form::model($muestras,['class' =>'form-horizontal form-label-left input_mask','route' =>['muestras.update',$muestras->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Muestra<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Muestras.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
