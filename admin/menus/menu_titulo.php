<header class="main-header" >
  <a href="<?php echo BASE_VIE; ?>modulos.php" class="logo">
    <img src="<?php echo BASE_WEB; ?>img/logoBarahona.png">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav"> 
        <li class="dropdown">
          <a href="#" id="nombreUsuario" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
          <ul class="dropdown-menu" style="background-color: #00a65a;color:#FFF">
            <li>
              <a class="altoMenu" 
                data-toggle    = 'modal'
                href="#myModalSoporteTecnico" style="padding:10px 15px;color:#FFF">Soporte Tecnico
              </a> 
            </li>
            <li>
              <a class="altoMenu" 
                data-toggle    = 'modal'
                href="#myModalCambiarClave" style="padding:10px 15px;color:#FFF">Cambiar Contraseña
              </a>
            </li>
            <li><a class="altoMenu" onclick="cierraSesion()" style="padding:10px 15px;color:#FFF">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>   
    </div>
  </nav>
</header>