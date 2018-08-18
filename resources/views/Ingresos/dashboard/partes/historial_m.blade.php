<div class="row">
  <div class="col-xs-2">
    <button type="button" class="btn btn-sm btn-dark" id="back_historial" data-tooltip="tooltip" title="Atras" hidden><i class="fa fa-arrow-left"></i></button>
    <input type="hidden" id="nivel" value="">
  </div>
  <div class="col-xs-8">
    <center>
      <h5 class="big-text">Historial Médico</h5>
    </center>
  </div>
  <div class="col-xs-2"></div>
</div>
<div class="row" style="height: 450px; overflow-x:hidden; overflow-y:scroll" id="historial">
  @if ($historial != null)
    @foreach ($historial as $ingreso)
      <div class="row borde" style="margin: 5px; border-radius: 4px;">
        <div class="row blue">
          <center>
            <h4>
              <i class="fa fa-calendar"></i> 
              {{$ingreso->fecha_ingreso->formatLocalized('%d de %B de %Y')}}
            </h4>
          </center>
        </div>
        <div class="row" style="margin-bottom: 8px;">
          <div class="col-xs-10">
            @if ($ingreso->tipo == 3)
              <div class="row">
                <center>
                  <span class="big-text">
                    <i class="fa fa-stethoscope"></i> 
                    {{(($ingreso->consulta[0]->medico->sexo)?"Dr. ":"Dra. ").$ingreso->consulta[0]->medico->nombre.' '.$ingreso->consulta[0]->medico->apellido}}
                  </span>
                </center>
              </div>
              <div class="row" style="margin-bottom: 5px;">
                <center>
                  <i>
                    <span>
                      {{
                        '"'.$ingreso->consulta[0]->diagnostico.'"'
                      }}
                    </span>
                  </i>
                </center>
              </div>
            @endif
            <div class="row">
              <div class="col-xs-3"></div>
              @if ($ingreso->tipo == 0)
                <span class="col-xs-6 label label-lg label-success">Hospitalización</span>
              @elseif($ingreso->tipo == 1)
                <span class="col-xs-6 label label-lg label-purple">Medi Ingreso</span>
              @elseif($ingreso->tipo == 2)
                <span class="col-xs-6 label label-lg label-primary">Observación</span>
              @elseif($ingreso->tipo == 3)
                <span class="col-xs-6 label label-lg label-pink">Consulta Médica</span>
              @endif
            </div> 
          </div>
          <div class="col-xs-2">
            <button type="button" class="btn btn-xs btn-dark" style="margin: auto" onclick={{'v_consulta('.(($ingreso->tipo == 3)?$ingreso->consulta[0]->id:$ingreso->id).','.$ingreso->tipo.')'}}>
              <i class="fa fa-eye"></i> Ver
            </button>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <center style="margin-top: 200px">
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>El paciente no reporta historial médico por el momento</span>
    </center>
  @endif
</div>