<div class="row">
  <center>
    <h4 class="big-text">
      Camas 
      @if (!$create)  
        <small class="label label-success" id="etiqueta_cama">Activas</small>
      @endif
    </h4>
  </center>
</div>
<div id="msg" class ="row" style="overflow-x: hidden; overflow-y: scroll; height: 304px;">
  @if (!$create)
    <div id="cama_activa">
      @if ($count_cama_a > 0)
        @foreach ($camas_a as $cama)
          <div class="col-xs-3 btn-default" style="border-radius: 4px">
            <div class="row">
              <center>
                <span class="big-text">Cama</span>
              </center>
            </div>
            <div class="row">
              <center>
                <div class="circulo-div-mini bg-c4">
                  <span>{{$cama->numero}}</span>
                  <input type="hidden" id="cama_antigua" value={{$cama->numero}}>
                </div>  
              </center>  
            </div>
            <div class="row" style="margin: 3px 0 7px 0">
              <center>
                <span class="label label-lg label-default">
                  {{'$'.number_format($cama->precio,2,'.',',')}}
                </span>
              </center>
            </div>
            <div class="row bg-blue-sky" style="border-radius: 0 0 4px 4px">
              <center>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-xs btn-primary" id="edit_card" data-toggle="tooltip" data-placement="top" title="Editar" onclick={{"editar_cama(".$cama->id.",".$cama->precio.")"}}><i class="fa fa-edit"></i></button>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-xs btn-danger" id="desactive_card" data-toggle="tooltip" data-placement="top" title="Enviar a Papelera" onclick={{"cama_desactivar(".$cama->id.")"}}><i class="fa fa-trash"></i></button>
              </center>
            </div>
          </div>  
        @endforeach
      @else
        <center style="margin-top: 60px">
          <i class="fa fa-info-circle gray" style="font-size: 800%"></i>
        </center>
        <center class="big-text gray">
          <h4>Información</h4>
        </center>
        <center>
          <span>No se hay camas activas en esta habitación</span>
        </center>
      @endif
    </div>
    <div id="cama_papelera" style="display: none">
      @if ($count_cama_i > 0)
        @foreach ($camas_i as $cama)
          <div class="col-xs-3 btn-default" style="border-radius: 4px">
            <div class="row">
              <center>
                <span class="big-text">Cama</span>
              </center>
            </div>
            <div class="row">
              <center>
                <div class="circulo-div-mini bg-c4">
                  <span>{{$cama->numero}}</span>
                  <input type="hidden" id="cama_antigua" value={{$cama->numero}}>
                </div>  
              </center>  
            </div>
            <div class="row" style="margin: 3px 0 7px 0">
              <center>
                <span class="label label-lg label-default">
                  {{'$'.number_format($cama->precio,2,'.',',')}}
                </span>
              </center>
            </div>
            <div class="row bg-blue-sky" style="border-radius: 0 0 4px 4px">
              <center>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-xs btn-primary" id="edit_card" data-toggle="tooltip" data-placement="top" title="Editar" onclick={{"editar_cama(".$cama->id.",".$cama->precio.")"}}><i class="fa fa-edit"></i></button>
                <button type="button" style="margin: 2px 0 2px 0" class="btn btn-xs btn-success" id="desactive_card" data-toggle="tooltip" data-placement="top" title="Activar" onclick={{"cama_activate(".$cama->id.")"}}><i class="fa fa-check"></i></button>
              </center>
            </div>
          </div>  
        @endforeach
      @else
        <center style="margin-top: 60px">
          <i class="fa fa-info-circle gray" style="font-size: 800%"></i>
        </center>
        <center class="big-text gray">
          <h4>Información</h4>
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
      <center class="big-text gray">
        <h4>Información</h4>
      </center>
      <center>
        <span>No se ha registrado ninguna cama a esta habitación</span>
      </center>
  @endif
</div>