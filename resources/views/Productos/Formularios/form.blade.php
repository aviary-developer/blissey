<div class="x_content">
  <div class="form_wizard wizard_horizontal" id="wizard">
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no">1</span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos del producto</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no">2</span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos de los componentes</small>
          </span>
        </a>
      </li>
    </ul>
    <center>
      <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
    </center>
    <div id="step-1">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Datos del producto</h4>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cube form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo producto']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Presentación *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cog form-control-feedback left" aria-hidden="true"></span>
            <select class="form-control has-feedback-left" name="f_presentacion">
              @foreach ($presentaciones as $presentacion)
                <option value={{ $presentacion->id }}>{{ $presentacion->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Droguería *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            <select class="form-control has-feedback-left" name="f_proveedor">
              @foreach ($proveedores as $proveedor)
                <option value={{ $proveedor->id }}>{{ $proveedor->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <h4 class="StepTitle">División del producto</h4>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Código *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control has-feedback-left','placeholder'=>'Código del nuevo producto']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">División *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            <select class="form-control has-feedback-left" name="divisionSelect" id = "division">
              @foreach ($divisiones as $division)
                <option value={{ $division->id }}>{{ $division->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
          <label>
              Cantidad<input type="checkbox" name="contenido" class="js-switch" id="contenido"/> Contenido
          </label>
        </div>
        <div class="form-group" id="opc1">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad *</label>
          <div class="col-md-4 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de unidades minimas','min'=>'1']) !!}
          </div>
          <div class="col-md-5 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('valor',null,['id'=>'cantidad','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de unidades minimas']) !!}
          </div>
        </div>
        <div class="form-group" id="opc2" style="display:none;">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Contenido *</label>
          <div class="col-md-4 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('v_contenido',1,['id'=>'cantidad','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de unidades minimas','min'=>'1']) !!}
          </div>
          <div class="col-md-5 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!!Form::select('v_valor',
              App\Producto::arrayUnidades()
              ,null, ['class'=>'form-control has-feedback-left'])!!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio ($) *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
            {!! Form::number('precio','0.00',['id'=>'precio','class'=>'form-control has-feedback-left','placeholder'=>'Precio por división','min'=>'1.00','step'=>'0.05']) !!}
          </div>
        </div>
        <center>
          <button type="button" class="btn btn-primary" id="agregar_division">
            <i class="fa fa-plus"></i>
            Agregar división
          </button>
        </center>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Divisiones</h4>
        <table class="table" id="tablaDivision">
          <thead>
            <th>Código</th>
            <th>División</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th style="width : 80px">Acción</th>
          </thead>
          <tbody>
            @if (!$create)
              @php
                $auxiliar_division = 0;
              @endphp
              <input type="hidden" name="divisiones_eliminadas[]" value="ninguno" id="division_eliminada">
              @foreach ($divisiones_productos  as $key => $division)
                <tr>
                  <td>{{$division->codigo}}</td>
                  <td>{{$division->nombreDivision($division->f_division)}}</td>
                  <td>{{$division->cantidad}}</td>
                  <td>{{'$ '.number_format($division->precio,2,'.',',')}}</td>
                  <td>
                    <input type="hidden" id={{"division".$key}} value={{$division->f_division.$division->cantidad}}>
                    <input type="hidden" value={{$division->id}}>
                    <button type="button" name="button" class="btn btn-xs btn-danger" id="eliminar_division_antigua">
                      <i class="fa fa-remove"></i>
                    </button>
                  </td>
                </tr>
                @php
                  $auxiliar_division = $key;
                @endphp
              @endforeach
              <input type="hidden" id="contador_division" value={{$auxiliar_division}}>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div id="step-2" style="height:500px">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Componentes del producto</h4>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar componente </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('componente',null,['id'=>'componente','class'=>'form-control has-feedback-left','placeholder'=>'Buscar componente']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Contenido *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('cantidad_componente',1,['id'=>'cantidad_componente','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de componente','min'=>'0.00']) !!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
            <select class="form-control has-feedback-left" name="divisionSelect" id = "unidad">
              @foreach ($unidades as $unidad)
                <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <h4 class="StepTitle">Resultado de busqueda</h4>
        <table class="table" id="tablaBuscarComponente">
          <thead>
            <th>Componente</th>
            <th style="width : 80px">Acción</th>
          </thead>
        </table>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="StepTitle">Componentes</h4>
        <table class="table" id="tablaComponente">
          <thead>
            <th>Componente</th>
            <th>Contenido</th>
            <th style="width : 80px">Acción</th>
          </thead>
          <tbody>
            @if (!$create)
              @php
                $auxiliar_componente = 0;
              @endphp
              <input type="hidden" name="componentes_eliminados[]" value="ninguno" id="componente_eliminado">
              @foreach ($componentes_productos  as $key => $componente)
                <tr>
                  <td>{{$componente->nombreComponente($componente->f_componente)}}</td>
                  <td>{{$componente->cantidad.' '.$componente->nombreUnidad($componente->f_unidad)}}</td>
                  <td>
                    <input type="hidden" id={{"componente".$key}} value={{$componente->f_componente}}>
                    <input type="hidden" value={{$componente->id}}>
                    <button type="button" name="button" class="btn btn-xs btn-danger" id="eliminar_componente_antiguo">
                      <i class="fa fa-remove"></i>
                    </button>
                  </td>
                </tr>
                @php
                  $auxiliar_componente = $key;
                @endphp
              @endforeach
              <input type="hidden" id="contador_componente" value={{$auxiliar_componente}}>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
