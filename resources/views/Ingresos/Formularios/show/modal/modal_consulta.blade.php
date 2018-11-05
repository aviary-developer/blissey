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
        <div class="">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="x_panel">
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
            </div>
            <div class="col-xs-12 col-sm-6 ">
              <div class="x_panel" style = "height: 394px;">
                <div class="row" id = "contenido__" style="height: 90%;">
                  @include('Ingresos.Formularios.consulta.informacion')
                  @include('Ingresos.Formularios.consulta.lista_consulta')
                  @include('Ingresos.Formularios.consulta.consulta')
                  @include('Ingresos.Formularios.consulta.lista_signos')
                  @include('Ingresos.Formularios.consulta.signo')
                  @include('Ingresos.Formularios.consulta.lista_examen')
                </div>
                <div class="ln_solid" style="margin: 5px 0;"></div>
                <div class="row">
                  <div class="btn-group col-xs-12">
                    <button type="button" class="btn btn-sm btn-primary col-xs-2" data-toggle="tooltip" data-placement="top" title="Información" id="btn_info"><i class="fa fa-user"></i></button>
                    <button type="button" class="btn btn-sm btn-dark col-xs-2" data-toggle="tooltip" data-placement="top" title="Consultas" id="btn_lista"><i class="fa fa-list"></i></button>
                    <button type="button" class="btn btn-sm btn-dark col-xs-2" data-toggle="tooltip" data-placement="top" title="Examenes Clínicos" id="btn_examen"><i class="fa fa-check-square"></i></button>
                    <button type="button" class="btn btn-sm btn-dark col-xs-2" data-toggle="tooltip" data-placement="top" title="Signos Vitales" id="btn_signos"><i class="fa-heartbeat fa"></i></button>
                    <button type="button" class="btn btn-sm btn-dark col-xs-2" data-toggle="tooltip" data-placement="top" title="Tratamiento"><i class="fa fa-medkit"></i></button>
                    <button type="button" class="btn btn-sm btn-dark col-xs-2" data-toggle="tooltip" data-placement="top" title="Estadística"><i class="fa fa-line-chart"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class = "btn btn-primary" id = "guardar_consulta">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
