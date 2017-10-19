@extends('dashboard')
@section('layout')
  {!!Form::model($componente,['class' =>'form-horizontal form-label-left input_mask','route' =>['componentes.update',$componente->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Componente<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Componentes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
