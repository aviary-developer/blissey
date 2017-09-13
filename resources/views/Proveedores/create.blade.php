@extends('dashboard')
@section('layout')
  {!!Form::open()!!}
  <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
  @include('Proveedores.Formularios.proveedor')
  {!!link_to('#',$title='Registrar proveedor',$attributes=['id'=>'registroProveedor','class'=>'btn btn-primary'],$secure = null)!!}
  {!!Form::close()!!}
@endsection

@section('scripts')
  {!!Html::script('js/scripts/Proveedores.js')!!}
@endsection
