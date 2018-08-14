@extends('dashboard')
@section('layout')
    {!! Form::model($proveedor,['route'=>['proveedores.update',$proveedor->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off']) !!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Proveedor
              <small class="label-white badge blue ">Editar</small>
          </h3>
        </center>
      </div>
    </div>
    <div class="x_panel">
      <?php $bandera=2;?>{{--Indica que es editar --}}
      @include('Proveedores.Formularios.form')
    </div>
    <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
    <a href={!! asset('/proveedores') !!} class="btn btn-default">Cancelar</a>
  </center>
  </div>
  {!!Form::close()!!}
@endsection
