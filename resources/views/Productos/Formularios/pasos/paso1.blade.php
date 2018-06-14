<div class="col-md-6 col-sm-6 col-xs-12">
  <h4 class="StepTitle">Datos del producto</h4>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cube form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo producto','id'=>'nombre']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Presentación *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cog form-control-feedback left" aria-hidden="true"></span>
      {!!Form::select('f_presentacion',
        App\Producto::arrayPresentaciones()
        ,null, ['class'=>'form-control has-feedback-left','id'=>'f_presentacion','placeholder'=>'Seleccione una presentación'])!!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cog form-control-feedback left" aria-hidden="true"></span>
      {!!Form::select('f_categoria',
        App\CategoriaProducto::arrayCategorias()
        ,null, ['class'=>'form-control has-feedback-left','id'=>'f_categoria','placeholder'=>'Seleccione una categoría'])!!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Droguería *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!!Form::select('f_proveedor',
        App\Proveedor::arrayProveedores()
        ,null, ['class'=>'form-control has-feedback-left','id'=>'f_proveedor','placeholder'=>'Seleccione un proveedor'])!!}
    </div>
  </div>
  <h4 class="StepTitle">División del producto</h4>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Código *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control has-feedback-left','placeholder'=>'Código del nuevo producto']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">División *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="divisionSelect" id = "division">
        @foreach ($divisiones as $division)
          <option value={{ $division->id }}>{{ $division->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
    <label>
        Cantidad<input type="checkbox" name="contenido" class="js-switch" id="contenido"/> Contenido
    </label>
  </div>
  <div class="form-group" >
    <input type="hidden" id="hchange" value="a">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lchange">Cantidad *</label>
    <div class="col-md-4 col-sm-9 col-xs-12">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('cantidad',1,['id'=>'cantidad','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de unidades minimas','min'=>'1']) !!}
    </div>
    <div class="col-md-5 col-sm-9 col-xs-12" id="opc1">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('valor',null,['id'=>'valor','class'=>'form-control has-feedback-left','readonly'=>'readonly']) !!}
    </div>
    <div class="col-md-5 col-sm-9 col-xs-12" id="opc2" style="display:none;">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      {!!Form::select('v_valor',
        App\Producto::arrayUnidades()
        ,null, ['class'=>'form-control has-feedback-left','id'=>'v_valor'])!!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio ($) *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('precio','0.00',['id'=>'precio','class'=>'form-control has-feedback-left','placeholder'=>'Precio por división','min'=>'1.00','step'=>'0.05']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Stock mínimo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('minimo','40',['id'=>'minimo','class'=>'form-control has-feedback-left','placeholder'=>'Stock mínimo','min'=>'1.00','step'=>'0']) !!}
    </div>
  </div>
  <center>
    <button type="button" class="btn btn-primary" id="agregar_division">
      <i class="fa fa-plus"></i>
      Agregar división
    </button>
  </center>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
  <h4 class="StepTitle">Divisiones</h4>
  <table class="table" id="tablaDivision">
    <thead>
      <th>Código</th>
      <th>División</th>
      <th>Cantidad/Contenido</th>
      <th>Precio</th>
      <th>Stock</th>
      <th style="width : 80px">Acción</th>
    </thead>
    <tbody>
      @if (!$create)
        @php
          $auxiliar_division = 0;
        @endphp
        <input type="hidden" name="divisiones_eliminadas[]" value="ninguno" id="division_eliminada">
        @foreach ($divisiones_productos  as $key => $division)
          <tr class="divis">
            <td>{{$division->codigo}}</td>
            <td>{{$division->nombreDivision($division->f_division)}}</td>
            <td>@if ($division->contenido!=null)
              {{$division->cantidad.' '.$division->unidad->nombre}}
            @else
            {{$division->cantidad.' '.$productos->nombrePresentacion($productos->f_presentacion)}}
          @endif</td>
            <td>{{'$ '.number_format($division->precio,2,'.',',')}}</td>
            <td>{{$division->stock}}</td>
            <td>
              <input type="hidden" id={{"division".$key}} value={{$division->f_division.$division->cantidad}}>
              <input type="hidden" value={{$division->id}}>
              @if(App\DetalleTransacion::cuenta($division->id))
              <button type="button" name="button" class="btn btn-xs btn-danger" id="eliminar_division_antigua">
                <i class="fa fa-remove"></i>
              </button>
              @else
                <button type="button" class="btn btn-xs btn-danger disabled" data-toggle="tooltip" data-placement="top" title="Esta división no puede ser eliminada">
                  <i class="fa fa-warning"></i>
                </button>
              @endif
              <a data-toggle="tooltip" data-placement="top" title="Editar">
                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal2" onclick="llenarDivision({{$division->id}},'{{$division->codigo}}',{{$division->precio}},{{$division->stock}})">
                <i class="fa fa-edit"></i>
              </button>
            </a>
            </td>
          </tr>
          @php
            $auxiliar_division = $key;
          @endphp
        @endforeach
        <input type="hidden" id="contador_division" value={{$auxiliar_division}}>
      @endif
    </tbody>
  </table>
</div>
<script type="text/javascript">
function llenarDivision(id,codigo,precio,stock){
$('#idDiv').val(id);
$('#pre').val(precio);
$('#stock').val(stock);
$('#cod').val(codigo);
}
</script>
