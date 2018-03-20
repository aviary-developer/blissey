@php
setlocale(LC_ALL,'es');
$detalles=$transaccion->detalleTransaccion;
@endphp
<div class="x_content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-12">
      <table class="table table-striped">
        <thead>
          <th>Cantidad</th>
          <th>Fecha de vencimiento</th>
          <th>Producto</th>
          <th>Lote</th>
          <th>Estante</th>
          <th>Nivel</th>
        </thead>
        <tbody>
      @foreach ($detalles as $detalle)
        <input type="hidden" name="detalle_id[]" value="{{$detalle->id}}">
            <tr>
              <td>{{$detalle->cantidad}}</td>
              <td>{{$detalle->fecha_vencimiento->formatLocalized('%d de %B de %Y')}}</td>
              <td>
                @if($detalle->divisionProducto->unidad==null)
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                @else
                  {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                @endif
              </td>
              <td>{{$detalle->lote}}</td>
              <td style="width:20%">{!!Form::select('f_estante[]',
                App\Estante::arrayEstante()
                ,null, ['placeholder' => 'Seleccione un estante','class'=>'form-control vals','id'=>'f_estante'.$detalle->id,'onChange'=>'cambioEstante('.$detalle->id.')'])!!}
            </td>
              <td style="width:15%">{!!Form::select('nivel[]',[]
                ,null, ['placeholder' => 'Nivel','class'=>'form-control','id'=>'nivel'.$detalle->id])!!}
              </td>
            </tr>
      @endforeach
    </tbody>
  </table>
      {!!Form::button('Confirmar',['class'=>'btn btn-primary','id'=>'confirmarAsignacion'])!!}
    </div>
  </div>
</div>
<script type="text/javascript">
function cambioEstante(idp){
console.log(idp);
idEstante=$('#f_estante'+idp).find('option:selected').val();
console.log(idEstante);
$('#nivel'+idp).empty();
if(idEstante!=""){
var ruta = "/blissey/public/niveles/"+idEstante;
$.get(ruta,function(res){
  cantidad=parseFloat(res);
  for(i=1;i<=cantidad;i++){
    $('#nivel'+idp).append("<option value="+i+">"+i+"</option>");
  }
});
}
}
</script>
