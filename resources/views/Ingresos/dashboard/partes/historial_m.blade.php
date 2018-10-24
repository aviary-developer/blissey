<div class="row">
  <div class="col-sm-2">
    <button type="button" class="btn btn-sm btn-dark" id="back_historial" data-tooltip="tooltip" title="Atras" style="display:none"><i class="fa fa-arrow-left"></i></button>
    <input type="hidden" id="nivel" value="">
  </div>
  <div class="col-sm-8">
    <center>
      <h5 class="text-info">Historial Médico</h5>
    </center>
  </div>
  <div class="col-sm-2"></div>
</div>
<div class="col-sm-12" style="height: 480px; overflow-x:hidden; overflow-y:scroll" id="historial">
  @if ($historial != null)
    @foreach ($historial as $ingreso)
      <div class="col-sm-12 m-1 border border-secondary rounded">
        <div class="flex-row">
          <center>
            <h6 class="text-primary mt-1">
              <i class="far fa-calendar"></i> 
              {{$ingreso->fecha_ingreso->formatLocalized('%d de %B de %Y')}}
            </h6>
          </center>
        </div>
        <div class="flex-row mb-1">
          <div class="col-sm-10">
            @if ($ingreso->tipo == 3 && $ingreso->consulta->count() > 0)
              <div class="flex-row">
                <center>
                  <span class="font-weight-bold">
                    <i class="fa fa-stethoscope"></i> 
                    {{(($ingreso->consulta[0]->medico->sexo)?"Dr. ":"Dra. ").$ingreso->consulta[0]->medico->nombre.' '.$ingreso->consulta[0]->medico->apellido}}
                  </span>
                </center>
              </div>
              <div class="flex-row mb-1">
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
            <div class="flex-row">
              <center>
                @if ($ingreso->tipo == 0)
                  <span class="col-6 badge font-sm mb-2 badge-success">Hospitalización</span>
                @elseif($ingreso->tipo == 1)
                  <span class="col-6 badge font-sm mb-2 badge-purple">Medi Ingreso</span>
                @elseif($ingreso->tipo == 2)
                  <span class="col-6 badge font-sm mb-2 badge-primary">Observación</span>
                @elseif($ingreso->tipo == 3)
                  <span class="col-6 badge font-sm mb-2 badge-pink">Consulta Médica</span>
                @endif
              </center>
            </div> 
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-sm btn-dark mb-2" onclick={{'v_consulta('.(($ingreso->tipo == 3 && $ingreso->consulta->count() > 0)?$ingreso->consulta[0]->id:$ingreso->id).','.$ingreso->tipo.')'}}>
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