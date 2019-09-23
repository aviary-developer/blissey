<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="row">
    <div class="col-md-10 col-sm-10 col-xs-10">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area de examen</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="area" id="" required>
          <option value="HEMATOLOGIA">HEMATOLOGIA</option>
          <option value="EXAMENES DE ORINA">UROANALISIS</option>
          <option value="EXAMENES DE HECES">COPROLOGIA</option>
          <option value="BACTERIOLOGIA">BACTERIOLOGIA</option>
          <option value="QUIMICA SANGUINEA">QUIMICA SANGUINEA</option>
          <option value="INMUNOLOGIA">INMUNOLOGIA</option>
          <option value="ENZIMAS">ENZIMAS</option>
          <option value="PRUEBAS ESPECIALES">PRUEBAS ESPECIALES</option>
          <option value="OTROS">OTROS</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
          {!! Form::text('nombreExamen',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen','']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de muestra *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="tipoMuestra" id="" >
            @foreach ($muestras as $muestra)
              <option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <center>
        <h4>
          <small>
            Opciones
          </small>
        </h4>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
        <i class="fa fa-plus"></i> Nuevo Parametro
      </button>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">
          <a class="btn btn-primary" id="agregarSeccionExamen"><i class="fa fa-plus"></i> Agregar sección</a>
        </label>
      </div>
    </center>
    </div>
  </div>
  <div class="ln_solid"></div>
        <div class="clearfix"></div>
        <div class="seccionesExamenes x_panel" id="seccionesExamenes">
        <!--Inicia una sección General -->
        <div class='col-md-6 col-sm-6 col-xs-12'>
        <div class='x_panel'>
        <div class='x_title'>
        <div class='col-md-9 col-sm-9 col-xs-12'>
        <span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>
        <select class='form-control has-feedback-left' name='selectSeccion0' id='selectSeccion0'>@foreach ($secciones as $seccion)
          <option value={{$seccion->id}}>{{ $seccion->nombre}}</option>
        @endforeach</select></select></div>
        <ul class='nav navbar-center panel_toolbox'>
        <li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>
        </ul><div class='clearfix'></div></div>
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
          <label>
            <input type="checkbox" name="checkReactivo" id="checkReactivo0" onClick="chekearReactivo(this,0);" class="js-switch" unchecked /> Añadir reactivo
          </label></div>
        </div>
        <div class='row'>
        <div class='col-md-5 col-sm-12 col-xs-12 form-group'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span><select class='form-control has-feedback-left' name='selectParametrosExamenes0' id='selectParametrosExamenes0'>@foreach ($parametros as $parametro)
          <option value={{$parametro->id}}>{{ $parametro->nombreParametro}}</option>
        @endforeach</select></div>
        <div id="divReactivo0" class='col-md-5 col-sm-12 col-xs-12 form-group' style="display:none;"><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span><select class='form-control has-feedback-left'  name='selectReactivosExamenes0' id='selectReactivosExamenes0'>@foreach ($reactivos as $reactivo)
          <option value={{$reactivo->id}}>{{ $reactivo->nombre}}</option>
        @endforeach</select></div>
        <div class='col-md-2 col-sm-12 col-xs-12 form-group'><span class='input-group-btn'><button type='button' name='button' class='btn btn-primary' id='agregarParametroReactivo' onClick='agregarParametro(0)'><i class='fa fa-save'></i></button></span></div>
        <table class='table' id='tablaParametros0'><thead><th>Parametros</th><th>Reactivos</th><th style='width : 80px'>Acción</th></thead>
        <tbody></tbody></table>
        </div></div></div></div>
              <!--AQUI SE AGREGAN LAS SECCIONES -->
              <input type='hidden' id='totalSecciones' name='totalSecciones' value="1"/>
      </div>
    <div class="form-group">
      <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-light">Limpiar</button>
      <a href={!! asset('/examenes') !!} class="btn btn-light">Cancelar</a>
    </center>
  </div>
</div>
