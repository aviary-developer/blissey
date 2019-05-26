<div class="row" style="display:none" id="examenes__">
  <div class="row">
    <center>
      <h4>Exámenes del paciente</h4>
    </center>
  </div>
  @if ($examenes_paciente != null)
    <div style="overflow-y: scroll; height: 297px; width: 97%">
      @foreach ($examenes_paciente as $ep)
        <div class="row borde" style ="border-radius: 3px; margin: 10px; padding: 5px;">
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-3">Fecha: </div>
                <div class="col-xs-9">
                  @if ($ep->f_examen != null)
                    <b class="blue">{{$ep->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</b>
                  @elseif($ep->f_ultrasonografia != null)
                    <b class="red">{{$ep->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</b>
                  @else  
                    <b class="green">{{$ep->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</b>
                  @endif
                </div>
              </div>
              @if ($ep->f_examen != null)
                <div class="row">
                  <div class="col-xs-3">Examen:</div>
                  <div class="col-xs-9"><b class="blue">{{$ep->examen->nombreExamen}}</b></div>
                </div>
              @elseif($ep->f_ultrasonografia != null)
                <div class="row">
                  <div class="col-xs-3">Ultrasonografía:</div>
                  <div class="col-xs-9"><b class="red">{{$ep->ultrasonografia->nombre}}</b></div>
                </div>
              @else
                <div class="row">
                  <div class="col-xs-3">Rayos X:</div>
                  <div class="col-xs-9"><b class="green">{{$ep->rayox->nombre}}</b></div>
                </div>
              @endif
              @if ($ep->f_examen != null)
                <div class="row" style="margin-top: 5px;">
                  <center>
                    <a href={!! asset('/entregarExamen/'.$ep->id.'/'.$ep->f_examen)!!} class="btn btn-xs btn-primary" style="padding-right: 30px; padding-left: 30px;" target="blank"><i class="fa fa-eye"></i> Ver</a>
                  </center>
                </div>  
              @elseif($ep->f_ultrasonografia != null)
                <div class="row" style="margin-top: 5px;">
                  <center>
                    <a href={!! asset('/entregarExamen/'.$ep->id.'/'.$ep->f_examen)!!} class="btn btn-xs btn-danger" style="padding-right: 30px; padding-left: 30px;" target="blank"><i class="fa fa-eye"></i> Ver</a>
                  </center>
                </div>  
              @else
                <div class="row" style="margin-top: 5px;">
                  <center>
                    <a href={!! asset('/entregarExamen/'.$ep->id.'/'.$ep->f_examen)!!} class="btn btn-xs btn-success" style="padding-right: 30px; padding-left: 30px;" target="blank"><i class="fa fa-eye"></i> Ver</a>
                  </center>
                </div>  
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <br>
    <div class="row">
      <center>
        <p><i>El paciente no tiene examenes registrados</i></p>
      </center>
    </div>
  @endif
</div>