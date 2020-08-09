<div class="modal fade" tabindex="-1" role="dialog" id="filtro_pac" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    
    {!!Form::open(['route'=>'pacientes.index','method'=>'GET','autocomplete'=>'off'])!!}
      @include('Pacientes.Formularios.filtro')
    {!!Form::close()!!}
  </div>
</div>