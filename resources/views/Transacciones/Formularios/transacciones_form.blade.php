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
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento general</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('descuento',null,['class'=>'form-control has-feedback-left','placeholder'=>'Descuento']) !!}
      </div>
    </div>
    <div id="step-2" style="height:500px">
        <h4 class="StepTitle">Busqueda</h4>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('resultado',null,['id'=>'resultado','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('cantidad_resultado',null,['id'=>'precio_resultado','class'=>'form-control has-feedback-left','placeholder'=>'Precio']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('descuento_resultado',null,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','placeholder'=>'Descuento unitario']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad','min'=>'0.00']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de vencimiento *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::date('fecha_resultado',null,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Lote *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('lote_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','placeholder'=>'N° de lote']) !!}
          </div>
        </div>
        <h4 class="StepTitle">Resultado de busqueda</h4>
        <table class="table" id="tablaBuscar">
          <thead>
            <th>Resultado</th>
            <th style="width : 80px">Acción</th>
          </thead>
        </table>

    </div>
  </div><!--Fin columna 1-->
  <div class="col-md-6 col-sm-6 col-xs-12"><!--Inicio columna 2-->
    <h4 class="StepTitle">Resultados</h4>
    <table class="table" id="tablaTransaccion">
      <thead>
        <th>Agregado</th>
        <th>Cantidad</th>
        <th style="width : 80px">Acción</th>
      </thead>
    </table>
  </div><!--Fin columna 2-->
</div>
