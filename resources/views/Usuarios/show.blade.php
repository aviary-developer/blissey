@extends('principal')
@section('layout')
  @php
  $index = false;
  setlocale(LC_ALL,'es');
  @endphp
  @include('Usuarios.Barra.show')
  @if (Auth::user()->id == $id)
    <div class="col-sm-8">
      <div class="x_panel">
        <div class="flex-row">
          <center>
            <h5 class="mb-1">Historial</h5>
          </center>
        </div>
        @include('Bitacoras.form.tabla_sin_usuario');
      </div>
    </div>
  @endif
  <div class="col-sm-4">
    <div id="accordion">
      <div class="card">
        <div class="card-header p-0" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Datos Personales
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body p-2">
            @include('Usuarios.Partes.datos_usuario')
          </div>
        </div>
      </div>
      @if ($usuario->tipoUsuario != 'Recepción' && $usuario->tipoUsuario != 'Enfermería' && $usuario->tipoUsuario != 'Farmacia')          
        <div class="card">
          <div class="card-header p-0" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Datos de Profesionales
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body p-2">
              @include('Usuarios.Partes.datos_profesionales')
            </div>
          </div>
        </div>
      @endif
      <div class="card">
        <div class="card-header p-0" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Datos de Usuario
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body p-2">
              @include('Usuarios.Partes.datos_sistema')
            </div>
        </div>
      </div>
    </div>
  </div>
  @include('Usuarios.Partes.modal_contra')
  {!!Html::script('js/scripts/Usuarios.js')!!}
  @if($usuario->cambio==1)
  <script type="text/javascript">
    $('#modal-c').modal('show');
  </script>
  @endif
@endsection
