@extends('principal')
@section('layout')
    @include('Transacciones.Barra.devolucion')
    {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','url'=>['guardarDevoluciones',$transaccion->id],'method' =>'POST','autocomplete'=>'off','id'=>'dev'])!!}
        <div class="col-sm-8">
            <div class="alert alert-danger" id="mout">
                <center>
                    <p class="mb-1">Únicamente se muestran las unidades disponibles</b>.</p>
                </center>
            </div>
            <div class="x_panel">
                <center>
                    <h5 class="mb-1">Devolver</h5>
                </center>
                <div class="ln_solid mb-1 mt-1"></div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="nombre">Justicar *</label>
                    <div class="control-label col-md-10">
                        {!! Form::text('justificacion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Justificar las devoluciones','id'=>'justificacion']) !!}
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Devolver</th>
                            <th>Cantidad</th>
                            <th colspan="2">Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador=0;
                        @endphp
                        @foreach ($detalles as $detalle)
                        @if($detalle->f_producto!=null)
                            @php
                            if($transaccion->tipo==1){
                                $resta=App\divisionProducto::buscarLote($detalle->f_producto,$detalle->id);
                            }else{
                                $restar=App\DetalleDevolucion::total($detalle->id);
                                $resta=$detalle->cantidad-$restar;
                            }
                            @endphp
                            @if ($resta!=0)
                            @php
                                $contador++;
                            @endphp
                            <tr>
                                <td style="width:25%;">
                                    {!! Form::number('cantidad'.$detalle->id,0,['id'=>'cantidad'.$detalle->id,'class'=>'form-control','onKeyPress' => 'return cantidadDev( this, event,this.value,'.$detalle->id.');','placeholder'=>'Cantidad','min'=>'0']) !!}
                                </td>
                                <td>{{$resta}}
                                <input type="hidden" id="existencia{{$detalle->id}}" value="{{$resta}}">
                                </td>
                                <td>
                                @if($detalle->divisionProducto->unidad==null)
                                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre}}
                                @else
                                    {{$detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre}}
                                @endif
                                </td>
                            <td>{{$detalle->divisionProducto->producto->nombre}}</td>
                            </tr>
                            @endif
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @if($contador==0)
                <div class="alert alert-danger" id="mout">
                    <center>
                        <p class="mb-1">No hay unidades disponibles</b>.</p>
                    </center>
                </div>
                @endif
            </div>
            <div class="x_panel">
                    <center>
                    @if($contador!=0)
                        {!! Form::button('Confirmar',['class'=>'btn btn-primary','onclick'=>'justificar();']) !!}
                        <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
                    @endif
                      <a href={!! asset('/proveedores') !!} class="btn btn-light btn-sm">Cancelar</a>
                    </center>
                  </div>
        </div>
    {!!Form::close()!!}
    <script type="text/javascript">
        function cantidadDev(obj,e,valor,id){
        if(!entero(obj,e,valor)){
            return false;
        }else{
            cantidad=parseInt($('#cantidad'+id).val()+e.key);
            existe=parseInt($('#existencia'+id).val());
            if(cantidad>existe){
            notaError('La cantidad no debe superar las existencias');
            return false;
            }else{
            return true;
            }
        }
        }
        function justificar(){
        var cadena=$('#justificacion').val();
        if(cadena.length<1){
            notaError("Debe justificar la devolución");
        }else if(cadena.length<5){
            notaError("La justificación es muy corta");
        }else{
            $('#dev').submit();
        }
        }
    </script>
@endsection