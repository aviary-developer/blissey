@extends('dashboard')
@section('layout')
  @php
  $index = false;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Usuario
          <small>
            {{ $usuario->nombre.' '.$usuario->apellido }}
          </small>
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            @include('Usuarios.Formularios.activate')
          </div>
        </div>
        <br>
        {{-- Incio de tab --}}
        <div class="row">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <div class="col-xs-2">
              <center>
                <img src={{asset(Storage::url($usuario->foto))}} alt="" class="img-circle perfil-2">
              </center>
              @if($usuario->tipoUsuario == "Gerencia")
                <span class="label label-default label-lg col-xs-12">Gerencia</span>
              @elseif ($usuario->tipoUsuario == "Médico")
                <span class="label label-primary label-lg col-xs-12">Médico</span>
              @elseif ($usuario->tipoUsuario == "Laboaratorio")
                <span class="label label-success label-lg col-xs-12">Laboratorio</span>
              @elseif ($usuario->tipoUsuario == "Ultrasonografía")
                <span class="label label-warning label-lg col-xs-12">Ultrasonografía</span>
              @elseif ($usuario->tipoUsuario == "Rayos X")
                <span class="label label-info label-lg col-xs-12">Rayos X</span>
              @elseif ($usuario->tipoUsuario == "Recepción")
                <span class="label label-danger label-lg col-xs-12">Recepción</span>
              @elseif ($usuario->tipoUsuario == "Enfermería")
                <span class="label label-purple label-lg col-xs-12">Enfermería</span>
              @elseif ($usuario->tipoUsuario == "Farmacia")
                <span class="label label-dark-blue label-lg col-xs-12">Farmacia</span>
              @endif
              <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
                <li role="presentation" class="active">
                  <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Personales</a>
                </li>
                @if ($usuario->tipoUsuario != 'Recepción' && $usuario->tipoUsuario != 'Enfermería' && $usuario->tipoUsuario != 'Farmacia')
                  <li role="presentation" class="">
                    <a href="#tab_content4" id="otros-tab4" role="tab" data-toggle="tab" aria-expanded="false">Datos Profesionales</a>
                  </li>
                @endif
                @if (Auth::user()->id==$id)
                  <li role="presentation" class="">
                    <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Datos de usuario</a>
                  </li>
                  <li role="presentation" class="">
                    <a href="#tab_content3" id="otros-tab3" role="tab" data-toggle="tab" aria-expanded="false">Historial</a>
                  </li>
                @endif
                <li role="presentation" class="">
                  <a href="#tab_content5" id="otros-tab5" role="tab" data-toggle="tab" aria-expanded="false">Metadatos</a>
                </li>
              </ul>
            </div>
            {{-- Contenido del tab --}}
            <div class="col-xs-10">
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
                  <div>
                    <h3>Datos Personales</h3>
                    <table class="table">
                      <tr>
                        <th style="width: 200px">Nombre</th>
                        <td>{{ $usuario->nombre }}</td>
                      </tr>
                      <tr>
                        <th>Apellido</th>
                        <td>{{ $usuario->apellido }}</td>
                      </tr>
                      <tr>
                        <th>Fecha de nacimiento</th>
                        <td>
                          {{ $usuario->fechaNacimiento->formatLocalized('%d de %B de %Y')}}
                          &nbsp;
                          <span class="badge">
                            {{$usuario->fechaNacimiento->age.' años' }}
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <th>Sexo</th>
                        <td>
                          @if ($usuario->sexo)
                            <span class="label-lg label label-cian col-xs-4">Masculino</span>
                          @else
                            <span class="label-lg label label-pink col-xs-4">Femenino</span>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        @if (count($telefonos)>1)
                          <th>Teléfonos</th>    
                        @else
                          <th>Teléfono</th>
                        @endif
                        <td>
                          @if (count($telefonos)>0)
                            <div class="row col-xs-5">
                              @foreach ($telefonos as $telefono)
                                <span class="label label-lg label-white black col-xs-11">
                                  {{$telefono->telefono}}
                                </span>
                              @endforeach
                            </div>
                          @else
                            <span class="label label-lg label-white red borde col-xs-4">Ninguno</span>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>E-mail</th>
                        <td>{{$usuario->email}}</td>
                      </tr>
                      <tr>
                        <th>Dirección</th>
                        <td>{{ $usuario->direccion }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                {{-- Otra pestaña --}}
                @if (Auth::user()->id == $id)
                  <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                    <table class="table">
                      <tr>
                        <th>Nombre de usuario</th>
                        <td>{{$usuario->name}}</td>
                      </tr>
                      <tr>
                        <th>Tipo de usuario</th>
                        <td>{{$usuario->tipoUsuario}}</td>
                      </tr>
                      <tr>
                        <th>Rol</th>
                        <td>{{($usuario->administrador)?"Administrador":"Ninguno"}}</td>
                      </tr>
                    </table>
                  </div>
                  {{-- Otra pestaña --}}
                  <div class="tab-pane fade" role="tabpanel" id="tab_content3" aria-labelledby="otros-tab3">
                    @include('Bitacoras.form.tabla');
                    <center>
                       {!! str_replace ('/?', '?', $bitacoras->render ()) !!}
                    </center>
                  </div>
                @endif
                @if ($usuario->tipoUsuario != 'Recepción' && $usuario->tipoUsuario != 'Enfermería' && $usuario->tipoUsuario != 'Farmacia')
                <div class="tab-pane fade" role="tabpanel" id="tab_content4" aria-labelledby="otros-tab4">
                  <h3>Datos Profesionales</h3>
                  <table class="table">
                      <tr>
                        <th style="width: 200px">Número de Junta de Vigilancia</th>
                        <td>
                          <span class="label label-lg label-white black col-xs-4">
                            {{$usuario->juntaVigilancia}}
                          </span>
                        </td>
                      </tr>
                      @if(isset($especialidad_principal))
                        <tr>
                          <th>Especialidad principal</th>
                          <td>
                            <span class="label label-lg label-white black col-xs-4">
                              {{$especialidad_principal->nombreEspecialidad($especialidad_principal->f_especialidad)}}
                            </span>
                          </td>
                        </tr>
                      @endif
                      @if (count($especialidades)>0)
                        <th>Subespecialidades</th>
                        <td>
                          <div class="col-xs-5">
                            <span class="col-xs-11 label label-lg label-white black">
                              @foreach ($especialidades as $especialidad)
                                {{$especialidad->nombreEspecialidad($especialidad->f_especialidad)}}
                              @endforeach
                            </span>
                          </div>
                        </td>
                      @endif
                    </table>
                    <div class="col-sm-6 col-xs-12">
                    @if ($usuario->tipoUsuario != 'Recepción' && $usuario->tipoUsuario != 'Enfermería' && $usuario->tipoUsuario != 'Farmacia')
                      <div class="col-md-6">
                        <img src={{asset(Storage::url($usuario->firma))}} class="img-responsive miniperfil">
                        <center>Firma</center>
                      </div>
                      <div class="col-md-6">
                        <img src={{asset(Storage::url($usuario->sello))}} class="img-responsive miniperfil">
                        <center>Sello</center>
                      </div>
                    @endif
                  </div>
                  </div>
                @endif
                <div class="tab-pane fade" role="tabpanel" id="tab_content5" aria-labelledby="otros-tab5">
                  <h3>Metadatos</h3>
                  <table class="table">
                    <tr>
                      <th>Estado</th>
                      <td>
                        @if ($usuario->estado)
                          <span class="label label-lg label-success col-xs-4">Activo</span>
                        @else
                          <span class="label label-lg label-danger col-xs-4">En papelera</span>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Fecha de creación</th>
                      <td>{{ $usuario->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                    </tr>
                    <tr>
                      <th>Fecha de modificación</th>
                      <td>{{ $usuario->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal --}}
  <input type="hidden" id="token" value="{{ csrf_token() }}">
  <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            @include('Usuarios.Formularios.contra')
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn_change" type="button" class="btn btn-primary">Cambiar</button>
          <button type="button" class="btn btn-default" id="limpiar_paciente_filtro">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>
@endsection
