@extends('dashboard')
@section('layout')
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?>
  @endif
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
        <h2>Usuarios
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
              <a href={!! asset('/usuarios/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('/usuarios/'.Auth::user()->id) !!} class="btn btn-dark btn-sm"><i class="fa fa-user"></i> Mi Perfil</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <a href={!! asset('/usuarios?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm">
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
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['route'=>'usuarios.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
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
              <th>Teléfono</th>
              <th>Tipo</th>
              <th>Especialidad</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($usuarios)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($usuarios as $usuario)
                <tr>
                  <td>
                    @if ($usuario->completed($usuario->id)!=false)
                      <a href={{asset('usuarios/'.$usuario->id.'/edit')}} data-toggle="tooltip" data-placement="top" title="Registro incompleto" class="btn btn-outline-warning btn-xs">
                        <i class="fa fa-warning"></i>
                      </a>
                    @endif
                  </td>
                  <td>{{ $correlativo }}</td>
                  <td>
                    <a href={{asset('usuarios/'.$usuario->id)}}>
                      {{ $usuario->apellido }}
                    </a>
                  </td>
                  <td>
                    <a href={{asset('usuarios/'.$usuario->id)}}>
                      {{ $usuario->nombre }}
                    </a>
                  </td>
                  <td>
                    @if ($usuario->sexo)
                      {{ "Masculino" }}
                    @else
                      {{ "Femenino" }}
                    @endif
                  </td>
                  <td>
                    @if($usuario->telefono($usuario->id) == "Sin teléfono")
                      <i style="color: red">{{ $usuario->telefono($usuario->id)}}</i>
                    @else    
                      {{ $usuario->telefono($usuario->id)}}
                    @endif
                  </td>
                  <td>
                    @if($usuario->tipoUsuario == "Gerencia")
                      <span class="label label-default col-md-12 col-sm-12 col-xs-12">Gerencia</span>
                    @elseif ($usuario->tipoUsuario == "Médico")
                      <span class="label label-primary col-md-12 col-sm-12 col-xs-12">Médico</span>
                    @elseif ($usuario->tipoUsuario == "Laboaratorio")
                      <span class="label label-success col-md-12 col-sm-12 col-xs-12">Laboratorio</span>
                    @elseif ($usuario->tipoUsuario == "Ultrasonografía")
                      <span class="label label-warning col-md-12 col-sm-12 col-xs-12">Ultrasonografía</span>
                    @elseif ($usuario->tipoUsuario == "Rayos X")
                      <span class="label label-info col-md-12 col-sm-12 col-xs-12">Rayos X</span>
                    @elseif ($usuario->tipoUsuario == "Recepción")
                      <span class="label label-danger col-md-12 col-sm-12 col-xs-12">Recepción</span>
                    @elseif ($usuario->tipoUsuario == "Enfermería")
                      <span class="label label-purple">Enfermería</span>
                    @elseif ($usuario->tipoUsuario == "Farmacia")
                      <span class="label label-dark-blue col-md-12 col-sm-12 col-xs-12">Farmacia</span>
                    @endif
                  </td>
                  <td>
                    @php
                      $especialidad = $usuario->especialidad_principal($usuario->id);
                    @endphp
                    @if($especialidad != 0)
                      <a href={{asset('/especialidades/'.$especialidad)}}>
                        {{$usuario->nombre_especialidad_index($especialidad)}}
                      </a>
                    @else
                      <i style="color: gray;">
                        {{$usuario->nombre_especialidad_index($especialidad)}}
                      </i>
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Usuarios.Formularios.activate')
                    @else
                      @include('Usuarios.Formularios.desactivate')
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="9">
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
          {!! str_replace ('/?', '?', $usuarios->appends(Request::only(['nombre','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
