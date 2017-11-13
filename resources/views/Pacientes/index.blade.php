@extends('dashboard')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pacientes
          @if ($estadoOpuesto)
            <small>Papelera</small>
          @else
            <small>Activos</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/pacientes/create') !!} class="btn btn-dark btn-ms"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('/paciente_pdf') !!} class="btn btn-dark btn-ms" target="_blank"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/pacientes?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-ms">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activos
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-ms" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['route'=>'pacientes.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
              @if ($estadoOpuesto)
                <input type="hidden" name="estado" value="0">
              @endif
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 40px"></th>
              <th>#</th>
              <th>Apellido</th>
              <th>Nombre</th>
              <th>Sexo</th>
              <th>Edad</th>
              <th>Teléfono</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($pacientes)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($pacientes as $paciente)
                <tr>
                  <td>
                    @if ($paciente->completed($paciente->id)!=false)
                      <a href={{asset('pacientes/'.$paciente->id.'/edit')}} data-toggle="tooltip" data-placement="top" title="Registro incompleto" class="btn btn-outline-warning btn-xs">
                        <i class="fa fa-warning"></i>
                      </a>
                    @endif
                  </td>
                  <td>{{ $correlativo }}</td>
                  <td>
                    <a href={{asset('pacientes/'.$paciente->id)}}>
                      {{ $paciente->apellido }}
                    </a>
                  </td>
                  <td>
                    <a href={{asset('pacientes/'.$paciente->id)}}>
                      {{ $paciente->nombre }}
                    </a>
                  </td>
                  <td>
                    @if ($paciente->sexo)
                      {{ "Masculino" }}
                    @else
                      {{ "Femenino" }}
                    @endif
                  </td>
                  <td>{{ $paciente->fechaNacimiento->age.' años' }}</td>
                  <td>
                    @if (strlen($paciente->telefono) != 9)
                      <i style="color:red">Sin teléfono</i>
                    @else
                      {{ $paciente->telefono }}
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Pacientes.Formularios.activate')
                    @else
                      @include('Pacientes.Formularios.desactivate')
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="8">
                  <center>
                    No hay registros que coincidan con los terminos de busqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $pacientes->appends(Request::only(['nombre','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
