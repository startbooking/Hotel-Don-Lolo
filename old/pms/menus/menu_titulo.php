<header class="main-header" >
  <a href="<?= BASE_VIE ?>modulos.php" class="logo" style="height: 51px;padding-left:10px">
    <img src="<?=BASE_WEB?>img/logoBarahona.png" style="width: 45px">
    <span style="font-size:16px;font-weight: 600">Pagina Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <ul class="nav navbar-nav ">
      <li>
        <label for="" style="font-weight: 600;padding:11px 15px;color:#FFF;font-size:16px">Fecha Proceso <?=FECHA_PMS?></label>
      </li>          
    </ul>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown" id="datosLink">
          <a id="nombreUsuario" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
          <ul class="dropdown-menu" style="margin-top:0px !important;margin:0 !important">
            <li>
              <a class="altoMenu" 
                data-toggle    = 'modal'
                href="#myModalSoporteTecnico" style="padding:10px 15px">Soporte Tecnico
              </a> 
            </li>
            <li id="menuClave">
            </li>
            <li><a class="altoMenu" onclick="cierraSesion()" style="padding:10px 15px">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>   
    </div>
  </nav>
</header>
