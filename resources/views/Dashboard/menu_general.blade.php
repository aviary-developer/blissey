<li>
  <a>
    <i class="fas fa-info-circle"></i> Información
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/usuarios/'.Auth::user()->id)}}>Mi Perfil</a>
    </li>
    <li>
      <a href={{asset( '/grupo_promesa')}}>Grupo Promesa</a>
    </li>
    <li>
      <a href={{asset( '/historial')}}>Historial</a>
    </li>
  </ul>
</li>