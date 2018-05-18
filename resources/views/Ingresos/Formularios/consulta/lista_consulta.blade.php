<div class="row" id="consultas__" style="display: none;">
  <div class="row">
    <center>
      <h4>Consultas del paciente</h4>
    </center>
  </div>
  @if (count($consultas) > 0)
    <div style="overflow-y: scroll; height: 297px; width:97%">
    @foreach ($consultas as $cst)
        <div class="row borde" style="border-radius: 3px; margin: 10px; padding: 5px;">
          <div class="col-xs-10">
            <div class="row">
              <div class="col-xs-3">Fecha:</div>
              <div class="col-xs-9"><b class="blue">{{$cst->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</b></div>
            </div>
            <div class="row">
              <div class="col-xs-3">Diagnóstico:</div>
              <div class="col-xs-9"><b class="blue">{{$cst->diagnostico}}</b></div>
            </div>
            <div class="row">
              <div class="col-xs-3">Médico:</div>
              <div class="col-xs-9">
                @if ($cst->medico != null)
                  <b class="blue">{{(($cst->medico->sexo)?'Dr. ':'Dra. ').$cst->medico->nombre.' '.$cst->medico->apellido}}</b>
                @else
                  <i>No hay un médico asociado a la consulta</i>
                @endif
              </div>
            </div>
          </div>
          <div class="col-xs-2"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button></div>
        </div>
      @endforeach
    </div>
  @else
  <br>
  <div class="row">
    <center>
      <p><i>El paciente no tiene consultas registradas</i></p>
    </center>
  </div>
  @endif
</div>