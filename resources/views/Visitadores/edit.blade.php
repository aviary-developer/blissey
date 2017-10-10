@extends('dashboard')
@section('layout')
    {!! Form::model($visitador,['route'=>['visitadores.update',$visitador->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off']) !!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Visitador<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      <?php $bandera=2;?>{{--Indica que es editar --}}
      @include('Visitadores.Formularios.form')
    </div>
    <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
  </center>
  </div>
  {!!Form::close()!!}
@endsection
