@extends('dashboard')
@section('layout')
  {!!Form::model($categoria,['class' =>'form-horizontal form-label-left input_mask','route' =>['categoria_productos.update',$categoria->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Categorías de productos
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('CategoriaProductos.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
