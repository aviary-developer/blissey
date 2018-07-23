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
  <div class="col-md-10 col-sm-10 col-xs-12">
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
          <div class="col-md-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/pacientes/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target=".bs-modal-lg" id="abrir_filtro" >
                <i class="fa fa-search"></i>
                Buscar
              </button>
              @if ($contador > 0 && $contador < 10)
                <a href={!! asset('/paciente_pdf'.$ruta) !!} class="btn btn-dark btn-sm" target="_blank"><i class="fa fa-file"></i> Reporte</a>
              @else
                <a href={!! asset('#') !!} disabled class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="No se puede generar reporte"><i class="fa fa-file"></i> Reporte</a>
              @endif
              <a href={!! asset('/pacientes?estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
                @if ($estadoOpuesto)
                  <i class="fa fa-check"></i> Activos
                  <span class="label label-success">{{ $activos }}</span>
                @else
                  <i class="fa fa-trash"></i> Papelera
                  <span class="label label-warning">{{ $inactivos }}</span>
                @endif
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
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
                      <span class="label-lg label label-cian">Masculino</span>
                    @else
                      <span class="label-lg label label-pink">Femenino</span>
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
                    No hay registros que coincidan con los términos de búsqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $pacientes->appends(Request::only(['nombre','apellido','sexo','telefono','dui','direccion','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->

  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    {!!Form::open(['route'=>'pacientes.index','method'=>'GET','role'=>'search','autocomplete'=>'off'])!!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Buscar</h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            @include('Pacientes.Formularios.filtro')
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Buscar</button>
          <button type="button" class="btn btn-default" id="limpiar_paciente_filtro">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
    {!!Form::close()!!}
  </div>
@endsection
