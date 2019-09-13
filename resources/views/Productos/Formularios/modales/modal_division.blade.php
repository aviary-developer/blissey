  <div class="modal fade" tabindex="-1" role="dialog" id="modal_agregar" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-plus"></i>
                División
              </h4>
            </center>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel">
            <div class="ln_solid mb-1 mt-1"></div>
            <div class="row">

              <div class="form-group col-sm-11">
                <label class="" for="codigo">Código *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control form-control-sm','placeholder'=>'Código del nuevo producto']) !!}
                  <div class="input-group-append">
                      <div class="input-group-btn">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-sm" title="Generar código" onclick="generarCodigo()">
                            <i class="fas fa-random"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="form-group col-sm-12">
                <label class="" for="div">División *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <select class="form-control form-control-sm" name="divisionSelect" id = "division">
                    @foreach ($divisiones as $division)
                      <option value={{ $division->id }}>{{ $division->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group col-sm-12">
                <div class="input-group mb-2 mr-sm-2">
                  <div class="btn-group col-sm-12">
                    <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="1" id="cant">Cantidad</a>
                    <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="0" id="cont">Contenido</a>
                  </div>
                  <input type="hidden" id="hchange" value="a">
                </div>
              </div>

              <div class="form-group col-sm-6">
                <label id="lchange">Cantidad *</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                  </div>
                  {!! Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control form-control-sm','placeholder'=>'Cantidad de unidades minimas','min'=>'1']) !!}
                </div>
              </div>

              <div class="form-group col-sm-6" id="opc1">
                <label>Presentación</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-cubes"></i></div>
									</div>
									@if ($presentaciones != null)	
                  	{!! Form::text('valor',array_values($presentaciones)[0],['id'=>'valor','class'=>'form-control form-control-sm','readonly'=>'readonly']) !!}
									@endif
                </div>
              </div>

              <div class="form-group col-sm-6" id="opc2" style="display:none;">
                <label>Unidad</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                  </div>
                  {!!Form::select('v_valor',
                    App\Producto::arrayUnidades()
                    ,null, ['class'=>'form-control form-control-sm','id'=>'v_valor'])!!}
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label>Precio de venta ($) *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                    </div>
                    {!! Form::number('precio','0.00',['id'=>'precio','class'=>'form-control form-control-sm','min'=>'1.00','step'=>'0.05']) !!}
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label>Stock mínimo *</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                    </div>
                    {!! Form::number('minimo','40',['id'=>'minimo','class'=>'form-control form-control-sm','placeholder'=>'Stock mínimo','min'=>'1.00','step'=>'0']) !!}
                  </div>
                </div>

                <div class="form-group col-sm-8">
                  <label>Notificar</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-cubes"></i></div>
                    </div>
                    {!!Form::select('n_meses',
                      [1=>'1 mes',2=>'2 meses',3=>'3 meses',4=>'4 meses',5=>'5 meses']
                      ,3, ['class'=>'form-control form-control-sm','id'=>'n_meses'])!!}
                    </div>
                </div>
                <div class="form-group col-sm-4">
                  <label class="control-label">antes de vencer *</label>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="m_panel x_panel bg-transparent" style="border:0px !important">
              <center>
                <button type="button" class="btn btn-sm  col-2 btn-primary" id="agregar_division">Agregar</button>
                <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" id="tokenCod" name="tokenUnidadModal" value="<?php echo csrf_token(); ?>">

    <script type="text/javascript">
    $(document).on('ready',function(){
      $("#cant").on("click",function(){
        $("#cont").removeClass('active');
        $("#cont").addClass('notActive');
        $("#cant").addClass('active');

        $('#opc1').css("display","block");
        $('#opc2').css("display","none");
        $('#lchange').text("Cantidad *");
        $('#hchange').val("a");
      });

      $("#cont").on("click",function(){
        $("#cant").removeClass('active');
        $("#cant").addClass('notActive');
        $("#cont").addClass('active');

        $('#opc1').css("display","none");
        $('#opc2').css("display","block");
        $('#lchange').text("Contenido *");
        $('#hchange').val("o");
      });
    });

     function generarCodigo(){
      var codigos = [];
       $("input[name='codigos[]']").each(function(indice, elemento) {
        codigos.push($(elemento).val());
      });
      var token = $("#tokenCod").val();
      $.ajax({
        type: 'get',
        headers: { 'X-CSRF-TOKEN': token},
        url: $('#guardarruta').val() + '/generarCodigo',
        data: {'codigos': JSON.stringify(codigos),
      },
        success: function (r) {
          $('#codigo').val(r);
        }
      });
    }
    </script>
