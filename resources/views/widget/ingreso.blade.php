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
              $ingreso->paciente->apellido.', '.$ingreso->paciente->nombre
            }}</td>
            @php
              $hoy = Carbon\Carbon::now();
            @endphp
            <td>
              <span class="badge border border-primary text-primary col-6 float-right">
                {{($ingreso->fecha_ingreso->diffInDays($hoy)+1).' días'}}
              </span>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
