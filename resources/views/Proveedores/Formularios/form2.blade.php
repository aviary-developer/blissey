<div class="x_panel">
  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_visitador">
    <i class="fa fa-plus"></i> Agregar Visitador
  </button>
</div>

<div class="x_content">
  <h4>Visitadores agregados</h4>
  <div style="height: 300px">
    <table class="table">
      <thead>
        <th colspan="2">Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Opción</th>
      </thead>
      <tbody id="visitadores">
        <!--Aqui se agregan los tr por parte de la función agregarVisitador-->
        @if (isset($nombrev))
          @for($a=0;$a<count($nombrev);$a++)
            <tr>
              <td>
                <input type='hidden' name='nombrev[]' value={{$nombrev[$a]}}>
                <input type='hidden' name='apellidov[]' value={{$apellidov[$a]}}>
                <input type='hidden' name='telefonov[]' value={{$telefonov[$a]}}>
              </td>
              <td>{{$nombrev[$a]}}</td>
              <td>{{$apellidov[$a]}}</td>
              <td>{{$telefonov[$a]}}</td>
              <td class='deleteVisitador' style='cursor:pointer;'>
                <a class='btn btn-danger btn-xs'>
                  <i class='fa fa-remove'></i>
                </a>
              </td>
            </tr>
          @endfor
        @endif
      </tbody>
    </table>
  </div>
  <div id="ocultos"></div>
  <div class="form-group">
    <center>
      {{-- <input class="btn btn-primary" name="registrarProveedor" id="registrarProveedor" type="button" value="Guardar" onClick="guardarProveedor()"/> --}}
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/proveedores') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
{{--///////////////////////////7MODAL  --}}
{{-- <h4>Datos del visitador</h4>
<div class="form-group"><!-- Temporal visitador nombre-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvn',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo visitador','id'=>'tvn']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador apellido-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tva',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo visitador','id'=>'tva']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador teléfono-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvt',null,['class'=>'form-control has-feedback-left','placeholder'=>'Teléfono del nuevo visitador','id'=>'tvt','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
  </div>
</div>
<center>
  <button type="button" class="btn btn-sm btn-primary" onClick="agregarVisitador()" name="agregarVis" id="agregarVis">
    <i class="fa fa-plus"></i> Agregar Visitador
  </button>
</center>
 --}}
 <div class="modal fade" tabindex="-1" role="dialog" id="modal_visitador" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="row">
       <div class="col-sm-12">
         <div class="x_panel m_panel text-danger">
           <center>
             <h4 class="mb-1">
               <i class="fas fa-plus"></i>
               Visitador
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

             <div class="form-group col-sm-12">
               <label class="" for="nombre">Nombre *</label>
               <div class="input-group mb-2 mr-sm-2">
                 <div class="input-group-prepend">
                   <div class="input-group-text"><i class="fas fa-industry"></i></div>
                 </div>
                 {!! Form::text(
                   'nombre',
                   null,
                   ['class'=>'form-control form-control-sm',
                     'placeholder'=>'Nombre del proveedor',
                     'id'=>'nombre'
                   ]
                 ) !!}
               </div>
             </div>

           </div>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-sm-12">
         <div class="m_panel x_panel bg-transparent" style="border:0px !important">
           <center>
             <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
           </center>
         </div>
       </div>
     </div>
   </div>
 </div>
