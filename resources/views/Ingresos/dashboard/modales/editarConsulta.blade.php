<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="editarConsulta" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <div class="row">
      <div class="x_panel m_panel text-danger">
        <center>
          <h4 class="mb-1">
            <i class="fas fa-file-medical"></i>
            Editar consulta
          </h4>
        </center>
      </div>
    </div>

    <div class="row">
      <div class="x_panel m_panel" style="height: 500px">
        <div class="flex-row">
          <div class="col-sm-12">
            <div id="div_consulta">
              <form action="" class="form-horizontal input_mask">
                <input type="hidden" id="idConsultaEditar">
                <div class="form-group col-sm-12">
                  <label class="" for="motivo">Consulta por *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-edit"></i></div>
                    </div>
                    {!! Form::textarea(
                      'motivoEditar',
                      null,
                      ['class'=>'form-control form-control-sm',
                      'placeholder'=>'Motivo por el que pasa consulta',
                      'rows'=>'2', 
                      'id' => 'motivoEditar']) !!}
                  </div>
                </div>
          
                <div class="form-group col-sm-12">
                  <label class="" for="historia">Historia clínica *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-edit"></i></div>
                    </div>
                    {!! Form::textarea(
                      'historiaEditar',
                      null,
                      ['class'=>'form-control form-control-sm',
                      'placeholder'=>'Signos y sintomas',
                      'rows'=>'3', 
                      'id'=> 'historiaEditar']) !!}
                  </div>
                </div>
          
                <div class="form-group col-sm-12">
                  <label class="" for="historia">Examen físico *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-edit"></i></div>
                    </div>
                    {!! Form::textarea(
                      'examen_fisicoEditar',
                      null,
                      ['class'=>'form-control form-control-sm',
                      'placeholder'=>'Examen físico y signos vitales',
                      'rows'=>'3', 
                      'id'=> 'ex_fisicoEditar']) !!}
                  </div>
                </div>
          
                <div class="form-group col-sm-12">
                  <label class="" for="diagnostico">Diagnostico *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-edit"></i></div>
                    </div>
                    {!! Form::textarea(
                      'diagnosticoEditar',
                      null,
                      ['class'=>'form-control form-control-sm',
                      'placeholder'=>'Diagnostico clínico',
                      'rows'=>'2', 
                      'id'=> 'diagnosticoEditar']) !!}
                  </div>
                </div>
          
                <div class="col-sm-12">
                  <center style="margin-top: 10px">
                    <button type="button" class="btn-sm btn-primary btn" id="verRecetaEditar">Tratamiento</button>
                    <button type="button" class="btn-sm btn-ligth btn" onclick="location.reload()">Cerrar</button>
                  </center>
                </div>
              </form>
            </div>
          </div>
          @include('Ingresos.dashboard.modales.receta')
        </div>
        <div class="row" >
          <div style="overflow-x: hidden; overflow-y: scroll; height: 279px; width: 100%">
            <div id=""></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  
</script>