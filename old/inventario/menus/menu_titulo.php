<header class="main-header" >
  <a href="<?= BASE_VIE ?>modulos.php" class="logo" style="height: 51px;padding-left:10px">
    <img id="logoInv" class="img_thumbnail" src="<?=BASE_WEB?>img/logoBarahona.png" style="width: 48px !important;">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown" id="datosLink">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="usuarioActivo"> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a class="altoMenu" 
                data-toggle    = 'modal'
                href="#myModalSoporteTecnico">Soporte Tecnico
              </a> 
            </li>
            <li>
              <a class="altoMenu" 
                data-toggle    = 'modal'
                href="#myModalCambiarClave">Cambiar Contraseña
              </a>
            </li>
            <li><a class="altoMenu" onclick="cierraSesion()">Cerrar Sesion</a></li>
          </ul>

        </li>
      </ul>   
    </div>
  </nav>
</header>
