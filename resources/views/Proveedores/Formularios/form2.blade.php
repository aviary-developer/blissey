<div class="x_panel">
  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_visitador">
    <i class="fa fa-plus"></i> Agregar Visitador
  </button>
</div>

<div class="x_content">
  <h4>Visitadores agregados</h4>
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th colspan="2">Nombre</th>
          <th>Apellido</th>
          <th>Teléfono</th>
          <th>Opción</th>
        </tr>
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
                <a class='btn btn-danger btn-sm'>
                  <i class='fas fa-times' style='color:white'></i>
                </a>
              </td>
            </tr>
          @endfor
        @endif
      </tbody>
    </table>
  <div id="ocultos"></div>
</div>
{{--Modal visitador--}}
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
                   <div class="input-group-text"><i class="fas fa-user"></i></div>
                 </div>
                 {!! Form::text(
                   'tvn',
                   null,
                   ['class'=>'form-control form-control-sm',
                     'placeholder'=>'Nombre del visitador',
                     'id'=>'tvn'
                   ]
                 ) !!}
               </div>
             </div>

             <div class="form-group col-sm-12">
                 <label class="" for="nombre">Apellido *</label>
                 <div class="input-group mb-2 mr-sm-2">
                   <div class="input-group-prepend">
                     <div class="input-group-text"><i class="fas fa-user"></i></div>
                   </div>
                   {!! Form::text(
                     'tva',
                     null,
                     ['class'=>'form-control form-control-sm',
                       'placeholder'=>'Apellido del visitador',
                       'id'=>'tva'
                     ]
                   ) !!}
                 </div>
               </div>
               <div class="form-group col-sm-12">
                   <label class="" for="nombre">Teléfono *</label>
                   <div class="input-group mb-2 mr-sm-2">
                     <div class="input-group-prepend">
                       <div class="input-group-text"><i class="fas fa-phone"></i></div>
                     </div>
                     {!! Form::text(
                       'tvt',
                       null,
                       ['class'=>'form-control form-control-sm',
                         'data-inputmask'=>"'mask' : '9999-9999'",
                         'id'=>'tvt'
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
             <button type="button" class="btn btn-sm  col-2 btn-primary" onClick="agregarVisitador()" name="agregarVis" id="agregarVis">Agregar</button>
             <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
           </center>
         </div>
       </div>
     </div>
   </div>
 </div>
