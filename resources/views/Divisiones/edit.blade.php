@extends('dashboard')
@section('layout')
  {!!Form::model($division,['class' =>'form-horizontal form-label-left input_mask','route' =>['divisiones.update',$division->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>División
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Divisiones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
