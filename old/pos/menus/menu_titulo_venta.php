<header class="main-header" >
  <a href="<?= BASE_VIE ?>modulos.php" class="logo" style="height: 51px;padding-left:10px">
    <img src="<?=BASE_WEB?>img/logoBarahona.png" style="width: 30px">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <ul class="nav navbar-nav "> 
      <li>
        <label id="fechaPos" for="" style="font-weight: 600;padding:11px 15px;color:#FFF;font-size:16px"></label>
      </li>          
    </ul>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
          <li></li>          
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
            <li><a class="altoMenu" onclick="cierraSesion()" >Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>   
    </div>
  </nav>
</header>