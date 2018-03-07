@extends('dashboard')
@section('layout')
  {!!Form::model($categoria,['class' =>'form-horizontal form-label-left input_mask','route' =>['categoria_productos.update',$categoria->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Categorías de productos<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('CategoriaProductos.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
