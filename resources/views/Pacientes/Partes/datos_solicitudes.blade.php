<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Evaluaciones</h5>
    </center>
  </div>
  <div class="col">
    <select name="filtro_e" id="filtro_e" class="form-control form-control-sm">
      <option value="-1">Todos</option>
      <option value="0">Laboratorio clínico</option>
      <option value="1">Rayos X</option>
      <option value="2">Ultrasonografía</option>
      <option value="3">TAC</option>
    </select>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-sm table-hover table-striped" id="solicitud-table">
      <thead>
        <th>#</th>
        <th>Fecha</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th style="width: 80px;">Opción</th>
      </thead>
      <tbody id="sol-body-table">
        @php
          $correlativo = 1;
        @endphp
        @foreach ($solicitudes as $solicitud)
          <tr>
            <td>{{$correlativo}}</td>
            <td>
              {{$solicitud->created_at->formatLocalized('%d %b %y')}}
              @if ($solicitud->transaccion->ingreso != null)
                <i class="fas fa-check-circle text-success float-right" title="Servicio médico"></i>
              @endif
            </td>
            <td>
              @if ($solicitud->f_examen != null)
                {{$solicitud->examen->nombreExamen}}
              @elseif($solicitud->f_ultrasonografia != null)
                {{$solicitud->ultrasonografia->nombre}}
              @elseif($solicitud->f_rayox != null)
                {{$solicitud->rayox->nombre}}
              @elseif($solicitud->f_tac != null)
                {{$solicitud->tac->nombre}}
              @endif
            </td>
            <td>
              @if ($solicitud->f_examen != null)
                <span class="badge border border-primary text-primary col-10">Laboratorio</span>
              @elseif($solicitud->f_ultrasonografia != null)
                <span class="badge border border-success text-success col-10">Ultrasonografía</span>
              @elseif($solicitud->f_rayox != null)
                <span class="badge border border-danger text-danger col-10">Rayos X</span>
              @elseif($solicitud->f_tac != null)
                <span class="badge border border-warning col-10">TAC</span>
              @endif
            </td>
            <td>
              boton
            </td>
          </tr>
          @php
            $correlativo++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
</div>