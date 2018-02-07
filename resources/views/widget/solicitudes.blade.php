<div>
  <h4>
    <a href="{{asset('/solicitudex')}}">
      Examenes
    </a>
  </h4>
</div>
<div class="clearfix"></div>
<table class="table">
  <tbody>
    @if (count($segundo)>0)
      @foreach ($segundo as $solicitud)
        <tr>
          <td>{{$solicitud->nombrePaciente($solicitud->f_paciente)}}</td>
          <td>
            @if ($solicitud->examenesPaciente($solicitud->f_paciente)==0)
              <span class="label label-default col-xs-10 label-lg">
                Pendiente
              </span>
            @elseif($solicitud->examenesPaciente($solicitud->f_paciente)==1)
              <span class="label label-warning col-xs-10 label-lg">
                Evaluando
              </span>
            @else
              <span class="label label-success col-xs-10 label-lg">
                Listo
              </span>
            @endif
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
