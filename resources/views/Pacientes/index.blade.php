@extends('dashboard')
@section('layout')
  @include('Pacientes.Formularios.modal')
  <!-- page content -->
  <!--Panel-->
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pacientes<small>Activos</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <center>
            <div class="btn-group">
              <button class="btn btn-dark" type="button" data-toggle="modal" data-target=".modal-new"><i class="fa fa-plus"></i> Nuevo</button>
              <button class="btn btn-dark" type="button"><i class="fa fa-file"></i> Reporte</button>
              <button class="btn btn-dark" type="button"><i class="fa fa-trash"></i> Papelera</button>
              <button class="btn btn-primary" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </center>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Apellido</th>
              <th>Nombre</th>
              <th>Sexo</th>
              <th>Teléfono</th>
              <th colspan="2">Opciones</th>
            </tr>
          </thead>
          <tbody id="tablaPacientes">
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal fade modal-new" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Paciente<small> Nuevo </small></h4>
          </div>
          <div class="modal-body">
            <!--Cuerpo del modal-->
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    {!!Form::open(['class'=>'form-horizontal form-label-left input_mask','route'=>'pacientes.store','method'=>'POST', 'autocomplete'=>'off'])!!}
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('nombre',null,['id'=>'nombrePaciente','class'=>'form-control','placeholder'=>'Nombre del paciente']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('apellido',null,['id'=>'apellidoPaciente','class'=>'form-control','placeholder'=>'Apellido del paciente']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo</label>
                      <label>
                        {!!Form :: radio ( "sexo",1,true,['id'=>'sexoMasculino', 'class'=>'flat'])!!} Masculino
                      </label>
                      <label>
                        {!!Form :: radio ( "sexo",0,false,['id'=>'sexoFemenino', 'class'=>'flat'])!!} Femenino
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('telefono',null,['id'=>'telefonoPaciente','class'=>'form-control','placeholder'=>'Teléfono del paciente']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::textarea('direccion',null,['id'=>'direccionPaciente','class'=>'form-control','placeholder'=>'Dirección del paciente','rows'=>'2']) !!}
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
            </div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @section('scripts')
    {!!Html::script('js/scripts/paciente/Pacientes.js')!!}
    {!!Html::script('js/scripts/paciente/PacientesMostrar.js')!!}
  @endsection
  <!-- /page content -->
@stop
