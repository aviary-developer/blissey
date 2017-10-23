<?php use App\Transacion;?>
<div class="x_content">
  <div class="col-md-6 col-sm-6 col-xs-12"><!--Inicio columna 1-->
    <center>
      <p>El campo marcado con un * es de registro <b>obligatorio</b>.</p>
    </center>
    <br />
    <input type="hidden" name="tipo" value="{{$tipo}}">
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">N° de factura *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('factura',null,['class'=>'form-control has-feedback-left','placeholder'=>'N° de factura']) !!}
      </div>
    </div>
    @if ($tipo==1)
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
          {!!Form::select('f_cliente',
            Transacion::arrayClientes()
            ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left'])!!}
        </div>
      </div>
    @else
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proveedor *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
          {!!Form::select('f_proveedor',
            Transacion::arrayProveedores()
            ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left'])!!}
        </div>
      </div>
    @endif
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('descuento',null,['class'=>'form-control has-feedback-left','placeholder'=>'Descuento']) !!}
      </div>
    </div>
  </div><!--Fin columna 1-->
  <div class="col-md-6 col-sm-6 col-xs-12"><!--Inicio columna 2-->
  </div><!--Fin columna 2-->
</div>
