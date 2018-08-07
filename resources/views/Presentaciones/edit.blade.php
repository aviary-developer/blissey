@extends('dashboard')
@section('layout')
  {!!Form::model($presentaciones,['class' =>'form-horizontal form-label-left input_mask','route' =>['presentaciones.update',$presentaciones->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Presentación
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Presentaciones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
