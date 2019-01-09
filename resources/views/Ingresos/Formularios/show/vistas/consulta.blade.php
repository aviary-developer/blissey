<div class="row">
  <div class="col-xs-9">
    <h3>Consulta Médica	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_consulta" id="consulta_btn_modal">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
@if ($ingreso->consulta!=null)
  <div class="row">
    @foreach ($ingreso->consulta as $consulta)
      <div class="row borde" style="border-radius: 3px; margin: 5px; padding: 5px;">
        <div class="row bg-blue" style="margin: 5px;">
          <center>
            <h4><i class="fa fa-calendar"></i> {{$consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</h4>
          </center>
        </div>
        <div class="row bg-gray" style="margin: 0px 5px 0px 5px;">
          <center>
            <span class="black">
              <b>
                Consulta por
              </b>
            </span>
          </center>
        </div>
        <div class="row" style="margin: 0px 10px 0px 10px;">
          <span>{{$consulta->motivo}}</span>
        </div>
        <div class="row bg-gray" style="margin: 0px 5px 0px 5px;">
          <center>
            <span class="black">
              <b>
                Diagnóstico
              </b>
            </span>
          </center>
        </div>
        <div class="row" style="margin: 0px 10px 0px 10px;">
          <span>{{$consulta->diagnostico}}</span>
        </div>
      </div>
    @endforeach
  </div>
@else
@endif  