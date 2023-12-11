<header class="main-header">
  <a href="<?php echo BASE_VIE; ?>modulos.php" class="logo">
    <img class="img_thumbnail logo-mini imgLogo" src="<?php echo BASE_WEB; ?>img/logoBarahona.png">
    <div class="container-fluid logo-lg" style="transition:0.5s">
      <img style="margin-top:2px !important;" class="img_thumbnail imgLogo" src="<?php echo BASE_WEB; ?>img/logoBarahona.png">
      <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
    </div>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="border-bottom: none;">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <ul class="nav navbar-nav ">
      <li>
        <label id="fechaPos" for=""></label>
      </li>
    </ul>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="nombreUsuario"><span class="caret"></span></a>
          <input id="idUsuario" type="hidden" value="">
          <ul class="dropdown-menu">
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
  
