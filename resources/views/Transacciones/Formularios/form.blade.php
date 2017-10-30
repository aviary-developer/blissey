@php
  use App\Transacion;
@endphp
<div class="x_content">
  <div class="form_wizard wizard_horizontal" id="wizard">
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no">1</span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos de la factura</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no">2</span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos de productos</small>
          </span>
        </a>
      </li>
    </ul>
    <center>
      <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
    </center>
    <div id="step-1">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Datos de la factura</h4>
        <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
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
                ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'f_proveedor'])!!}
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
      </div>
    </div>
    <!--  ////////////////Segundo paso///////////////  -->
    <div id="step-2" style="height:500px">
      <div class="col-md-6 col-sm-6 col-xs-12">
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
        @if ($tipo==0)
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
            {!! Form::text('lote_resultado',null,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','placeholder'=>'N° de lote']) !!}
          </div>
        </div>
        @endif
        <h4 class="StepTitle">Resultado de busqueda</h4>
        <table class="table" id="tablaBuscar">
          <thead>
            <th>Resultado</th>
            <th style="width : 80px">Acción</th>
          </thead>
        </table>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Componentes</h4>
        <table class="table" id="tablaComponente">
          <thead>
            <th>Componente</th>
            <th>Cantidad</th>
            <th style="width : 80px">Acción</th>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
