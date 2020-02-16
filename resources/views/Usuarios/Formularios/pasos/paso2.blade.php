<div class="flex-row">
  <center>
    <h5>Datos del Usuario</h5>
  </center>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="" for="usuario">Usuario *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        {!! Form::text(
          'name',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'Nombre de usuario',
            'id'=>'name_usuario_field']
        ) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="" for="email">Correo *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-envelope"></i></div>
        </div>
        {!! Form::email(
          'email',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'Dirección de correo electrónico del usuario',
            'id'=>'email_usuario_field']
        ) !!}
        {{-- Mensaje para validar --}}
        <div class="invalid-feedback"></div>
      </div>
    </div>
    <input type="hidden" name="password">
    @if ($create)  
      <div class="form-group">
        <label class="" for="nombre">Tipo de usuario *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          <select class="form-control form-control-sm" name="tipoUsuario" id="tipoUsuario" onchange="tipo_usuario();">
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
              @if($tipoUsuario == "TAC")
                <option value="TAC" selected>TAC</option>
              @else
                <option value="TAC">TAC</option>
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
                <option value="TAC">TAC</option>
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
                @if($usuarios->tipoUsuario == "TAC")
                  <option value="TAC" selected>TAC</option>
                @else
                  <option value="TAC">TAC</option>
                @endif
              @endif
            @endif
          </select>
        </div>
			</div>
		@else
			<input type="hidden" name="" id="tipoUsuario" value="{{$usuarios->tipoUsuario}}">
    @endif
    <div class="form-group">
      <label class="" for="rol">Rol *</label>
      <div class="input-group mb-2 mr-sm-2">
        @if (isset($usuarios))
          @if ($usuarios->administrador)
            <div id="radioBtn" class="btn-group col-12">
              <a class="btn col-6 btn-primary btn-sm active" data-toggle="administrador" data-title="1">Administrador</a>
              <a class="btn col-6 btn-primary btn-sm notActive" data-toggle="administrador" data-title="0">Ninguno</a>
            </div>
            <input type="hidden" name="administrador" id="administrador" value="1">
          @else
            <div id="radioBtn" class="btn-group col-12">
              <a class="btn col-6 btn-primary btn-sm notActive" data-toggle="administrador" data-title="1">Administrador</a>
              <a class="btn col-6 btn-primary btn-sm active" data-toggle="administrador" data-title="0">Ninguno</a>
            </div>
            <input type="hidden" name="administrador" id="administrador" value="0">
          @endif
        @else
          <div id="radioBtn" class="btn-group col-12">
            <a class="btn col-6 btn-primary btn-sm notActive" data-toggle="administrador" data-title="1">Administrador</a>
            <a class="btn col-6 btn-primary btn-sm active" data-toggle="administrador" data-title="0">Ninguno</a>
          </div>
          <input type="hidden" name="administrador" id="administrador" value="0">
        @endif
      </div>
    </div>
  </div>
  <div class="col-sm-6">

    <div class="form-group">
      <label class="" for="foto">Foto </label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="custom-file input-group">
          <input type="file" name="foto" class="custom-file-input" id="foto" lang="es">
          <label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar Archivo</label>
        </div>
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
</div>
