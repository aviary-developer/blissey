<div class="modal fade modal-new1" tabindex="-1" role="dialog" aria-hidden="true" id="gg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Paciente<small> Actualizar</small></h4>
      </div>
      <div class="modal-body">
        <!--Cuerpo del modal-->
        <input type="hidden" name="_token" value="{{csrf_token()}}" id="tokenPacientes">
        <input type="hidden" id="idPaciente">
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">
                <br />
                @include('Pacientes.Formularios.paciente')
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {!!link_to('#',$title='Guardar',$attributes=['id'=>'actualizarPaciente','class'=>'btn btn-primary'],$secure = null)!!}
      </div>
    </div>
  </div>
</div>
