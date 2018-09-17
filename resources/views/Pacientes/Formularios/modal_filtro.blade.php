<div class="modal" tabindex="-1" role="dialog" id="filtro_pac">
  <div class="modal-dialog modal-lg" role="document">
    {!!Form::open(['route'=>'pacientes.index','method'=>'GET','role'=>'search','autocomplete'=>'off'])!!}
      @include('Pacientes.Formularios.filtro')
    {!!Form::close()!!}
  </div>
</div>