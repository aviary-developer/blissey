@extends('principal')
@section('layout')
@include('DetalleCajas.Barra.cierre')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','id'=>'formulario','route' =>'detalleCajas.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    @endphp
  <input type="hidden" name="f_caja" value="{{$caja->id}}">
  <input type="hidden" id="aux_arqueo" value="{{App\DetalleCaja::arqueo($fecha->format('Y-m-d'),$caja->id)}}">
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
            {!! Form::number('importe',null,['class'=>'form-control form-control-sm','placeholder'=>'Cantidad','id'=>'importe']) !!}
          </div>
        <input type="hidden" name="tipo" value="2">
        </div>
    </div>
    <div class="x_panel">
      <center>
        {!! Form::button('Cerrar',['class'=>'btn btn-primary btn-sm','onclick'=>'cerrar()']) !!}
        <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
        <a href={!! asset('/cajas') !!} class="btn btn-light btn-sm">Cancelar</a>
      </center>
    </div>
  </div>
  {!!Form::close()!!}
  <script type="text/javascript">
  async function cerrar(){
    validar=await validar_importe();
    console.log(validar);
    if(validar==true){
      return swal({
        title: 'Efectuar cierre de caja',
        text: '¿Está seguro? ¡No podrán realizarse más transacciones!',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, ¡Cerrar!',
        cancelButtonText: 'No, ¡Cancelar!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-light',
        buttonsStyling: false
      }).then((result) => {
        if (result.value) {
          var dominio = window.location.host;
          $('#formulario').submit();
        }
      });
    }
}
function validar_importe(){
  if($('#importe').val()==''){
    return true;
  }else{
    arqueo=parseFloat($('#aux_arqueo').val());
    importe=parseFloat($('#importe').val());
    if(arqueo>=importe){
      return true;
    }else{
      notaError("Valor supera el contenido en caja");
      return false;
    }
  }
}
  </script>
@endsection
