<div class="modal fade" tabindex="-1" role="dialog" id="almacenar" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-check-circle"></i>
              Aceptar Producto
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="row">

            <div class="form-group col-sm-12">
              <label class="" for="nombre">Fecha de vencimiento</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="far fa-calendar"></i></div>
                </div>
                {!! Form::date('fecha_',$fecha->addMonths(3),['id'=>'fecha_vencimiento_i','class'=>'form-control form-control-sm','placeholder'=>'Fecha']) !!}
              </div>
						</div>
						
						<div class="form-group col-sm-12">
              <label class="" for="nombre">Número de lote</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                </div>
                {!! Form::text('lote_',null,['id'=>'lote_i','class'=>'form-control form-control-sm','placeholder'=>'Número de lote de fabricación']) !!}
              </div>
						</div>
						
						<div class="form-group col-sm-12">
              <label class="" for="nombre">Precio de compra</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-money-bill-alt"></i></div>
                </div>
                {!! Form::number('precio_',null,['id'=>'precio_i','class'=>'form-control form-control-sm','placeholder'=>'Precio de compra','step'=>'0.10','min'=>'0.00']) !!}
              </div>
						</div>
						
						<div class="form-group col-sm-12">
              <label class="" for="nombre">Descuento del producto</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-percent"></i></div>
                </div>
                {!! Form::number('descuento_',0.00,['id'=>'descuento_i','class'=>'form-control form-control-sm','placeholder'=>'Descuento de la compra del producto','step'=>'0.1','min'=>'0.00']) !!}
              </div>
						</div>
						
						<div class="form-group col-sm-12">
              <label class="" for="nombre">Estante / Nivel</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cube"></i></div>
                </div>
                {!!Form::select('f_estantes',
                  App\Estante::arrayEstante()
									,null, ['placeholder' => 'Seleccione un estante','class'=>'form-control form-control-sm','id'=>'f_estante'.$detalle->f_producto,'onChange'=>'cambioEstante('.$detalle->f_producto.')'])!!}
								{!!Form::select('niveles',[]
                ,null, ['placeholder' => 'Nivel','class'=>'form-control form-control-sm','id'=>'nivel'.$detalle->f_producto])!!}
              </div>
						</div>

          </div>
				</div>

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
						<button type="button" class="btn btn-sm btn-primary col-2" id="guardar_almacen">
							Guardar
						</button>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrar_m">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
