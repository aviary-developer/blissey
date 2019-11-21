@extends('principal')
@section('layout')
@include('DetalleCajas.Barra.apertura')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','id'=>'formulario','route' =>'detalleCajas.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $ultimo=App\DetalleCaja::where('f_caja',$caja->id)->get()->last();
    if($ultimo!=null){
      if($ultimo->tipo==2){
      $valor=number_format($ultimo->total-$ultimo->importe,2,'.','');
      }elseif($ultimo->tipo==1){
      $valor=App\DetalleCaja::arqueo($ultimo->fecha,$ultimo->f_caja);
      }
    }else{
      $valor="";
    }
  @endphp
  <input type="hidden" name="f_caja" value="{{$caja->id}}">
  <div class="col-6">
      <div class="alert alert-danger" id="mout">
          <center>
            <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
          </center>
      </div>
    <div class="x_panel">
        <div class="form-group">
            <label class="" for="importe">Importe *</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
              </div>
              @php
              @endphp
                {!! Form::number('importe',$valor,['class'=>'form-control form-control-sm','placeholder'=>'Cantidad']) !!}
            </div>
          <input type="hidden" name="tipo" value="1">
          </div>
      </div>
      <div class="x_panel">
          <center>
            {!! Form::button('Aperturar',['class'=>'btn btn-primary btn-sm','onclick'=>'aperturar()']) !!}
            <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
            <a href={!! asset('/detalleCajas/create') !!} class="btn btn-light btn-sm">Cancelar</a>
          </center>
        </div>
      {{--  --}}
    </div>
  {!!Form::close()!!}
  <script type="text/javascript">
  function aperturar(){
  return swal({
    title: 'Aperturar caja',
    text: '¿Está seguro? ¡Sobre esta se realizarán las transacciones!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Aperturar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').submit();
    }
  });
}
  </script>
@endsection
