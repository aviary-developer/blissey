<div class="modal fade" tabindex="-1" role="dialog" id="modal2" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1" id="myModalLabel">
              <i class="fas fa-edit"></i>
              Editar División
              <label id='cod' value=""></label>
            </h4>
          </center>
        </div>
      </div>
    </div>
    {!!Form::open(['url'=>'editarDivisionProducto','method'=>'POST','autocomplete'=>'off'])!!}
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="ln_solid mb-1 mt-1"></div>
          <div class="row">

            <input type="hidden" name='idDiv' value="" id='idDiv'>

            <div class="form-group col-sm-12">
              <label class="" for="nombre">Código</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                {!! Form::text('codigo',null,['class'=>'form-control form-control-sm','placeholder'=>'Código','id'=>'codi']) !!}
              </div>
            </div>

            <div class="form-group col-sm-12">
                <label class="" for="div">División</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <select class="form-control form-control-sm" name="div" id = "div">
                    @foreach ($divisiones as $division)
                      <option value={{ $division->id }}>{{ $division->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group col-sm-12">
                <label class="" for="div" id="auxC"></label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                {!! Form::number('cante',null,['class'=>'form-control form-control-sm','placeholder'=>'Cantidad','id'=>'cante','min'=>'1.00','step'=>'0']) !!}
                {!! Form::text('auxN',null,['class'=>'form-control form-control-sm','id'=>'auxN','readonly'=>'readonly']) !!}
                </div> 
              </div>

            <div class="form-group col-sm-12">
              <label class="" for="nombre">Precio de venta</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                </div>
                {!! Form::number('pre',null,['class'=>'form-control form-control-sm','placeholder'=>'Precio','id'=>'pre','min'=>'0.01','step'=>'0.01']) !!}
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="" for="nombre">Stock mínimo</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                </div>
                {!! Form::number('stock',null,['class'=>'form-control form-control-sm','placeholder'=>'Stock','id'=>'stock','min'=>'1.00','step'=>'0']) !!}
              </div>
            </div>

            <div class="form-group col-sm-8">
              <label class="" for="nombre">Notificar</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
                {!!Form::select('mes',
                  [1=>'1 mes',2=>'2 meses',3=>'3 meses',4=>'4 meses',5=>'5 meses']
                  ,3, ['class'=>'form-control form-control-sm','id'=>'mes'])!!}
              </div>
            </div>
            <div class="form-group col-sm-4">
              <label class="control-label">antes de vencer</label>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            {!! Form::submit('Guardar',['class'=>'btn btn-sm  col-2 btn-primary']) !!}
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
  </div>
</div>
