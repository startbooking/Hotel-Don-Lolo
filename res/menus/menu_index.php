<header class="main-header" >
    <a class="logo">
      <img class="img_thumbnail" src="<?php echo BASE_WEB; ?>img/logoBarahona.png">
      <span style="font-size:18px;font-family:ubuntu;font-weight: 600;margin-left:0px">Barahona Software</span>
    </a>
    <?php
    if (IP_ACCESS == 1) {
        if ($busca == 0) { ?>
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li> 
                <a style="font-family: 'Source Sans Pro'"> 
                   Equipo no Registrado 
                   <?php
                      $log = $user->ingresoLog(1, 'REMOTO', $pc, $ip, 'INTENTO DE ACCESO POR IP NO REGISTRADA', '', '', 'US');
            ?>
                  <i class="fa fa-power-off" aria-hidden="true"></i>
                 </a>

              </li>
            </ul>
          </div>
        </nav>
        <?php
        return;
        }
    }
      ?>
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li style="margin-top: 5px;">
            <a href="#" data-toggle="modal" data-target="#myModalLogin" style="font-size: 14px;"> <i class="fa fa-sign-in" aria-hidden="true"></i> Ingresar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>









