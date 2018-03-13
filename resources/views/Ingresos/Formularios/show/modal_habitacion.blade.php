{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_habitacion">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Información</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" id="vista_1" style="min-height: 200px;">
          <div class="row">
            <div class="col-sm-7 col-xs-12">
              <div class="row">
                <center>
                  <div class="bg-green">
                    <h3>{{"Habitación ".$habitacion->numero}}</h3>
                  </div>
                  <br>
                  <div class="col-xs-4"></div>
                  @if ($habitacion->tipo)
                  <span class="label-lg label label-white blue borde col-xs-4">Hospital</span>
                  @else
                    <span class="label-lg label label-primary col-xs-4">Observación</span>
                  @endif  
                </center>
              </div>
              <br>
              <div class="row">
                <table class="table">
                  <tr>
                    <th>
                      Precio
                    </th>
                    <td class="text-right">{{"$ ".number_format($habitacion->precio,2,'.',',')}}</td>
                  </tr>
                  <tr>
                    <th>Tiempo de ingreso</th>
                    @php
                      if($ingreso->fecha_alta == null){
                        $hoy = Carbon\Carbon::now();
                        $horas = $ingreso->fecha_ingreso->diffInHours($hoy);
                      }else{
                        $horas = $ingreso->fecha_ingreso->diffInHours($ingreso->fecha_alta);
                      }
                    @endphp
                    <td class="text-right">{{$horas.(($horas == 1)?'hora':' horas')}}</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-sm-5 col-xs-12">
              <div class="col-sm-12 col-xs-4 borde green" style="margin: 2px 2px 2px 2px">
                <center>
                  <h5>Cambiar a observación</h5>
                  <button type="button" class="btn btn-success btn-xs" onclick="cambio_habitacion(0)">Cambiar</button>
                </center>
              </div>
              <div class="col-sm-12 col-xs-4 borde blue" style="margin: 2px 2px 2px 2px">
                <center>
                  <h5>Cambiar a medi ingreso</h5>
                  <button type="button" class="btn btn-xs btn-primary">Cambiar</button>
                </center>
              </div>
              <div class="col-sm-12 col-xs-4 borde black" style="margin: 2px 2px 2px 2px">
                <center>
                  <h5>Cambiar de habitación</h5>
                  <button type="button" class="btn btn-xs btn-dark">Cambiar</button>
                </center>
              </div>
            </div>
          </div>
        </div>
        <div class="x_panel" id="vista_2" style="display: none; min-height: 200px;">
          <div class="row bg-green">
            <center>
              <h3>Cambio a Observación</h3>
            </center>
          </div>
          <br>
          <div class="row">
            <div>
              <p style="font-size: 120%;">Se cambiará el ingreso a observación, por favor seleccione la habitación en la cual se ubicará al paciente</p>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-3 col-xs-12">Habitación *</label>
              <div class="col-md-9 col-xs-12">
                <select class="form-control" name="f_habitacion" id="h_hab">
                  @if (count($habitaciones_o)==0)
                      <option value="0" disabled>No ha habitaciones disponibles</option>
                  @else
                    @foreach ($habitaciones_o as $habitacion)
                      <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <center>
              <button type="button" class="btn btn-primary" onclick="guardar_cambio(0)">Guardar</button>
            </center>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="ret" class="btn btn-default" onclick="cambio_habitacion(-1)" style="display:none">Regresar</button>
        <a href={{asset('/pacientes/'.$paciente->id)}} class="btn btn-primary" id="go">Ir a registro</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
