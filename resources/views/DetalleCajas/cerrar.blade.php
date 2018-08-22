@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','id'=>'formulario','route' =>'detalleCajas.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <input type="hidden" name="f_caja" value="{{$caja->id}}">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Cierre de Caja
              <small class="label-white badge red ">{{$caja->nombre}}</small>
          </h3>
        </center>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_content">
        <br />
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Importe *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('importe',null,['class'=>'form-control has-feedback-left','placeholder'=>'Cantidad']) !!}
          </div>
          <input type="hidden" name="tipo" value="2">
        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
        <div class="ln_solid"></div>
        <div class="form-group">
          <center>
            {!! Form::button('Cerrar',['class'=>'btn btn-primary','onclick'=>'aperturar()']) !!}
            <button type="reset" name="button" class="btn btn-default">Limpiar</button>
            <a href={!! asset('/cajas') !!} class="btn btn-default">Cancelar</a>
          </center>
        </div>
      </div>
      {{--  --}}
    </div>
  </div>
  {!!Form::close()!!}
  <script type="text/javascript">
  function aperturar(id){
    return swal({
      title: 'Efectuar cierre de caja',
      text: '¿Está seguro? ¡No podrán realizarse más transacciones!',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Cerrar!',
      cancelButtonText: 'No, ¡Cancelar!',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      buttonsStyling: false
    }).then(function () {
      var dominio = window.location.host;
      $('#formulario').submit();
    }, function (dismiss) {
      // dismiss can be 'cancel', 'overlay',
      // 'close', and 'timer'
      if (dismiss === 'cancel') {
        swal(
          'Cancelado',
          'Acción no realizada',
          'info'
        )
      }
    });
  }
  </script>
@endsection
