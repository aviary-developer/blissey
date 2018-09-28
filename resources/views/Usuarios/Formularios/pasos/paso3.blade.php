<div class="flex-row">
  <center>
    <h5>Datos de la Especialidad</h5>
  </center>
</div>
<div class="row">
  <p id="texto" style="display:none">El tipo de usuario que ha seleccionado, <b>NO</b> requiere detallar la especialidad</p>
  <div class="col-sm-6" id="divisor">
    <div id="div_solo">
      <div id="div_junta">
        <div class="form-group" id="juntaVigilancia">
          <label class="" for="juntaVigilancia">Junta de Vigilancia *</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-users"></i></div>
            </div>
            {!! Form::text(
              'juntaVigilancia',
              null,
              ['class'=>'form-control form-control-sm',
                'placeholder'=>'Número de Junta de Vigilancia']
            ) !!}
          </div>
        </div>
      </div>
    </div>
    <div id="div_grupo">
      <div id="div_firma">
        <div class="form-group" id="firma">
          <label class="" for="firma">Firma </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="custom-file input-group">
              <input type="file" name="firma" class="custom-file-input" id="firma_file" lang="es">
              <label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar Archivo</label>
            </div>
          </div>
        </div>
        <div>
          <center>
            <output id="list2" style="height:100px">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 75px">
              @else
                <img src={{asset(Storage::url($usuarios->firma))}} style="height : 75px">
              @endif
            </output>
          </center>
        </div>
      </div>
      <div id="div_sello">
        <div class="form-group" id="sello">
          <label class="" for="sello">Sello </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="custom-file input-group">
              <input type="file" name="sello" class="custom-file-input" id="sello_file" lang="es">
              <label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar Archivo</label>
            </div>
          </div>
        </div>
        <div class="">
          <center>
            <output id="list3" style="height:100px">
              @if ($create)
                <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 75px">
              @else
                <img src={{asset(Storage::url($usuarios->sello))}} style="height : 75px">
              @endif
            </output>
          </center>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group" id="grupoEspecialidad">
      <label class="" for="nombre">Tipo de usuario *</label>
      <div class="input-group mb-2 mr-sm-2 ">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-stethoscope"></i></div>
        </div>
        <select class="form-control form-control-sm" name="especialidadSelect" id="especialidad">
          @foreach ($especialidades as $especialidad)
            <option value={{ $especialidad->id }}>{{ $especialidad->nombre }}</option>
          @endforeach
        </select>
        <div class="input-group-append">
          <div class="input-group-btn">
            <button type="button" name="button" class="btn btn-primary btn-sm pr-4 pl-4" id="agregar_especialidad" title="Guardar especialidad">
              <i class="fa fa-save"></i>
            </button>
          </div>
        </div>
        <small class="form-text text-muted">
          Solamente las especialidades agregadas a la tabla serán almacenadas, la primera será tomada como especialidad y las demás como subespecialidades.
        </small>
      </div>
    </div>
    <table class="table table-hover table-striped table-sm" id="tablaEspecialidad">
      <thead>
        <th>Especialidad</th>
        <th style="width : 80px">Acción</th>
      </thead>
      <tbody>
        @if (!$create && !$validacion_activa)
          @php
            $auxiliar = 0;
          @endphp
          <input type="hidden" name="delesp[]" value="ninguno" id="delesp">
          @foreach ($especialidad_usuarios as $key => $especialidad)
            <tr>
              <td>
                {{$especialidad->nombreEspecialidad($especialidad->f_especialidad)}}
              </td>
              <td>
                <input type="hidden" id={{"especialidad".$key}} value={{ $especialidad->f_especialidad }} name="esp_f[]">
                <input type="hidden" value={{ $especialidad->id }} name="esp_id[]">
                <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_especialidad_antiguo">
                  <i class="fa fa-remove"></i>
                </button>
              </td>
            </tr>
            @php
              $auxiliar = $key;
            @endphp
          @endforeach
          <input type="hidden" id="contador" value={{$auxiliar}}>
        @elseif($validacion_activa)
          @php
            $auxiliar = 0;
          @endphp
          @foreach($delesp as $especialidades_borradas)
            <input type="hidden" name="delesp[]" value={{$especialidades_borradas}}  id="delesp">
          @endforeach
          @if(isset($especialidad_id))    
            @foreach ($especialidad_id as $key => $especialidad)
              <tr>
                <td>
                  {{App\Especialidad::nombreEspecialidad($especialidad_f[$key])}}
                </td>
                <td>
                  <input type="hidden" id={{"especialidad".$key}} value={{ $especialidad_f[$key] }} name="esp_f[]">
                  <input type="hidden" value={{ $especialidad }} name="esp_id[]">
                  <button type="button" name="button" class="btn btn-danger btn-sm" id="eliminar_especialidad_antiguo">
                    <i class="fa fa-times"></i>
                  </button>
                </td>
              </tr>
              @php
                $auxiliar = $key;
              @endphp
            @endforeach
          @endif
          <input type="hidden" id="contador" value={{$auxiliar}}>
        @endif
        @if(isset($especialidades_tabla))
          @php
            $auxiliar = 0;
          @endphp
          @foreach ($especialidades_tabla as $key => $especialidad)
            <tr>
              <td>
                {{$especialidades[$key]->nombreEspecialidad($especialidad)}}
              </td>
              <td>
                <input type="hidden" id="{{"especialidad".$key}}" value={{$especialidad}}>
                <input type="hidden" name="especialidad[]" value={{ $especialidad}}>
                <button type="button" name="button" class="btn btn-danger btn-sm" id="eliminar_especialidad">
                  <i class="fa fa-remove"></i>
                </button>
              </td>
            </tr>
            @php
              $auxiliar = $key;
            @endphp
          @endforeach
          <input type="hidden" id="contador" value={{$auxiliar}}>
        @endif
      </tbody>
    </table>
  </div>
</div>

