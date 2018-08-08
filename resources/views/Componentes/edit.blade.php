@extends('dashboard')
@section('layout')
  {!!Form::model($componente,['class' =>'form-horizontal form-label-left input_mask','route' =>['componentes.update',$componente->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Componente
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Componentes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
