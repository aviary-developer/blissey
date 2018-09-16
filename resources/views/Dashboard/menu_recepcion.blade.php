<li>
  <a>
    <i class="far fa-hospital"></i> Hospital
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/pacientes')}}>Pacientes</a>
    </li>
    <li>
      <a href={{asset( '/ingresos')}}>Hospitalización</a>
    </li>
    <li>
      <a>Mantenimiento
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/servicios')}}>Servicios</a>
        </li>
        <li>
          <a href={{asset( '/categoria_servicios')}}>Categorías de servicios</a>
        </li>
        <li>
          <a href={{asset( '/habitaciones')}}>Habitaciones</a>
        </li>
      </ul>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-microscope"></i> Laboratorio Clínico
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
    <a href={{asset( '/solicitudex?tipo=examenes')}}>Solicitud de examen</a>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-file-medical-alt"></i> Ultrasonografía
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/solicitudex?tipo=ultras')}}>Solicitudes</a>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-x-ray"></i> Departamento Rayos X
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/solicitudex?tipo=rayosx')}}>Solicitudes</a>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-desktop"></i> Departamento de TAC
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/solicitudex?tipo=tac')}}>Solicitudes</a>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-medkit"></i> Botiquín
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/inventarios')}}>Inventario</a>
    </li>
    <li>
      <a href={{asset( '/transacciones?tipo=0')}}>Pedidos</a>
    </li>
    <li>
      <a href={{asset( '/transacciones?tipo=2')}}>Ventas</a>
    </li>
    <li>
      <a href={{asset( '/requisiciones?tipo=4')}}>Requisiciones</a>
    </li>
    <li>
      <a>Movimiento de caja
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/detalleCajas/create')}}>Apertura/Cierre</a>
        </li>
        @if (App\DetalleCaja::cajaApertura())
          <li>
            <a href={{asset( '/arqueo')}}>Arqueo</a>
          </li>
        @endif
      </ul>
    </li>
    <li>
      <a>Mantenimiento
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/estantes')}}>Estantes</a>
        </li>
      </ul>
    </li>
  </ul>
</li>