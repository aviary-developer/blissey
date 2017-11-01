@php
  use App\Transacion;
@endphp
<div class="x_content">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <center>
          <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
        </center>
        <input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::date('fecha',$fecha,['class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
        @if ($tipo==1)
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
              {!!Form::select('f_cliente',
                Transacion::arrayClientes()
                ,null, ['placeholder' => 'Seleccione un proveedor','class'=>'form-control has-feedback-left'])!!}
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
        <h4 class="StepTitle">Busqueda</h4>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('resultado',null,['id'=>'resultado','class'=>'form-control has-feedback-left','placeholder'=>'Buscar']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control has-feedback-left','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
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
      {{--Paso dos columna 2--}}
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Detalles</h4>
        <table class="table" id="tablaDetalle">
          <thead>
            <th>Cantidad</th>
            <th>Detalle</th>
            <th style="width : 80px">Acción</th>
          </thead>
        </table>
      </div>
      <center>
        {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
        <button type="reset" name="button" class="btn btn-default">Limpiar</button>
        <a href={!! asset('/estantes') !!} class="btn btn-default">Cancelar</a>
      </center>
</div>
