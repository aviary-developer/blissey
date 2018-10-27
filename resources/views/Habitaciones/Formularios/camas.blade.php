<div class="flex-row">
  <center>
    <h5 class="">
      Camas 
      @if (!$create)  
        <small class="badge badge-success" id="etiqueta_cama">Activas</small>
      @endif
    </h5>
  </center>
</div>
<div id="msg" class ="flex-row" style="overflow-x: hidden; overflow-y: scroll; height: 304px;">
  @if (!$create)
    <div id="cama_activa">
      @if ($count_cama_a > 0)
        @foreach ($camas_a as $cama)
          <div class="col-sm-3 btn-light border border-secondary rounded">
            <div class="flex-row">
              <center>
                <span class="font-weight-bold">Cama</span>
              </center>
            </div>
            <div class="flex-row">
              <center>
                <div class="circulo-div-mini bg-c4">
                  <span>{{$cama->numero}}</span>
                  <input type="hidden" id="cama_antigua" value={{$cama->numero}}>
                </div>  
              </center>  
            </div>
            <div class="flex-row" style="margin: 3px 0 7px 0">
              <center>
                <span class="badge badge-dark font-sm">
                  {{'$'.number_format($cama->precio,2,'.',',')}}
                </span>
              </center>
            </div>
            <div class="flex-row" style="border-radius: 0 0 4px 4px">
              <center>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-sm btn-primary" id="edit_card" data-toggle="tooltip" data-placement="top" title="Editar" onclick={{"editar_cama(".$cama->id.",".$cama->precio.")"}}><i class="fa fa-edit"></i></button>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-sm btn-danger" id="desactive_card" title="Enviar a Papelera" onclick={{"cama_desactivar(".$cama->id.")"}}><i class="fa fa-trash"></i></button>
              </center>
            </div>
          </div>  
        @endforeach
      @else
        <center style="margin-top: 60px">
          <i class="fa fa-info-circle gray" style="font-size: 800%"></i>
        </center>
        <center class=" gray">
          <h5>Información</h5>
        </center>
        <center>
          <span>No se hay camas activas en esta habitación</span>
        </center>
      @endif
    </div>
    <div id="cama_papelera" style="display: none">
      @if ($count_cama_i > 0)
        @foreach ($camas_i as $cama)
          <div class="col-sm-3 btn-light border border-secondary rounded">
            <div class="flex-row">
              <center>
                <span class="font-weight-bold">Cama</span>
              </center>
            </div>
            <div class="flex-row">
              <center>
                <div class="circulo-div-mini bg-c4">
                  <span>{{$cama->numero}}</span>
                  <input type="hidden" id="cama_antigua" value={{$cama->numero}}>
                </div>  
              </center>  
            </div>
            <div class="flex-row" style="margin: 3px 0 7px 0">
              <center>
                <span class="badge badge-dark font-sm">
                  {{'$'.number_format($cama->precio,2,'.',',')}}
                </span>
              </center>
            </div>
            <div class="flex-row" style="border-radius: 0 0 4px 4px">
              <center>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-sm btn-primary" id="edit_card" title="Editar" onclick={{"editar_cama(".$cama->id.",".$cama->precio.")"}}><i class="fa fa-edit"></i></button>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-sm btn-success" id="desactive_card" title="Activar" onclick={{"cama_activate(".$cama->id.")"}}><i class="fa fa-check"></i></button>
              </center>
            </div>
          </div>  
        @endforeach
      @else
        <center style="margin-top: 60px">
          <i class="fa fa-info-circle gray" style="font-size: 800%"></i>
        </center>
        <center class=" gray">
          <h5>Información</h5>
        </center>
        <center>
          <span>No se hay camas en papelera en esta habitación</span>
        </center>
      @endif
    </div>
  @else
    <center style="margin-top: 60px">
      <i class="fa fa-info-circle gray" style="font-size: 800%"></i>
    </center>
    <center class=" gray">
      <h4>Información</h4>
    </center>
    <center>
      <span>No se ha registrado ninguna cama a esta habitación</span>
    </center>
  @endif
</div>