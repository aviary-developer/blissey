<div class="modal fade" tabindex="-1" role="dialog" id="modal" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                                <a class="btn btn-primary btn-sm active col-sm-auto" data-toggle="busq" data-title="1" onclick="cambioBusq(1)">Producto</a>
                                @if(Auth::user()->tipoUsuario=="Recepción")
                                    <a class="btn btn-primary btn-sm notActive col-sm-auto" data-toggle="busq" data-title="2" onclick="cambioBusq(2)">Servicios</a>
                                @endif
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
                  {!! Form::text('resultado_promo',null,['id'=>'resultado_promo','class'=>'form-control form-control-sm','placeholder'=>'Buscar']) !!}
                </div>
              </div>

              <div class="form-group col-sm-4">
                <label class="" for="cantidad">Cantidad *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
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
						<table class="table table-striped table-sm" id="tablaBuscarPromo">
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
              <button type="button" class="btn btn-light btn-sm col-2" onclick="$('#resultado_promo').val('');$('#tablaBuscarPromo').empty();" data-dismiss="modal">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  @section('agregarjs')
  {!!Html::script('js/scripts/Promos.js')!!}
  @endsection
