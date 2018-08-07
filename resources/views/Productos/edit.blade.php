@extends('dashboard')
@section('layout')
  {!!Form::model($productos,['class' =>'form-horizontal form-label-left input_mask','route' =>['productos.update',$productos->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $create = false;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Producto
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
      @include('Productos.Formularios.opciones')
    </div>
    @include('Productos.Formularios.form')
  </div>
  {!!Form::close()!!}
    @include('Productos.Formularios.modalDivision')
@endsection
