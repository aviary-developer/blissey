@extends('dashboard')
@section('layout')
  {!!Form::model($unidades,['class' =>'form-horizontal form-label-left input_mask','route' =>['unidades.update',$unidades->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Unidad de medida<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Unidades.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
