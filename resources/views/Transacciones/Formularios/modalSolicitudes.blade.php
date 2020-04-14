<div class="modal fade" tabindex="-1" role="dialog" id="solicitudes" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="row">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-user"></i>
                Solicitudes de exámenes
              </h4>
            </center>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">                  
                  <div class="x_panel m_panel">
                      <div class="flex-row">
                          <center>
                              <h5>Solicitudes pendientes de cobro</h5>
                          </center>
            </div>
            @php
                $solicitudes=App\SolicitudExamen::where('cancelado',false)->get();
            @endphp
            <div class="flex-row" style="height:300px; overflow-x:hidden; overflow-y:scroll;">
                      <table class="table table-sm">
                          <thead>
                              <th>Paciente</th>
                              <th>Examen</th>
                              <th>Precio</th>
                              <th>Acción</th>
                          </thead>
                          <tbody>
                              @foreach ($solicitudes as $solicitud)
                                @php
                                    if($solicitud->examen!=null){
                                        $nsolicitud="Laboratorio clínico ".$solicitud->examen->nombreExamen;
                                        $ts=1;
                                        $idts=$solicitud->examen->id;
                                    }elseif($solicitud->ultrasonografia!=null){
                                        $nsolicitud="Ultrasonografía ".$solicitud->ultrasonografia->nombre;
                                        $ts=2;
                                        $idts=$solicitud->ultrasonografia->id;
                                    }elseif($solicitud->rayox!=null){
                                        $nsolicitud="Rayos x ".$solicitud->rayox->nombre;
                                        $ts=3;
                                        $idts=$solicitud->rayox->id;
                                    }elseif($solicitud->tac!=null){
                                        $nsolicitud="TAC ".$solicitud->tac->nombre;
                                        $ts=4;
                                        $idts=$solicitud->tac->id;
                                    }
                              @endphp
                                  <tr>
                                    <td>{{$solicitud->nombrePaciente($solicitud->f_paciente)}}</td> 
                                    <td>
                                         {{$nsolicitud}}   
                                    </td>
                                    @php
                                        $sservicio=$solicitud->servicio($ts,$idts);
                                    @endphp
                                    <td>$ {{number_format($sservicio->precio,2,'.','')}} </td>
                                    <td>
                                    <button id="bts{{$solicitud->id}}" type='button' class='btn btn-sm btn-primary' onclick="registrarsolicitud('{{$nsolicitud}}','{{$sservicio->precio}}','{{$sservicio->id}}','{{$solicitud->id}}');">
                                            <i class='fas fa-check'></i>
                                        </button>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                        </table>
            </div>
                  </div>
  
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="m_panel x_panel bg-transparent" style="border:0px !important">
            <center>
              <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" onclick="limpiarTablaVenta()">Cerrar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  