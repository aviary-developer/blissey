<div class="flex-row">
  <center>
    <h5>
      @if (Auth::user()->tipoUsuario == "Recepción")  
        <a href="{{asset('/solicitudex?tipo=examenes')}}" class="text-success">
      @else
        <a href="{{asset('/solicitudex')}}" class="text-success">
      @endif
        Solicitud de Laboratorio clínico
      </a>
    </h5>
  </center>
</div>

<div class="flex-row border border-success"></div>

<div class="flex-row">
  <table class="table table-striped table-sm">
    <tbody>
      @if ($segundo!=null)
        @foreach ($segundo as $solicitud)
          <tr>
            <td class="w-50">{{$solicitud->nombrePaciente($solicitud->f_paciente)}}</td>
            <td>
              @if ($solicitud->examenesPaciente($solicitud->f_paciente)==0)
                <span class="badge border border-dark col-6 float-right">
                  Pendiente
                </span>
              @elseif($solicitud->examenesPaciente($solicitud->f_paciente)==1)
                <span class="badge border border-warning text-warning col-6 float-right">
                  Evaluando
                </span>
              @else
                <span class="badge border border-success text-success col-6 float-right">
                  Listo
                </span>
              @endif
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
