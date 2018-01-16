<div>
  <h4>
    <a href="{{asset('/ingresos')}}">
      Hospitalizados
    </a>
  </h4>
</div>
<div class="clearfix"></div>
<table class="table">
  <tbody>
    @if (count($primero)>0)
      @foreach ($primero as $ingreso)
        <tr>
          <td>{{$ingreso->nombrePaciente($ingreso->f_paciente)}}</td>
          @php
            $hoy = Carbon\Carbon::now();
          @endphp
          <td>
            <span class="label label-primary">
              {{$ingreso->fecha_ingreso->diffInDays($hoy).' días'}}
            </span>
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>