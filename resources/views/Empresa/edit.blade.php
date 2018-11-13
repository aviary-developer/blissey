@extends('principal') 
@section('layout') 
@php 
  $fecha = Carbon\Carbon::now(); 
  $create = false;
@endphp
@include('Empresa.Barra.create')
{!! Form::model($empresa, ['class' =>'form-horizontal form-label-left input_mask','route' =>['grupo_promesa.update',$empresa->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data']) !!}

<div class="col-sm-12">
	<div class="x_panel">		
    <div class="x_content">
      <input type="hidden" name="telefono_eliminados[]" value="ninguno" id="telefono_eliminados">
      @if($seccion==1)
        @include('Empresa.Formularios.paso1')
      @elseif($seccion==2)  
        @include('Empresa.Formularios.paso2')
      @elseif($seccion==3)  
        @include('Empresa.Formularios.paso3')
      @elseif($seccion==4)  
        @include('Empresa.Formularios.paso4')
      @else  
        @include('Empresa.Formularios.paso5')
      @endif
    </div>
	</div>
	<div class="x_panel">
		<center>
			{!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
      <a href={!! asset('/grupo_promesa') !!} class="btn btn-light btn-sm">Cancelar</a>
		</center>
	</div>
</div>
{!!Form::close()!!} @endsection