<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_paciente',null,['id'=>'paciente','class'=>'form-control','placeholder'=>'Nombre del paciente']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target=".bs-modal-lg" class="btn btn-primary" id="agregar_paciente">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-xs-12">Médico *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="f_medico">
        @foreach ($medicos as $medico)
          <option value={{$medico->id}}>{{(($medico->sexo)?'Dr. ':'Dra. ').$medico->apellido.', '.$medico->nombre}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-xs-12">Habitación *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="f_habitacion">
        @foreach ($habitaciones as $habitacion)
          <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset($ruta) !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" style="height:300px">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('busqueda',null,['id'=>'busqueda','class'=>'form-control has-feedback-left','placeholder'=>'Nombre o apellido del usuario']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-12"></div>
            <div class="col-md-8 col-xs-12">
              <table class="table" id="tablaPaciente">
                <thead>
                  <th>Nombre</th>
                  <th style="width: 80px">Opciones</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
