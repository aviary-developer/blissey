<div>
  <h4 class="StepTitle">Datos del Usuario</h4>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          {!! Form::text('name',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre de usuario']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
          {!! Form::email('email',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección de correo electronico']) !!}
        </div>
      </div>
      <input type="hidden" name="password">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de usuario *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          <select class="form-control has-feedback-left" name="tipoUsuario" id="tipoUsuario" onchange="tipo_usuario();">
            @if(isset($tipoUsuario))
              @if($tipoUsuario == "Gerencia")
                <option value="Gerencia" selected>Gerencia</option>
              @else
                <option value="Gerencia">Gerencia</option>
              @endif
              @if($tipoUsuario == "Médico")
                <option value="Médico" selected>Médico</option>
              @else
                <option value="Médico">Médico</option>
              @endif
              @if($tipoUsuario == "Recepción")
                <option value="Recepción" selected>Recepción</option>
              @else
                <option value="Recepción">Recepción</option>
              @endif
              @if($tipoUsuario == "Laboaratorio")
                <option value="Laboaratorio" selected>Laboratorio Clínico</option>
              @else
                <option value="Laboaratorio">Laboratorio Clínico</option>
              @endif
              @if($tipoUsuario == "Ultrasonografía")
                <option value="Ultrasonografía" selected>Ultrasonografía</option>
              @else
                <option value="Ultrasonografía">Ultrasonografía</option>
              @endif
              @if($tipoUsuario == "Rayos X")
                <option value="Rayos X" selected>Rayos X</option>
              @else
                <option value="Rayos X">Rayos X</option>
              @endif
              @if($tipoUsuario == "Farmacia")
                <option value="Farmacia" selected>Farmacia</option>
              @else
                <option value="Farmacia">Farmacia</option>
              @endif
              @if($tipoUsuario == "Enfermería")
                <option value="Enfermería" selected>Enfermería</option>
              @else
                <option value="Enfermería">Enfermería</option>
              @endif
            @else
                
              @if($create)  
                <option value="Gerencia">Gerencia</option>
                <option value="Médico">Médico</option>
                <option value="Recepción">Recepción</option>
                <option value="Laboaratorio">Laboratorio Clínico</option>
                <option value="Ultrasonografía">Ultrasonografía</option>
                <option value="Rayos X">Rayos X</option>
                <option value="Farmacia">Farmacia</option>
                <option value="Enfermería">Enfermería</option>
              @else
                @if($usuarios->tipoUsuario == "Gerencia")
                  <option value="Gerencia" selected>Gerencia</option>
                @else
                  <option value="Gerencia">Gerencia</option>
                @endif
                @if($usuarios->tipoUsuario == "Médico")
                  <option value="Médico" selected>Médico</option>
                @else
                  <option value="Médico">Médico</option>
                @endif
                @if($usuarios->tipoUsuario == "Recepción")
                  <option value="Recepción" selected>Recepción</option>
                @else
                  <option value="Recepción">Recepción</option>
                @endif
                @if($usuarios->tipoUsuario == "Laboaratorio")
                  <option value="Laboaratorio" selected>Laboratorio Clínico</option>
                @else
                  <option value="Laboaratorio">Laboratorio Clínico</option>
                @endif
                @if($usuarios->tipoUsuario == "Ultrasonografía")
                  <option value="Ultrasonografía" selected>Ultrasonografía</option>
                @else
                  <option value="Ultrasonografía">Ultrasonografía</option>
                @endif
                @if($usuarios->tipoUsuario == "Rayos X")
                  <option value="Rayos X" selected>Rayos X</option>
                @else
                  <option value="Rayos X">Rayos X</option>
                @endif
                @if($usuarios->tipoUsuario == "Farmacia")
                  <option value="Farmacia" selected>Farmacia</option>
                @else
                  <option value="Farmacia">Farmacia</option>
                @endif
                @if($usuarios->tipoUsuario == "Enfermería")
                  <option value="Enfermería" selected>Enfermería</option>
                @else
                  <option value="Enfermería">Enfermería</option>
                @endif
              @endif
            @endif
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rol *</label>
        &nbsp;&nbsp;&nbsp;
        @if (isset($usuarios))
          @if ($usuarios->administrador)
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-primary btn-sm active" data-toggle="administrador" data-title="1">Administrador</a>
              <a class="btn btn-primary btn-sm notActive" data-toggle="administrador" data-title="0">Ninguno</a>
            </div>
            <input type="hidden" name="administrador" id="administrador" value="1">
          @else
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-primary btn-sm notActive" data-toggle="administrador" data-title="1">Administrador</a>
              <a class="btn btn-primary btn-sm active" data-toggle="administrador" data-title="0">Ninguno</a>
            </div>
            <input type="hidden" name="administrador" id="administrador" value="0">
          @endif
        @else    
          <div id="radioBtn" class="btn-group">
            <a class="btn btn-primary btn-sm notActive" data-toggle="administrador" data-title="1">Administrador</a>
            <a class="btn btn-primary btn-sm active" data-toggle="administrador" data-title="0">Ninguno</a>
          </div>
          <input type="hidden" name="administrador" id="administrador" value="0">
        @endif
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-camera form-control-feedback left" aria-hidden="true"></span>
          {!! Form::file('foto',['id'=>'foto','class'=>'form-control has-feedback-left']) !!}
        </div>
      </div>
      <div class="">
        <center>
          <output id="list">
            @if ($create)
              <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 200px">
            @else
              <img src={{asset(Storage::url($usuarios->foto))}} style="height : 200px">
            @endif
          </output>
        </center>
      </div>
    </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <center>
      <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
    </center>
  </div>
</div>