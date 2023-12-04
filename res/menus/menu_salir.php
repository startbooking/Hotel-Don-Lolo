<header class="main-header" >
  <a class="logo">
    <img class="img_thumbnail" src="<?php echo BASE_WEB; ?>img/logoBarahona.png">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="nombreUsuario"></a>
          <ul class="dropdown-menu" style="width:100%">
            <li>
              <a class="altoMenu"
                data-toggle    = 'modal'
                href="#myModalSoporteTecnico" >Soporte Tecnico
              </a>
            </li>
            <li>
              <a class="altoMenu"
                data-toggle    = 'modal'
                href="#myModalCambiarClave" >Cambiar Contraseña
              </a>
            </li>
            <li><a class="altoMenu" onclick="cierraSesion()">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
