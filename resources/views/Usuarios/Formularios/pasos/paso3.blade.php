<div>
  <h4 class="StepTitle">Datos de Especialidad</h4>
  <p id="texto" style="display:none">El tipo de usuario que ha seleccionado, <b>NO</b> requiere detallar la especialidad</p>
  <div class="col-md-6 col-sm-6 col-xs-12" id="divisor">
    <div id="div_solo">
      <div id="div_junta">
        <div class="form-group" id="juntaVigilancia">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Junta de Vigilancia</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('juntaVigilancia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número de Junta de Vigilancia']) !!}
          </div>
        </div>
      </div>
    </div>
    <div id="div_grupo">
      <div id="div_firma">
        <div class="form-group" id="firma">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Firma</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('firma',['id'=>'firma_file','class'=>'form-control has-feedback-left']) !!}
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Sello</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('sello',['id'=>'sello_file','class'=>'form-control has-feedback-left']) !!}
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
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group" id="grupoEspecialidad">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Especialidad</label>
      <div class="col-md-9 col-sm-9 col-xs-12" id="especialidad">
        <div class="input-group">
          <select class="form-control has-feedback-left" name="especialidadSelect" id="select_especialidad">
            @foreach ($especialidades as $especialidad)
              <option value={{ $especialidad->id }}>{{ $especialidad->nombre }}</option>
            @endforeach
          </select>
          <span class="input-group-btn">
            <button type="button" name="button" class="btn btn-primary" id="agregar_especialidad" data-toggle="tooltip" data-placement="top" title="Guardar especialidad">
              <i class="fa fa-save"></i>
            </button>
            <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target=".bs-modal-lg" id="nueva_especialidad"  data-placement="top" title="Nueva especialidad">
              <i class="fa fa-plus"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
    <table class="table" id="tablaEspecialidad">
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
                  <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_especialidad_antiguo">
                    <i class="fa fa-remove"></i>
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
                <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_especialidad">
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

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">
          <span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title">Especialidad médica <small>Nueva</small></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label">Nombre *</label>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('nombre_especialidad',null,['id'=>'nombre_especialidad','class'=>'form-control has-feedback-left','placeholder'=>'Nombre de la nueva especialidad']) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="guardar_especialidad" class="btn btn-primary" type="button">Guardar</button>
        <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>  
</div>