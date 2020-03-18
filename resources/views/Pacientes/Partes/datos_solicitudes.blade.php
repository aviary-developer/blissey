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
				<th>Hora</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th style="width: 25px;">Opción</th>
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
						</td>
						<td>
							{{$solicitud->created_at->formatLocalized('%R')}}
							@if ($solicitud->transaccion != null)
								@if ($solicitud->transaccion->ingreso != null)
									<i class="fas fa-check-circle text-success float-right" title="Servicio médico"></i>
								@endif
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
                <span class="badge border border-primary text-primary col-10">LAB</span>
              @elseif($solicitud->f_ultrasonografia != null)
                <span class="badge border border-success text-success col-10">ULT</span>
              @elseif($solicitud->f_rayox != null)
                <span class="badge border border-danger text-danger col-10">RYX</span>
              @elseif($solicitud->f_tac != null)
                <span class="badge border border-warning  text-warning col-10">TAC</span>
              @endif
            </td>
            <td>
              @if ($solicitud->f_examen != null)
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_examen_pac" title="Ver" data-value={{'{"solicitud_id":"'.$solicitud->id.'","examen_id":"'.$solicitud->f_examen.'","estado":"'.$solicitud->estado.'"}'}} id="ver_examen_f">
                  <i class="fas fa-info-circle"></i>
                </button>
              @elseif($solicitud->f_rayox != null)
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={{'{"solicitud_id":"'.$solicitud->id.'","tipo":"0","estado":"'.$solicitud->estado.'"}'}} id="ver_evaluacion_f">
                  <i class="fas fa-info-circle"></i>
                </button>
              @elseif($solicitud->f_ultrasonografia != null)
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={{'{"solicitud_id":"'.$solicitud->id.'","tipo":"1","estado":"'.$solicitud->estado.'"}'}} id="ver_evaluacion_f">
                  <i class="fas fa-info-circle"></i>
                </button>
              @elseif($solicitud->f_tac != null)
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ver_ev_pac" title="Ver" data-value={{'{"solicitud_id":"'.$solicitud->id.'","tipo":"2","estado":"'.$solicitud->estado.'"}'}} id="ver_evaluacion_f">
                  <i class="fas fa-info-circle"></i>
                </button>
              @endif
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
@include('Pacientes.Partes.modal_examenes')
@include('Pacientes.Partes.modal_evaluacion')