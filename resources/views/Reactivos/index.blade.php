@extends('dashboard')
@section('layout')
<!-- page content -->
<!--Panel-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Reactivos<small>Activos</small></h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="btn-group">
          <button class="btn btn-success" type="button" data-toggle="modal" data-target=".modal-new">Nuevo</button>
          <!--<button class="btn btn-default" type="button">Pantalla1</button>
          <button class="btn btn-default" type="button">Pantalla2</button>
          <button class="btn btn-default" type="button">Pantalla3</button>-->
          <button class="btn btn-default" type="button">Reporte</button>
          <button class="btn btn-danger" type="button">Papelera</button>
          <button class="btn btn-info" type="button">Ayuda</button>
        </div>
      </div>
      <br>
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Contenido por envase</th>
            <th colspan="2">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reactivos as $reactivo)
          <tr>
            <td>{{$reactivo->id}}</td>
            <td>{{$reactivo->nombre}}</td>
            <td>{{$reactivo->descripcion}}</td>
            <td>{{$reactivo->contenidoPorEnvase}}</td>
            <td> {!!link_to_route("reactivos.edit", $title = "Editar", $parameters = $reactivo->id, $attributes = ["class"=>"btn btn-primary"])!!}
				    </td>
				    <td>@include('Reactivos.Formularios.eliminarReactivo')</td>
          </tr>
          @endforeach
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
          <h4 class="modal-title" id="myModalLabel">Reactivo<small> Nuevo </small></h4>
        </div>
        <div class="modal-body">
          <!--Cuerpo del modal-->
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <br />

                  {!!Form::open(['class'=>'form-horizontal form-label-left input_mask','route'=>'reactivos.store','method'=>'POST'])!!}
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre del nuevo reactivo']) !!}
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      {!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Describa el uso del reactivo']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad por envase</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    {!! Form::text('contenidoPorEnvase',null,['class'=>'form-control','placeholder'=>'Cantidad en ml']) !!}
                  </div>
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
<!-- /page content -->
{!! str_replace ('/?', '?', $reactivos-> render ()) !!}
@stop
