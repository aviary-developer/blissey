<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="row">
    <div class="col-md-10 col-sm-12 col-xs-10">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area de examen</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="area" id="" required>
            <option value={{$areaSeleccionada}} selected disabled>{{$areaSeleccionada}}</option>
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
          {!! Form::text('nombreExamen',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen','required']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de muestra *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="tipoMuestra" id="" required>
            <option value={{$muestraSeleccionada}} selected disabled>{{$examenes->nombreMuestra($muestraSeleccionada)}}</option>
            @foreach ($muestras as $muestra)
              <option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <center>
        <h4><small>Opciones</small></h4>
      </center>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">
        <i class="fa fa-plus"></i> Nuevo Parametro
      </button>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">
      <a class="btn btn-primary" id="agregarSeccionExamenEditar"><i class="fa fa-plus"></i> Agregar sección</a>
    </label>
  </div>
  <div class="ln_solid"></div>
  <div class="clearfix"></div>
  <div class="seccionesExamenes x_panel" id="seccionesExamenes">
  @if($e_s_p!=null)
    <input id="contadorEnEdit" name="contadorEnEdit" type="hidden" value={{count($secciones)}}>
    <input id="contadorTotal" name="contadorTotal" type="hidden" value={{count($secciones)}}>
    @php
    if($secciones!=null){
      $conteoss=count($secciones);
    }else{
      $conteoss=0;
    }
    @endphp
    @for ($i=0; $i <$conteoss; $i++)
      <div class='col-md-6 col-sm-6 col-xs-12'>
        <div class='x_panel'>
          <div class='x_title'>
            <div class='col-md-9 col-sm-9 col-xs-12'>
              <span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>
              <select class='form-control has-feedback-left' name='selectSeccion{{$i}}' id='selectSeccion{{$i}}'>
                <option value={{$secciones[$i]}}>{{$examenes->nombreSeccion($secciones[$i])}}</option>
                @foreach ($seccionesTabla as $seccionesTabla1)
                  <option value={{ $seccionesTabla1->id }}>{{ $seccionesTabla1->nombre }}</option>
                @endforeach
              </select>
            </div>
            <ul class='nav navbar-right panel_toolbox'>
              <li><a class='close-link' onClick='cerrarSeccionEditar(this,{{$i}});'><i class='fa fa-close'></i></a></li>
            </ul>
            <div class='clearfix'></div>
          </div>
          <div class='x_content'>
            <div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>
              <select class='form-control has-feedback-left' name='selectParametrosExamenes{{$i}}' id='selectParametrosExamenes{{$i}}' onChange='agregarParametro(this,{{$i}})';>
                <option value="-1"><strong>[Seleccione nuevos parametros]</strong></option>
                @foreach ($parametros as $parametro)
                  <option value={{ $parametro->id }}>{{ $parametro->nombreParametro}}</option>
                @endforeach</select>
              <hr>
              <table class='table' id='tablaParametros{{$i}}'><thead><th>Parametros</th><th style='width : 80px'>Acción</th></thead>
                <tbody>
                @foreach ($e_s_p as $esp)
                  @if ($esp->f_seccion==$secciones[$i])
                  <tr>
                  <td>
                  <input type='hidden' id='parametrosEnTabla{{$i}}[]' name='parametrosEnTabla{{$i}}[]' value = {{$esp->f_parametro}} />{{$esp->nombreParametro($esp->f_parametro)}}</td>
                  <td>
                  <button type = 'button' name='button' class='btn btn-danger btn-xs' onClick='eliminarParametroEnTabla(this);'>
                  <i class='fa fa-remove'></i>
                  </button>
                  </td>
                  </tr>
                @endif
                  @endforeach
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
      @endfor
    @else
      <input id="contadorEnEdit" name="contadorEnEdit" type="hidden">
      <input id="contadorTotal" name="contadorTotal" type="hidden">
@endif</div>
    <div class="form-group">
      <center>
        {!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
        <button type="reset" name="button" class="btn btn-light">Limpiar</button>
        <a href={!! asset('/examenes') !!} class="btn btn-light">Cancelar</a>
      </center>
    </div>
  </div>
