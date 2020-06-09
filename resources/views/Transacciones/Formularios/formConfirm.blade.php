<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="col-sm-4">
	<div class="x_panel">
		{{-- Inputs hidden --}}
		<input type="hidden" value="" id="idoculto">
		<input type="hidden" value="" id="divoculto">
		<input type="hidden" value="" id="nomoculto">
		<input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
		@php
		if(App\DetalleCaja::cajaApertura()){
			$aq=App\DetalleCaja::arqueo(Carbon\Carbon::now()->format('Y-m-d'),App\DetalleCaja::caja_en_uso());
		}else{
			$aq=0;
		}
		@endphp
	<input type="hidden" id="arqueo" value="{{$aq}}">
		{{-- Llenar el select de estantes --}}
		@php
			$estantes=App\Estante::arrayEstante();
			$cadena="<option value=''>Seleccione un estante</option>";
			foreach ($estantes as $key => $e) {
				$cadena=$cadena."<option value='".$key."'>".$e."</option>";
			}
		@endphp
		<input type="hidden" id="opciones" value="{{$cadena}}">
		<input type="hidden" id="confirmar" name="confirmar" value="{{true}}">
		
		<div class="form-group">
			<label class="" for="cantidad_resultado">Fecha de entrega *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-calendar"></i></div>
				</div>
				{!! Form::date('fecha',date('Y').'-'.date('m').'-'.date('d'),['class'=>'form-control form-control-sm']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">Proveedor *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-users"></i></div>
				</div>
				{!!Form::select('f_proveedor',
          App\Transacion::arrayProveedores()
          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control form-control-sm','id'=>'f_proveedor'])!!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">Número de factura *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-barcode"></i></div>
				</div>
				{!! Form::text('factura',null,['class'=>'form-control form-control-sm','id'=>'fac']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">Descuento del pedido</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-percent"></i></div>
				</div>
				{!! Form::number('descuentog',0,['class'=>'form-control form-control-sm','id'=>'descuentog','onKeyUp' => 'recalcular();']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">IVA incluido</label>
			<div class="input-group mb-2 mr-sm-2">
				<span class="button-checkbox col-sm-12">
					<center>
						<button type = "button" class="btn btn-sm col-4" data-color="info" onclick="cambio();recalcular();">
							<span id="iva">Si</span>
						</button>
					</center>
          <input type="checkbox" hidden name="desactivate" value="1">
          <input hidden name="ivaincluido" value="1" id="ivaincluido">
        </span>
			</div>
		</div>
	</div>

	<div class="x_panel">
		<center>
			<button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-success btn-sm" id="agregar_paciente">
        <i class="fas fa-search"></i>
			</button>
			<a href={{asset("/transacciones?tipo=0")}} class="btn btn-light btn-sm">Cancelar</a>
			<input type="hidden" id="fechaM" value="{{\Carbon\Carbon::now()->addMonths(4)->toDateString()}}">
			{!!Form::button('Confirmar',['class'=>'btn btn-primary btn-sm','id'=>'confirmarPedido'])!!}
		</center>
	</div>
</div>

<div class="col-sm-8">
	<div class="x_panel">
		<div class="flex-row">
			<center>
				<h5>Detalle</h5>
			</center>
		</div>

		<table class="table table-sm" id="tablaDetalle">
			<thead>
				<th style="width: 80px;">Cantidad</th>
				<th>Detalle</th>
				<th>Opciones</th>
			</thead>
			@php
				$detalles=$transaccion->detalleTransaccion;
			@endphp
			@foreach ($detalles as $key => $detalle)
				<tr>
					<td>
						{!! Form::number('cantidad[]',$detalle->cantidad,['class'=>'form-control form-control-sm','placeholder'=>'Cantidad','min'=>'1','onKeyUp' => 'recalcular();','onKeyPress' => 'return entero( this, event,this.value);']) !!}

						<input type="hidden" name="descuento[]" id="descuento_h">
						<input type="hidden" name="fecha_vencimiento[]" id="fecha_vencimiento_h">
						<input type="hidden" name="precio[]" id="precio_h">
						<input type="hidden" name="lote[]" id="lote_h">
						<input type="hidden" name="f_estante[]" id="estante_h">
						<input type="hidden" name="nivel[]" id="nivel_h">
						<input type="hidden" name="state-of[]" id="state-of" value="false">
					</td>
					<td>
						@if ($detalle->divisionProducto->unidad==null)
							{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
						@else
							{{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
						@endif
						&nbsp;
						<b>
							{{$detalle->divisionProducto->producto->nombre}}
						</b>
					</td>
					<td>
						<input type="hidden" id='{{"f_prod".$key}}' value='{{$detalle->f_producto}}'>
						<input type='hidden' name='estado[]' value ='{{$detalle->id}}'>
						<input type='hidden' name='f_producto[]' value ='{{$detalle->f_producto}}'>
						<center>
							<button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#almacenar" id="almacen">
								<i class="fas fa-check"></i>
							</button>
	
							<button type='button' class='btn btn-sm btn-danger' id='eliminar_fila_pedido'>
								<i class='fa fa-times'></i>
							</button>
						</center>
					</td>
				</tr>
				@php
					$auxiliar_contador = $key;
				@endphp
			@endforeach
			<input type="hidden" id="contador" value={{$auxiliar_contador}}>
      <div id="eliminados"></div>
		</table>
		<h5 class="mb-1">
			Total: $ <label id="total_venta">0.00</label>
			<input type="hidden" id="total_venta_aux" value='0'>
		</h5>
	</div>

</div>

@include('Transacciones.Formularios.modalBuscarProducto')
@include('Transacciones.Formularios.modal_almacenar')

<script type="text/javascript">
	function cambioEstante(idp){
		console.log(idp);
		idEstante=$('#f_estante'+idp).find('option:selected').val();
		console.log(idEstante);
		$('#nivel'+idp).empty();
		if(idEstante!=""){
			var ruta = $('#guardarruta').val() + "/niveles/"+idEstante;
			$.get(ruta,function(res){
				cantidad=parseFloat(res);
				for(i=1;i<=cantidad;i++){
					$('#nivel'+idp).append("<option value="+i+">"+i+"</option>");
				}
			});
		}
	}
	function cambio(){
		texto=$('#iva').text();
		if(texto=="No"){
			$('#iva').text("Si");
			$('#ivaincluido').val("1");
		}else{
			$('#iva').text("No");
			$('#ivaincluido').val("0");
		}
	}

	$(document).ready(function(){
		var fila;

		$("#tablaDetalle").on('click','#almacen',async function(e){
			e.preventDefault();
			fila = $(this);
			var estado_de = $(this).parent('center').parent('td').parent('tr').find('#state-of').val();
			if(estado_de == "true"){
				var fecha = $(this).parent('center').parent('td').parent('tr').find('#fecha_vencimiento_h').val();
				var lote = $(this).parent('center').parent('td').parent('tr').find('#lote_h').val();
				var precio = $(this).parent('center').parent('td').parent('tr').find('#precio_h').val();
				var descuento = $(this).parent('center').parent('td').parent('tr').find('#descuento_h').val();
				var estante = $(this).parent('center').parent('td').parent('tr').find('#estante_h').val();
				var nivel = $(this).parent('center').parent('td').parent('tr').find('#nivel_h').val();

				var ruta = $('#guardarruta').val() + "/niveles/"+estante;
				$("select[name='niveles']").empty();
				await $.get(ruta,function(res){
					cantidad=parseFloat(res);
					for(i=1;i<=cantidad;i++){
						$("select[name='niveles']").append("<option value="+i+">"+i+"</option>");
					}
				});

				$("#fecha_vencimiento_i").val(fecha);
				$("#lote_i").val(lote);
				$("#precio_i").val(precio);
				$("#descuento_i").val(descuento);
				$("select[name='f_estantes']").val(estante);
				$("select[name='niveles']").val(nivel);
			}
		});

		$("#guardar_almacen").click(function(e){
			e.preventDefault();
			var fecha = $("#fecha_vencimiento_i").val();
			var lote = $("#lote_i").val();
			var precio = $("#precio_i").val();
			var descuento = $("#descuento_i").val();
			var estante = $("select[name='f_estantes']").val();
			var nivel = $('select[name="niveles"]').val();

			if(fecha != null && lote.length > 0 && precio.length > 0 && descuento.length > 0 && estante != ""){

				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1;
				var yyyy = hoy.getFullYear();

				if(dd<10) {
					dd='0'+dd;
				} 

				if(mm<10) {
					mm='0'+mm;
				} 
				actual=yyyy+"-"+mm+"-"+dd;

				if(fecha>actual){
					fila.parent('center').parent('td').parent('tr').find('#fecha_vencimiento_h').val(fecha);
					fila.parent('center').parent('td').parent('tr').find('#lote_h').val(lote);
					fila.parent('center').parent('td').parent('tr').find('#precio_h').val(precio);
					fila.parent('center').parent('td').parent('tr').find('#descuento_h').val(descuento);
					fila.parent('center').parent('td').parent('tr').find('#estante_h').val(estante);
					fila.parent('center').parent('td').parent('tr').find('#nivel_h').val(nivel);
					fila.parent('center').parent('td').parent('tr').find('#state-of').val("true");
		
					$("#lote_i").val("");
					$("#precio_i").val("");
					$("#descuento_i").val("0");
		
					fila.removeClass('btn-success').addClass("btn-info");
					fila.empty().append('<i class="fa fa-search"></i>');
		
					$("#almacenar").modal('hide');
					recalcular();
				}else{
					swal({
						type: 'error',
						title: '¡Error!',
						text: 'Ingrese una fecha válida',
						toast: true,
						timer: 4000,
						showConfirmButton: false
					});	
				}
			}else{
				swal({
					type: 'error',
					title: '¡Error!',
					text: 'Debe llenar los campos para poder guardar',
					toast: true,
					timer: 4000,
					showConfirmButton: false
				});
			}

		});

		$("#cerrar_m").click(function(e){
			e.preventDefault();
			$("#lote_i").val("");
			$("#precio_i").val("");
			$("#descuento_i").val("0");
		});

	});
			function actualizarTotal(total) {
				descuento = $('#descuentog').val();
				if (descuento == "") {
					descuento = 0;
				} else {
					descuento = parseFloat(descuento);
				}

				if ($('#ivaincluido').val() == '0') {
					total = total + (total * 0.13);
				}
				$('#total_venta').text((total - (total * (descuento / 100))).toFixed(2));
				$('#total_venta_aux').val(parseFloat(total).toFixed(2));
			}
			function recalcular(){
				var cantidades = document.getElementsByName("cantidad[]");
						var descuentos = document.getElementsByName("descuento[]");
						var precios = document.getElementsByName("precio[]");
						acumulado = 0;
						for (i = 0; i < cantidades.length; i++) {
							if(precios[i].value!="" && cantidades[i].value!=""){
							cantidad = parseFloat(cantidades[i].value);
							descuento = parseFloat(descuentos[i].value);
							precio = parseFloat(precios[i].value);
							subtotal = cantidad * precio;
							total = subtotal - (subtotal * (descuento / 100));
							acumulado += total;
							}
						}
						actualizarTotal(acumulado);
			}
</script>
