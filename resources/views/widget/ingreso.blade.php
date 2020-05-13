<div class="flex-row">
  <center>
    <h5>
      <a href="{{asset('/ingresos')}}" class="text-purple">
        Hospitalizados
      </a>
    </h5>
  </center>
</div>

<div class="flex-row border border-purple"></div>

<div class="flex-row">
  <table class="table table-striped table-sm">
    <tbody>
      @if ($primero!=null)
        @foreach ($primero as $ingreso)
          <tr>
            <td class="w-50">{{
              $ingreso->hospitalizacion->paciente->apellido.', '.$ingreso->hospitalizacion->paciente->nombre
            }}</td>
            @php
              $hoy = Carbon\Carbon::now();
            @endphp
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
              <span class="badge border border-primary text-primary col-6 float-right">
                {{($dias).(($dias > 1)?' días':' día')}}
              </span>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
