<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="calendar-update" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">

          <div class="row">
            <center>
              <h3 id="cal-title-u">Titulo</h3>
              <input type="hidden" id="event-id" value="">
            </center>
          </div>

          <form action="" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-xs-3">Hora de inicio:</label>
              <span class="label label-lg label-primary col-xs-3 control-label" id="hora-i-u" style="margin-bottom: 0px; text-align:center">00:00</span>
              <label class="control-label col-xs-3">Hora final:</label>
              <span class="label label-lg label-danger col-xs-3 control-label" id="hora-f-u" style="margin-bottom: 0px; text-align:center">00:00</span>
              
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Título: *</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('titulo-ev',null,['id'=>'titulo-ev-u','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del evento']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::textarea('desc-ev-u',null,['id'=>'desc-ev-u','class'=>'form-control has-feedback-left','placeholder'=>'Descripción del evento', 'rows'=>'3']) !!}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="alignleft">
        <button type="button" class="btn btn-sm btn-danger" id="eliminar_evento">
          Eliminar
        </button>
      </div>
      <div class="alignright">
        <button type="button" class="btn btn-primary btn-sm" id="editar_evento">
          Guardar
        </button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>