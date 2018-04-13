<div class="row">
  <div class="col-xs-9">
    <h3>Consulta Médica	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_signos">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
<input type="hidden" id="consulta_count" value={{count($ingreso->signos)}}>