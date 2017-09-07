@extends('dashboard')
@section('layout')
  {!!Form::open()!!}
  <input type="hidden" name="_token" value="{{csrf_token()}}" id="tokenReactivos">
  @include('Reactivos.Formularios.reactivo')
  {!!link_to('#',$title='Registrar Reactivo',$attributes=['id'=>'registroReactivo','class'=>'btn btn-primary'],$secure = null)!!}
  {!!Form::close()!!}
@endsection

@section('scripts')
  {!!Html::script('js/scripts/Reactivos.js')!!}
@endsection
