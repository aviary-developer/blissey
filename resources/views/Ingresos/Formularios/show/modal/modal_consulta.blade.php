{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_consulta" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Consulta Médica</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label class="control-label col-xs-12">Consulta por *</label>
                <div class="col-xs-12">
                  <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                  {!! Form::textarea('motivo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Motivo por el que pasa consulta','rows'=>'2', 'id' => 'motivo']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-12">Historia clínica *</label>
                <div class="col-xs-12">
                  <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                  {!! Form::textarea('historia',null,['class'=>'form-control has-feedback-left','placeholder'=>'Signos y sintomas','rows'=>'4', 'id'=> 'historia']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-12">Examen físico *</label>
                <div class="col-xs-12">
                  <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                  {!! Form::textarea('examen_fisico',null,['class'=>'form-control has-feedback-left','placeholder'=>'Examen físico y signos vitales','rows'=>'3', 'id'=> 'ex_fisico']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-xs-12">Diagnostico *</label>
                <div class="col-xs-12">
                  <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                  {!! Form::textarea('diagnostico',null,['class'=>'form-control has-feedback-left','placeholder'=>'Diagnostico clínico','rows'=>'2', 'id'=> 'diagnostico']) !!}
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div id="panel_dinamico"></div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class = "btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
