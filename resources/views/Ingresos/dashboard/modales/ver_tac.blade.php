<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="ver_tac" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="x_panel m_panel text-danger">
				<div class="row">
					<div class="col-3"></div>
					<div class="col-6">
						<center>
							<h4 class="mb-1">
								<i class="fas fa-desktop"></i>
								TAC
							</h4>
						</center>
					</div>
					<div class="col-3">
						<center>
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-light float-right" id="s-earch-tac" title="Búsqueda">
									<i class="fas fa-search"></i>
								</button>
								@if (Auth::user()->tipoUsuario == "Médico")
									<button type="button" class="btn btn-sm btn-light float-right" id="view-tac" title="Ver todo" onclick="$('#busqueda_ver_tac').toggle();$('#todo_ver_tac').toggle()">
										<i class="fas fa-bars"></i>
									</button>
								@endif
							</div>
						</center>
					</div>
				</div>
      </div>
    </div>

    <div class="row" id="busqueda_ver_tac">
      <div class="x_panel m_panel" id="div-h-tac" style="display:none;">
        <div class="flex-row">
          <center>
            <h5>Búsqueda</h5>
          </center>
        </div>
        <div class="form-group col-sm-12">
          <label class="" for="fecha">Fecha</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-calendar"></i></div>
            </div>
            @php
              if($ingreso->estado != 2){
                $fecha = $hoy;
              }else{
                $fecha = $dias_a;
              }
            @endphp
            {!! Form::date(
              'fecha',
              $fecha->format('Y-m-d'),['id'=>'fecha_tac',
              'max'=>$dias_x->format('Y-m-d'),
              'min'=>$dias_i->format('Y-m-d'),
              'class'=>'form-control form-control-sm']) !!}
          </div>
        </div>
      </div>

      <div class="x_panel m_panel" style="height: 400px">
        <div class="flex-row">
          <center>
            <h5 class="text-primary">
              <i class="far fa-calendar"></i>
              <span id="date_t"></span>
            </h5>
          </center>
        </div>
        <div class="row " >
          <div style="overflow-x: hidden; overflow-y: scroll; height: 279px; width:100%">
            <div id="mensaje_v_t"></div>
          </div>
        </div>
      </div>
		</div>
		
		<div class="row" id="todo_ver_tac" style="display: none;">
				<div class="m_panel x_panel">
					<div class="flex-row">
						<center>
							<h5>Listado de TAC del paciente</h5>
						</center>
					</div>
					<div class="flex-row">
						<table class="table table-sm index-table table-hover">
							<thead>
								<th>#</th>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Evaluación</th>
								<th>Acción</th>
							</thead>
							<tbody>
								@php
										$i = 1;
								@endphp
								@foreach ($detalle_tac as $detalle)
									<tr>
										<td>{{$i}}</td>
										<td>{{$detalle->created_at->format('d/m/Y')}}</td>
										<td>{{$detalle->created_at->format('h:i a')}}</td>
										<td>
											{{$detalle->tac->nombre}}
											@if($detalle->transaccion != null)
												@if($detalle->transaccion->ingreso != null)
													@if ($detalle->transaccion->ingreso->id == $ingreso->id)	
														<span class="badge badge-warning float-right">A</span>
													@endif
												@endif
											@endif
										</td>
										<td>
											@if ($detalle->estado == 2)
												<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ver_ev_pac" onclick="{{'ver_evaluacion_completa('.$detalle->id.',2,'.$detalle->estado.',2)'}}">
													<i class="fas fa-eye"></i>
												</button>
											@else
												<button type="button" class="btn btn-sm" disabled>
													<i class="fas fa-spinner"></i>
												</button>
											@endif
										</td>
									</tr>
									@php
										$i++;
									@endphp
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
		</div>
    
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-light col-4 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>

<script>
  $("#s-earch-tac").click(function(e){
    e.preventDefault();
    $("#div-h-tac").slideToggle();
  });
</script>