      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <br />
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre del nuevo reactivo']) !!}
                  </div>
                </div>
                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  {!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Describa el uso del reactivo']) !!}
                </div>
              </div>
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad por envase</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                {!! Form::text('contenidoPorEnvase',null,['class'=>'form-control','placeholder'=>'Cantidad en ml']) !!}
              </div>
            </div>
            </div>
          </div>


        </div>
      </div>
