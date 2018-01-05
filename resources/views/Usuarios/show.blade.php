@extends('dashboard')
@section('layout')
  @php
  $index = false;
  setlocale(LC_ALL,'es');
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
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
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Personales</a>
            </li>
            @if (Auth::user()->id==$id)
              <li role="presentation" class="">
                <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Datos de usuario</a>
              </li>
              <li role="presentation" class="">
                <a href="#tab_content3" id="otros-tab3" role="tab" data-toggle="tab" aria-expanded="false">Historial</a>
              </li>
            @endif
          </ul>
          {{-- Contenido del tab --}}
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <div class="col-md-4 col-xs-12">
                <img src={{asset(Storage::url($usuario->foto))}} class="img-responsive avatar-view perfil">
                <center>Foto</center>
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
              <div class="col-md-6 col-xs-12">
                <table class="table">
                  <tr>
                    <th>Nombre</th>
                    <td>{{ $usuario->nombre }}</td>
                  </tr>
                  <tr>
                    <th>Apellido</th>
                    <td>{{ $usuario->apellido }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de nacimiento</th>
                    <td>{{ $usuario->fechaNacimiento->formatLocalized('%d de %B de %Y').' ('.$usuario->fechaNacimiento->age.' años)' }}</td>
                  </tr>
                  <tr>
                    <th>Sexo</th>
                    <td>
                      @if ($usuario->sexo)
                        {{ "Masculino" }}
                      @else
                        {{ "Femenino" }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Teléfono</th>
                    <td>
                      @if (count($telefonos)>0)
                        @foreach ($telefonos as $telefono)
                          {{ $telefono->telefono.' | ' }}
                        @endforeach
                      @else
                        {{ "Sin teléfono" }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Dirección</th>
                    <td>{{ $usuario->direccion }}</td>
                  </tr>
                  @if ($usuario->tipoUsuario != 'Recepción' && $usuario->tipoUsuario != 'Enfermería' && $usuario->tipoUsuario != 'Farmacia')
                    <tr>
                      <th>Número de Junta de Vigilancia</th>
                      <td>{{$usuario->juntaVigilancia}}</td>
                    </tr>
                    @if(isset($especialidad_principal))
                      <tr>
                        <th>Especialidad principal</th>
                        <td>{{$especialidad_principal->nombreEspecialidad($especialidad_principal->f_especialidad)}}</td>
                      </tr>
                    @endif
                    @if (count($especialidades)>0)
                      <th>Subespecialidades</th>
                      <td>
                        @foreach ($especialidades as $especialidad)
                          {{$especialidad->nombreEspecialidad($especialidad->f_especialidad).' | '}}
                        @endforeach
                      </td>
                    @endif
                  @endif
                  <tr>
                    <th>Estado</th>
                    <td>{{ ($usuario->estado)?"Activo":"En Papelera" }}</td>
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
            {{-- Otra pestaña --}}
            @if (Auth::user()->id == $id)
              <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
                <table class="table">
                  <tr>
                    <th>Nombre de usuario</th>
                    <td>{{$usuario->name}}</td>
                  </tr>
                  <tr>
                    <th>E-mail</th>
                    <td>{{$usuario->email}}</td>
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
