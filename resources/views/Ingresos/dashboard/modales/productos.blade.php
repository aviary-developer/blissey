<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="productos_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-medkit"></i>
              Medicamento
            </h4>
          </center>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-7">
        <div class="x_panel m_panel">
          <div class="flex-row">
            <center>
              <h5>Búsqueda</h5>
            </center>
          </div>
          <div class="form-group" id="radios">
            <label class="" for="nombre">Buscar por</label>
              <div class="input-group mb-2 mr-sm-2">
                <div id="radioBtn" class="btn-group col-sm-12">
                  <a class="btn btn-primary btn-sm active col-sm-6" data-toggle="busq" data-title="1" onclick="cambioRadio(1)">Producto</a>
                  <a class="btn btn-primary btn-sm notActive col-sm-6" data-toggle="busq" data-title="2" onclick="cambioRadio(2)">Componente</a>
                </div>
                <input type="hidden" name="busq" id="busq" value="1">
              </div>
          </div>

          <div class="form-group">
            <label class="" for="cantidad_resultado">Cantidad</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-cubes"></i></div>
              </div>
              {!! Form::number(
                'cantidad_resultado',
                1,
                ['id'=>'cantidad_resultado',
                'class'=>'form-control form-control-sm',
                'onKeyPress' => 'return entero( this, event,this.value);',
                'placeholder'=>'Cantidad',
                'min'=>'1']
              ) !!}
            </div>
          </div>

          <div class="form-group">
            <label class="" for="resultadoVenta_">Buscar</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-search"></i></div>
              </div>
              {!! Form::text(
                'resultadoVenta',
                null,
                ['id'=>'resultadoVenta_',
                'class'=>'form-control form-control-sm',
                'placeholder'=>'Buscar',
                'tabindex'=>'-1']
              ) !!}
            </div>
          </div>

        </div>

        <div class="x_panel m_panel" style="height: 291px">
          <div class="flex-row">
            <center>
              <h5>Resultado de la búsqueda</h5>
            </center>
          </div>
          <div class="row">
            <div style="overflow-x:hidden; overflow-y:scroll; height: 221px; width: 100%">
              <table class="table table-hover table-striped table-sm font-sm w-100" id="tablaBuscar">
                <thead>
                </thead>
              </table>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-sm-5">
        <div class="x_panel m_panel" style="height: 553px">
          <div class="flex-row">
            <center>
              <h5>Medicamento agregado</h5>
            </center>
          </div>
          <div class="row">
            <div style="overflow-x: hidden; overflow-y: scroll; height: 483px; width: 100%">
              <div id="mensaje_provisional"></div>
            </div>
          </div>
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