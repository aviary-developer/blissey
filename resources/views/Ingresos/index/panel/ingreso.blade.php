<div class="flex-row">
  <center>
    <h5 class="text-success">Ingresos</h5>
  </center>
</div>
<div class="flex-row border border-success mb-1"></div>
<div class="flex-row">
  @if ($habitaciones_ingreso != null)
    <table class="table table-hover table-sm" id="tabla-ingreso-index">
      <thead>
        <th style="width: 87px">Exp.</th>
        <th>Paciente</th>
        <th>Tiempo</th>
        <th style="width: 80px">Opciones</th>
      </thead>
      <tbody>
        @foreach ($habitaciones_ingreso as $habitacion)
          <tr class="table-secondary">
            <td colspan="4" class="text-dark">
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
                    <center>
                      <span class="badge border border-dark text-dark col-12">
                        {{$ingreso->hospitalizacion->expediente.'-'.$ingreso->fecha_ingreso->format('Y')}}
                      </span>
                    </center>
                  </td>
                  <td>
                    <a href={{asset('/pacientes/'.$ingreso->hospitalizacion->f_paciente)}}>
                        {{$ingreso->hospitalizacion->paciente->apellido.', '.$ingreso->hospitalizacion->paciente->nombre}}
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
                    @endphp
                    <span class="badge border border-primary text-primary col-7">
                      {{($dias).(($dias > 1)?' días':' día')}}
										</span>
										@if ($ingreso->tipo == 0)
											<span class="badge badge-success col-4" title="Ingreso">
												IN
											</span>
										@else
											<span class="badge badge-purple col-4" title="Medio ingreso">
												MI
											</span>
										@endif
                  </td>
                  <td>
                    @include('Ingresos.Formularios.desactivate')
                  </td>
                </tr>
              @else
                <tr class="table-success">
                  <td colspan="3">
                    <span class="badge badge-light border border-dark">
                      {{$cama->servicio->nombre}}
                    </span>
                    disponible
                  </td>
                  <td>
                    @if (Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería")
                      <div class="btn-group alignright">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#n_ingreso" onclick={{'i_activo('.$cama->id.',0)'}} title="Agregar"><i class="fas fa-plus"></i></button>
                      </div>
                    @endif
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
@include('Ingresos.index.modal.acta_modal')