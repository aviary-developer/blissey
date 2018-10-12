<div class="flex-row">
  <center>
    <h5>Ingresos</h5>
  </center>
</div>
<div class="flex-row">
  @if ($habitaciones_ingreso != null)
    <table class="table table-hover table-sm">
      <thead>
        <th style="width: 125px">Expediente</th>
        <th>Paciente</th>
        <th>Tiempo</th>
        <th style="width: 100px">Opciones</th>
      </thead>
      <tbody>
        @foreach ($habitaciones_ingreso as $habitacion)
          <tr>
            <td colspan="4" class="bg-gray text-dark">
              <center>
                <b>
                  {{'Habitación '.$habitacion->numero}}
                </b>
              </center>
            </td>
          </tr>
          @if ($habitacion->camas->count() > 0)
            @foreach ($habitacion->camas as $cama)
              @if ($cama->estado)
              @php
                $ingreso = $cama->ingreso->where('estado','<',2)->first();
              @endphp
                <tr>
                  <td>
                    <small>
                      {{$ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}
                    </small>
                  </td>
                  <td>
                    <a href={{asset('/pacientes/'.$ingreso->f_paciente)}}>
                        {{$ingreso->paciente->apellido.', '.$ingreso->paciente->nombre}}
                      </a>
                  </td>
                  <td>
                    @php
                      $hoy = Carbon\Carbon::today()->hour(7);
                      $ahora = Carbon\Carbon::now();
                      if($ahora->lt($hoy)){
                        $hoy = $hoy->subDays(1);
                      }
                      $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
                      if($ingreso->fecha_ingreso->lt($dia_ingreso)){
                        $dia_ingreso->subDay();
                      }
                      $dias = $dia_ingreso->diffInDays($hoy);
                      $dias++;
                    @endphp
                    <span class="badge border border-primary text-primary col-12">
                      {{($dias).(($dias > 1)?' días':' día')}}
                    </span>
                  </td>
                  <td>
                    @include('Ingresos.Formularios.desactivate')
                  </td>
                </tr>
              @else
                <tr>
                  <td colspan="3" class="green">
                    <b>
                      Cama disponible
                    </b>
                  </td>
                  <td>
                    <div class="btn-group alignright">
                      <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#n_ingreso" onclick={{'i_activo('.$cama->id.',0)'}} title="Agregar"><i class="fas fa-plus"></i></button>
                    </div>
                  </td>
                </tr>
              @endif
            @endforeach
          @else
            <tr>
              <td colspan="4" class="gray">
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
@include('Ingresos.index.modal.ingreso')