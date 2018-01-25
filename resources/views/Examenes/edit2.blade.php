@extends('dashboard')
@section('layout')
  {!!Form::model($examenes,['class' =>'form-horizontal form-label-left input_mask','route' =>['examenes.update',$examenes->id],'method' =>'PUT','autocomplete'=>'off'])!!}

  <div class="col-sm-10 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Examen<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Examenes.Formularios.form2')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
