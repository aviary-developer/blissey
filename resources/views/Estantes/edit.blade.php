@extends('dashboard')
@section('layout')
  {!!Form::model($estante,['class' =>'form-horizontal form-label-left input_mask','route' =>['estantes.update',$estante->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Estante
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Estantes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
