<div class="row" id="signos__" style="display: none;">
  <div class="row">
    <center>
      <h4>Signos vitales del paciente</h4>
    </center>
  </div>
  @if ($signos_vital!=null)
    <div style="overflow-y: scroll; height: 297px; width:97%">
    @foreach ($signos_vital as $sgn)
        <div class="row borde" style="border-radius: 3px; margin: 10px; padding: 5px;">
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-3">Fecha:</div>
                <div class="col-xs-9"><b class="blue">{{$sgn->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</b></div>
              </div>
              
            </div>
          </div>
          <div class="row" style="margin-top: 5px;">
            <center>
              <button type="button" class="btn btn-xs btn-primary" style="padding-right: 30px; padding-left: 30px;" onclick="{{'signos_load('.$sgn->id.')'}}"><i class="fa fa-eye"></i> Ver</button>
            </center>
          </div>
        </div>
      @endforeach
    </div>
  @else
  <br>
  <div class="row">
    <center>
      <p><i>El paciente no tiene signos vitales registrados</i></p>
    </center>
  </div>
  @endif
</div>