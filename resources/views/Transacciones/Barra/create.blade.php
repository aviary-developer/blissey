<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/unidades') !!}>
    @if ($tipo==2)Venta
      <span class="badge border-primary border text-success">Nueva
      </span>
    @elseif($tipo==0)Compra
      <span class="badge border-primary border text-primary">Nuevo pedido
      </span>
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<input type="hidden" name="u" id="ubi" value="index">
