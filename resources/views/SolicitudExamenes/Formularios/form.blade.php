<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <input type="hidden" id="seleccion">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_paciente',null,['id'=>'n_paciente','class'=>'form-control','placeholder'=>'Nombre del paciente']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary" id="agregar_paciente" onclick="input_seleccion('paciente');">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="f_paciente" id="f_paciente">
    </div>
  </div>
  <div role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#tab_content1" id="tab1" role="tab" data-toggle="tab" aria-expanded="true">
          Bacteriología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content2" id="tab2" role="tab" data-toggle="tab" aria-expanded="true">
          Exámenes de heces
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content3" id="tab3" role="tab" data-toggle="tab" aria-expanded="true">
          Exámenes de orina
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content4" id="tab4" role="tab" data-toggle="tab" aria-expanded="true">
          Hematología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content5" id="tab5" role="tab" data-toggle="tab" aria-expanded="true">
          Inmunología
        </a>
      </li>
      <li role="presentation" class="">
        <a href="#tab_content6" id="tab6" role="tab" data-toggle="tab" aria-expanded="true">
          Química sanguinea
        </a>
      </li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="tab_content1" role="tabpanel" aria-labelledby="tab1">
        <div>
          <div class="row">
            <h4>Área Bacteriologica</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
                @if($examen->area == "BACTERIOLOGIA")
                  <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                    <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                      {{ $examen->nombreExamen }}
                    </button>
                    <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                  </span>
                @endif
            @endforeach
          </div>
        </div>
      </div>
    
      <div class="tab-pane fade" id="tab_content2" role="tabpanel" aria-labelledby="tab2">
        <div>
          <div class="row">
            <h4>Área de Exámenes de heces</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
                @if($examen->area == "EXAMENES DE HECES")
                  <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                    <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                      {{ $examen->nombreExamen }}
                    </button>
                    <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                  </span>
                @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab_content3" role="tabpanel" aria-labelledby="tab3">
        <div>
          <div class="row">
            <h4>Área de Exámenes de orina</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "EXAMENES DE ORINA")
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }}
                  </button>
                  <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab_content4" role="tabpanel" aria-labelledby="tab4">
        <div>
          <div class="row">
            <h4>Área Hematologica</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "HEMATOLOGIA")
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }}
                  </button>
                  <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab_content5" role="tabpanel" aria-labelledby="tab5">
        <div>
          <div class="row">
            <h4>Área Inmunologica</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "INMUNOLOGIA")
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }}
                  </button>
                  <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab_content6" role="tabpanel" aria-labelledby="tab6">
        <div>
          <div class="row">
            <h4>Área de Química sanguinea</h4>
          </div>
          <div class="row">
            @foreach($examenes as $examen)
              @if($examen->area == "QUIMICA SANGUINEA")
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12" data-color="success">
                    {{ $examen->nombreExamen }}
                  </button>
                  <input type="checkbox" class="hidden" name="examen[]" value={{$examen->id}}>
                </span>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <a href={!! asset($ruta) !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" style="height:300px">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('busqueda',null,['id'=>'busqueda','class'=>'form-control has-feedback-left','placeholder'=>'Nombre o apellido del usuario']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-12"></div>
            <div class="col-md-8 col-xs-12">
              <table class="table" id="tablaPaciente">
                <thead>
                  <th>Nombre</th>
                  <th style="width: 80px">Opciones</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
</script>
