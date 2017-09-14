@extends('dashboard')
@section('layout')
  <!-- page content -->
  <!--Panel-->
  @if(Session::has('mensaje'))
  <?php $mensaje = Session::get('mensaje');
  echo "<script>swal('$mensaje', 'Registro almacenado', 'success')</script>";?>
  @endif
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
              <a href={!! asset('/pacientes/create') !!} class="btn btn-dark"><i class="fa fa-plus"></i> Nuevo</a>
              <button class="btn btn-dark" type="button"><i class="fa fa-file"></i> Reporte</button>
              <button class="btn btn-dark" type="button"><i class="fa fa-trash"></i> Papelera</button>
              <button class="btn btn-primary" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </center>
        </div>
        <br>
        <table class="table table-striped">
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
          @php
            $correlativo = 1;
          @endphp
          @foreach ($pacientes as $paciente)
            <tr>
              <td>{{ $correlativo }}</td>
              <td>{{ $paciente->apellido }}</td>
              <td>{{ $paciente->nombre }}</td>
              <td>
                @if ($paciente->sexo)
                  {{ "Masculino" }}
                @else
                  {{ "Femenino" }}
                @endif
              </td>
              <td>{{ $paciente->telefono }}</td>
              <td>
                <a href={!! asset('/pacientes/'.$paciente->id.'/edit')!!} class="btn btn-xs btn-primary">
                  <i class="fa fa-edit"></i>
                </a>
  				    </td>
  				    <td>
                @include('Pacientes.Formularios.desactivate')
              </td>
            </tr>
            @php
              $correlativo++;
            @endphp
          @endforeach
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
