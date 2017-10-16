@extends('dashboard')
@section('layout')
  {!!Form::model($categoria_servicios,['class' =>'form-horizontal form-label-left input_mask','route' =>['categoria_servicios.update',$categoria_servicios->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Categorías de servicios<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('CategoriaServicios.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
