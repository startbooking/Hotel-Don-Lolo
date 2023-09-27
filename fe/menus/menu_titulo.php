<header class="main-header" >
  <a href="<?= BASE_VIE ?>modulos.php" class="logo">
    <img src="<?=BASE_WEB?>img/logoBarahona.png" style="width:40px;">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
    <input type="hidden" id="rutaweb" name="rutaweb" value="<?=BASE_FE?>">
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="border-bottom: none;">
      <span class="sr-only">Toggle navigation</span>
    </a>    
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="nombreUsuario"><span class="caret"></span></a>
          <ul class="dropdown-menu" style="background-color: #00a65a;color:#FFF;">
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
