<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href={!! asset('/unidades') !!}>
        Productos
        <span class="badge border-danger border text-danger">Stock bajo
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" target="_blank" href={!! asset('/stockBajo_pdf/') !!}>Reporte</a>   
            </li>
            <li class="nav-item">
                @if ($f_proveedor!="")
                    <a href={!! asset('/stockProveedor/'.$f_proveedor) !!} class="nav-link active">Pedido</a>
                @endif
            </li>   
        </ul>
        @include('Dashboard.boton_salir')
    </div>
</nav>
<input type="hidden" name="u" id="ubi" value="index">
      {{-- <div class="btn-group">
            <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
            @if ($f_proveedor!="")
            <a href={!! asset('/stockProveedor/'.$f_proveedor) !!} class="btn btn-dark btn-ms"><i class="fa fa-cart-plus"></i> Pedido</a>
            @endif
        </div> --}} 