@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','id'=>'formulario','route' =>'detalleCajas.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <input type="hidden" name="f_caja" value="{{$caja->id}}">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Apertura de Caja <small>{{$caja->nombre}}</small></h2>
        <div class="clearfix"></div>
      </div>
      {{--  --}}
      <div class="x_content">
        <br />
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Importe *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('importe',null,['class'=>'form-control has-feedback-left','placeholder'=>'Cantidad']) !!}
          </div>
        </div>
        <center>
          <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
        </center>
        <div class="ln_solid"></div>
        <div class="form-group">
          <center>
            {!! Form::button('Guardar',['class'=>'btn btn-primary','onclick'=>'aperturar()']) !!}
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
      title: 'Aperturar caja',
      text: '¿Está seguro? ¡Sobre esta se realizarán las transacciones!',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, ¡Restaurar!',
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