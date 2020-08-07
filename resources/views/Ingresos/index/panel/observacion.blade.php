<div class="flex-row">
  <center>
    <h5 class="text-primary">Observación</h5>
  </center>
</div>
<div class="flex-row border border-primary mb-1"></div>
<div class="flex-row">
  @if ($habitaciones_observacion != null)
    <table class="table table-hover table-sm">
      <thead>
        <th>Paciente</th>
        <th>Tiempo</th>
        <th style="width: 80px">Opción</th>
      </thead>
      <tbody>
        @foreach ($habitaciones_observacion as $habitacion)
          <tr class="table-secondary">
            <td colspan="3" class="text-dark">
              <center>
                <b class="text-monospace font-weight-light">
                  {{'Habitación '.$habitacion->numero}}
                </b>
              </center>
            </td>
          </tr>
          @if ($habitacion->camas->count() > 0)
            @foreach ($habitacion->camas->where('activo',true) as $cama)
              @if ($cama->estado)
                @php
                  $ingreso = $cama->ingreso->where('estado','<',2)->first();
                @endphp
                <tr>
                  <td>
                    <a href={{asset('/pacientes/'.$ingreso->f_paciente)}}>
                        {{$ingreso->hospitalizacion->paciente->apellido.', '.$ingreso->hospitalizacion->paciente->nombre}}
                      </a>
                  </td>
                  <td>
                    @php
                      $ahora = Carbon\Carbon::now();
                      $horas = $ingreso->fecha_ingreso->diffInHours($ahora);
                    @endphp
                    @if ($horas > 2)
                      <span class="badge border border-danger text-danger col-12">
                    @else
                      <span class="badge border border-primary text-primary col-12">
                    @endif
                      {{($horas).(($horas > 1)?' horas':' hora')}}
                    </span>
                  </td>
                  <td>
                    @include('Ingresos.Formularios.desactivate')
                  </td>
                </tr>
              @else
                <tr class="table-success">
                  <td colspan="2">
                    <span class="badge badge-light border border-dark">
                      {{$cama->servicio->nombre}}
                    </span>
                    disponible
                  </td>
                  <td>
                    @if (Auth::user()->tipoUsuario == "Recepción"  || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería")
                      <div class="btn-group alignright">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#n_ingreso" onclick={{'i_activo('.$cama->id.',2)'}} title="Agregar"><i class="fas fa-plus"></i></button>
                      </div>
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          @else
            <tr>
              <td colspan="3" class="gray">
                <b>
                  Sin camas
                </b>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  @else
    <center style="margin-top: 60px">
      <i class="fas fa-info-circle gray" style="font-size: 800%"></i>
    </center>
    <center class="big-text gray">
      <h4>Información</h4>
    </center>
    <center>
      <span>No se ha registrado ninguna habitación</span>
    </center>  
  @endif
</div>