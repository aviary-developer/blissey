<?php $bandera=2;?>{{--Indica que es editar --}}
@extends('principal')
@section('layout')
  @include('Inventarios.Barra.edit')
  {!! Form::model($producto,['route'=>['inventarios.update',$producto->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off','id'=>'form']) !!}
    <div class="col-sm-10">
        <div class="x_panel">
            <div class="flex-row">
                <center>
                <h5 class="mb-1">{{$producto->producto->nombre}}:</h5>
                @php
                    $unidad=App\Unidad::find($producto->contenido);
                    $division=App\Division::find($producto->f_division);
                    $presentacion=App\Presentacion::find($producto->producto->f_presentacion);
                    $invetario=App\DivisionProducto::inventario($producto->id,1);
                    @endphp
                    @if ($unidad==null)
                    {{$invetario."--".$division->nombre." ".$producto->cantidad." ".$presentacion->nombre}}
                    @else
                    {{$invetario."--".$division->nombre." ".$producto->cantidad." ".$unidad->nombre}}
                    @endif
                </center>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
            <div class="x_panel">
                    <div class="ln_solid mb-1 mt-1"></div>
                    <div class="row">
                      <table class="table table-striped table-sm" id="inventario">
                          <thead>
                              <th>Cantidad</th>
                              <th>Lote</th>
                              <th>Estante</th>
                              <th>Nivel</th>
                              <th>Fecha de vencimiento</th>
                          </thead>
                          @php
                              $estantes=App\Estante::arrayEstante();
                          @endphp
                          <tbody>
                              @foreach ($lotes as $lote)
                              <tr>
                                <input type="hidden" name="idv[]" value='{{$lote->id}}'>
                              @php
                                  $niveles=App\Estante::nivel($lote->f_estante);
                              @endphp
                                <td>
                                <input type="hidden" name="cl[]" value='{{App\DetalleTransacion::find($lote->id)->cantidad}}'>
                                <input type="hidden" name="ca[]" value='{{$lote->cantidad}}'>
                                {!! Form::text('cantidad[]',$lote->cantidad,['class'=>'form-control form-control-sm','required'=>''])!!}
                                </td>
                                <td>{{$lote->lote}}</td>
                                @php
                                    $est=App\Estante::idEstante($lote->estante);
                                @endphp
                                <td>{!!Form::select('f_estante[]',
                                        $estantes
                                        ,$est, ['class'=>'form-control form-control-sm','id'=>'f_estante'.$lote->id,'onchange'=>'cambioEstante('.$lote->id.');'])!!}</td>
                                <td>{!!Form::select('nivel[]',
                                        $niveles
                                        ,$lote->nivel, ['class'=>'form-control form-control-sm','id'=>'nivel'.$lote->id])!!}</td>
                          <td>{{Carbon\Carbon::parse($lote->fecha_vencimiento)->format('d / m / Y')}}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="x_panel">
                    <center>
                      <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                      <a href={!! asset('inventarios') !!} class="btn btn-light btn-sm">Cancelar</a>
                    </center>
                  </div>
    </div>
  {!!Form::close()!!}
    <script type="text/javascript">
	    function cambioEstante(idp){
		    console.log(idp);
		    idEstante=$('#f_estante'+idp).find('option:selected').val();
		    console.log(idEstante);
		    $('#nivel'+idp).empty();
		    if(idEstante!=""){
			    var ruta = $('#guardarruta').val() + "/niveles/"+idEstante;
			    $.get(ruta,function(res){
				    cantidad=parseFloat(res);
				    for(i=1;i<=cantidad;i++){
					    $('#nivel'+idp).append("<option value="+i+">"+i+"</option>");
				    }
			    });
		    }
	    }
    </script>
@endsection
