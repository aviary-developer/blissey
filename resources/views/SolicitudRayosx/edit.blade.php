@extends('dashboard')
@section('layout')
    {!!Form::model($solicitud,['class' =>'form-horizontal form-label-left input_mask','route' =>['solicitudex.update',$solicitud->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = false;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Edición de evaluación</h2>
        <div class="clearfix"></div>
        <h4>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}} <span class="label label-lg label-default">{{$solicitud->rayox->nombre}}</span></h4>
      </div>
      <div class="col-xs-12">
        <input type="hidden" name="solicitud" value={{$solicitud->id}}>
        <input type="hidden" name="evaluar" value=false>
        <input type="hidden" name="idRadiografia" value={{$solicitud->f_rayox}}>
        <div class="x_content">
          <div class="col-md-12 col-xs-12">
            <div class="x_content">
              <div id="alerts"></div>
              <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  </ul>
                </div>

                <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a data-edit="fontSize 5">
                        <p style="font-size:17px">Grande</p>
                      </a>
                    </li>
                    <li>
                      <a data-edit="fontSize 3">
                        <p style="font-size:14px">Normal</p>
                      </a>
                    </li>
                    <li>
                      <a data-edit="fontSize 1">
                        <p style="font-size:11px">Pequeña</p>
                      </a>
                    </li>
                  </ul>
                </div>

                <div class="btn-group">
                  <a class="btn" data-edit="bold" title="Negrita (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                  <a class="btn" data-edit="italic" title="Italica (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                  <a class="btn" data-edit="strikethrough" title="Marcar"><i class="fa fa-strikethrough"></i></a>
                  <a class="btn" data-edit="underline" title="Subrayar (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                </div>

                <div class="btn-group">
                  <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                  <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                  <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                  <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                </div>

                <div class="btn-group">
                  <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                  <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                  <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                  <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                </div>

                <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                  <div class="dropdown-menu input-append">
                    <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                    <button class="btn" type="button">Add</button>
                  </div>
                  <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                </div>

                <div class="btn-group">
                  <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                  <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                </div>
              </div>

              <div id="editor-one" name="contenedor" class="editor-wrapper">
              @php echo $resultado->observacion;@endphp</div>

              <textarea name="observacion" id="descr" style="display:none;"></textarea>
              <div class="ln_solid"></div>
            </div>
        </div>
        </div>
  </div>
  <div class="clearfix"></div>
  <center>
    <button name="botonGuardar" class="btn btn-primary" onclick="guardarHtml();">Guardar</button>
    <button type="reset" name="button" class="btn btn-default">Limpiar</button>
    <a href={!! asset('/solicitudex') !!} class="btn btn-default">Cancelar</a>
  </center>
</div>
  {!!Form::close()!!}
</div>
</div>
  <script>
  function radiografia(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('listRadiografia').innerHTML = ['<img style="height: 400px; width: 400px; object-fit: scale-down" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('idRadiografia').addEventListener('change', radiografia, false);

      function guardarHtml(){
        var contenedor=$('#descr');
        var textoHTML=$('#editor-one').html();
        contenedor.val(textoHTML);}
</script>
@endsection
