<div class="row mt-2">
  <div class="col">
    <center>
      <h5 class="mt-1">Servicios Médicos</h5>
    </center>
  </div>
  <div class="col">
    <select name="filtro_h" id="filtro_h" class="form-control form-control-sm">
      <option value="-1">Todos</option>
      <option value="0">Ingresos</option>
      <option value="1">Medio ingresos</option>
      <option value="2">Observaciones</option>
      <option value="3">Consultas médicas</option>
      <option value="4">Curaciones</option>
    </select>
  </div>
</div>
<div class="ln_solid mt-3"></div>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-sm table-hover table-striped" id="ingreso-table">
      <thead>
        <th>#</th>
        <th>Fecha</th>
        <th>Tipo</th>
        <th style="width: 80px;">Opción</th>
      </thead>
      <tbody id="body-table">
        @php
          $correlativo = 1;
        @endphp
				@foreach ($hospitalizaciones as $hospitalizacion)
					@foreach ($hospitalizacion->ingreso as $ingreso)
							<tr>
							<td>{{$correlativo}}</td>
							<td>{{$ingreso->fecha_ingreso->formatLocalized('%d de %B del %Y')}}</td>
							<td>
								@if ($ingreso->tipo == 0)
									<span class="badge border border-success text-success col-8">Ingreso</span>
								@elseif($ingreso->tipo == 1)
									<span class="badge border border-purple text-purple col-8">Medio ingreso</span>
								@elseif($ingreso->tipo == 2)
									<span class="badge border border-primary text-primary col-8">Observación</span>
								@elseif($ingreso->tipo == 3)
									<span class="badge border border-pink text-pink col-8">Consulta</span>
								@else
									<span class="badge border border-info text-info col-8">Curación</span>
								@endif
							</td>
							<td>
								<center>
									<button type="button" class="btn btn-info btn-sm datos_ingreso" title="Ver" data-toggle="modal" data-target="#ver_ingreso_pac" data-value={{$ingreso->id}}><i class="fas fa-info-circle"></i></button>
								</center>
							</td>
						</tr>
						@php
							$correlativo++;
						@endphp
					@endforeach
        @endforeach
      </tbody>
    </table>
  </div>
</div>