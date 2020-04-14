<div class="modal fade" tabindex="-1" role="dialog" id="modal" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-search"></i>
              Buscar
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="row">
						<div class="form-group col-sm-12" id="radios">
							<label class="" for="nombre">Buscar por</label>
								<div class="input-group mb-2 mr-sm-2">
									<div id="radioBtn" class="btn-group col-sm-12">
										<a class="btn btn-primary btn-sm active col-sm-auto" data-toggle="busq" data-title="1" onclick="cambioRadio(1)">Producto</a>
										<a class="btn btn-primary btn-sm notActive col-sm-auto" data-toggle="busq" data-title="2" onclick="cambioRadio(2)">Componente</a>
                    <a class="btn btn-primary btn-sm notActive col-sm-auto" data-toggle="busq" data-title="3" onclick="cambioRadio(3)">Servicios</a>                      
									</div>
									<input type="hidden" name="busq" id="busq" value="1">
								</div>
						</div>

            <div class="form-group col-sm-8">
              <label class="" for="nombre">Buscar</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                {!! Form::text('resultadoVenta',null,['id'=>'resultadoVenta','class'=>'form-control form-control-sm','placeholder'=>'Buscar']) !!}
              </div>
            </div>

            <div class="form-group col-sm-4">
              <label class="" for="cantidad">Cantidad *</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                </div>
                {!! Form::number('cantidad_resultado',1,['id'=>'cantidad_resultado','class'=>'form-control form-control-sm','onKeyPress' => 'return entero( this, event,this.value);','placeholder'=>'Cantidad','min'=>'1']) !!}
              </div>
            </div>

						
					</div>
					
				</div>
				
				<div class="x_panel m_panel">
					<div class="flex-row">
						<center>
							<h5>Resultado de búsqueda</h5s>
						</center>
          </div>
          <div class="flex-row" style="height:300px; overflow-x:hidden; overflow-y:scroll;">
					<table class="table table-sm" id="tablaBuscar">
						<thead>
						</thead>
          </table>
          </div>
				</div>

      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" onclick="limpiarTablaVenta()">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
