<?php

require '../res/php/titles.php';
require '../res/php/app_topHotel.php';
$_SESSION['user']      = 'CAMARERA';
$_SESSION['apellidos'] = 'USUARIO';
$_SESSION['nombres']   = 'CAMARERIA';
$rooms = $hotel->getHabitaciones(4);

?>
<!DOCTYPE html>
<html>

<head>
  <title><?= TITLE_ADM ?> | Administracion Hotelera</title>
  <?php include_once("../res/shared/archivo_head.php") ?>
  <link rel="stylesheet" type="text/css" href="res/css/pms.css">
  <link rel="stylesheet" type="text/css" href="res/css/hk.css">
</head>

<body class="skin-red sidebar-mini">
  <script>
    user = {
      usuario_id: 8,
      usuario: 'CAMARERA',
      nombres: 'CAMARERA',
      apellidos: '<?= NAME_HOTEL ?>',
    }
    data = {
      user
    }
    localStorage.setItem("sesion", JSON.stringify(data));
  </script>


  <?php
  include_once("menus/menu_titulo.php");  ?>
  <div class="container-fluid moduloCentrar">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
        <input type="hidden" name="ubicacion" id="ubicacion" value="estadoHabitaciones">
        <h1 style="font-size:34px;text-align:center">
          Estado Habitaciones
        </h1>
        <div class="container-fluid">
          <div class="col-sm-2 bg-limpiaVac" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Limpia Vacante</span>
          </div>
          <div class="col-sm-2 bg-limpiaOcu" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Limpia Ocupada</span>
          </div>
          <div class="col-sm-2 bg-suciaVac" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Sucia Vacante</span>
          </div>
          <div class="col-sm-2 bg-suciaOcu" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Sucia Ocupada</span>
          </div>
          <div class="col-sm-2 bg-maroon" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Fuera de Orden</span>
          </div>
          <div class="col-sm-2 bg-red" style="padding:8px;font-weight: 600;">
            <span class="info-box-text" style="color:#000">Fuera de Servicio</span>
          </div>
        </div>
      </div>
      <!-- <div class="panel-body moduloCentrar" style="color:#FFF">
        <?php
        foreach ($rooms as $room) {
          $limVac = 'bg-limpiaVac';
          $limOcu = 'bg-limpiaOcu';
          $sucVac = 'bg-suciaVac';
          $sucOcu = 'bg-suciaOcu';
          $fueOrd = 'bg-maroon';
          $fueSer = 'bg-red';
          switch ($room['estado_hk']) {
            case 'SO':
              $color = $sucOcu;
              break;
            case 'SV':
              $color = $sucVac;
              break;
            case 'LO':
              $color = $limOcu;
              break;
            case 'LV':
              $color = $limVac;
              break;
            case 'FO':
              $color = $fueOrd;
              break;
            case 'FS':
              $color = $fueSer;
              break;
            default:
              $color = 'aliceblue';
              break;
          }
        ?>
          <div class="col-sm-2 col-xs-12 small-box <?= $color ?>" style="padding:2px;margin:2px;color:#FFF;">
            <div class="inner" style="height: 108px">
              <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000">HABITACION</h5>
              <h3 style="font-size:30px;margin:0"><?= $room['numero_hab'] ?></h3>
              <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000"><?= $room['descripcion_habitacion'] ?></h5>
            </div>
            <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                <ul class="nav navbar-nav">
                  <li class="dropdown submenu" style="padding:5px 2px">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size:14px ">Estado Habitacion<span class="caret" style="margin-left:10px"></span></a>
                    <ul class="dropdown-menu" style="left: 120px;padding:5px ">
                      <li style="padding:10px 2px">
                        <a style="font-size:16px" data-toggle="modal"
                          data-numero="<?php echo $room['numero_hab'] ?>"
                          data-estado="<?php echo $room['estado_hk'] ?>"
                          onclick="cambiaEstadoHK('<?php echo $room['numero_hab'] ?>','<?php echo $room['estado_hk'] ?>','LO')">
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                          Habitacion Limpia Ocupada</a>
                      </li>
                      <li style="padding:10px 2px">
                        <a style="font-size:16px" data-toggle="modal"
                          data-numero="<?php echo $room['numero_hab'] ?>"
                          data-estado="<?php echo $room['estado_hk'] ?>"
                          onclick="cambiaEstadoHK('<?php echo $room['numero_hab'] ?>','<?php echo $room['estado_hk'] ?>','SO')">
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Habitacion Sucia Ocupada</a>
                      </li>
                      <li style="padding:10px 2px">
                        <a style="font-size:16px" data-toggle="modal"
                          data-numero="<?php echo $room['numero_hab'] ?>"
                          data-estado="<?php echo $room['estado_hk'] ?>"
                          onclick="cambiaEstadoHK('<?php echo $room['numero_hab'] ?>','<?php echo $room['estado_hk'] ?>','LV')">
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                          Habitacion Limpia Vacante</a>
                      </li>
                      <li style="padding:10px 2px">
                        <a style="font-size:16px" data-toggle="modal"
                          data-numero="<?php echo $room['numero_hab'] ?>"
                          data-estado="<?php echo $room['estado_hk'] ?>"
                          onclick="cambiaEstadoHK('<?php echo $room['numero_hab'] ?>','<?php echo $room['estado_hk'] ?>','SV')">
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Habitacion Sucia Vacante</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        <?php
        }
        ?>
      </div> -->
      <div class="panel-body moduloCentrar" style="color:#FFF">
    <?php
    // Definición de las clases de color centralizada (opcional, podrías moverlo a CSS)
    $estado_colores = [
        'SO' => 'bg-suciaOcu', // Sucia Ocupada
        'SV' => 'bg-suciaVac', // Sucia Vacante
        'LO' => 'bg-limpiaOcu', // Limpia Ocupada
        'LV' => 'bg-limpiaVac', // Limpia Vacante
        'FO' => 'bg-maroon',    // Fuera de Orden
        'FS' => 'bg-red',       // Fuera de Servicio
    ];

    foreach ($rooms as $room) {
        // Obtener el color de la habitación, usando 'aliceblue' como fallback
        $estado_hk = $room['estado_hk'];
        $color = $estado_colores[$estado_hk] ?? 'aliceblue'; 
    ?>
    
    <div class="col-xs-6 col-sm-4 col-md-2 room-card <?= $color ?>">
        <div class="inner room-inner-content">
            <h5 class="room-title">HABITACION</h5>
            <h3 class="room-number"><?= $room['numero_hab'] ?></h3>
            <h5 class="room-description"><?= $room['descripcion_habitacion'] ?></h5>
        </div>
        
        <nav class="navbar navbar-default room-nav-menu">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-<?= $room['numero_hab'] ?>">
                <ul class="nav navbar-nav">
                    <li class="dropdown submenu room-dropdown-toggle">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Estado Hab. <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu room-dropdown-menu">
                            <li>
                                <a data-toggle="modal"
                                  onclick="cambiaEstadoHK('<?= $room['numero_hab'] ?>','<?= $estado_hk ?>','LO')">
                                  <i class="fa fa-address-card-o"></i>
                                  Limpia Ocupada
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal"
                                  onclick="cambiaEstadoHK('<?= $room['numero_hab'] ?>','<?= $estado_hk ?>','SO')">
                                  <i class="fa fa-calendar-plus-o"></i>
                                  Sucia Ocupada
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal"
                                  onclick="cambiaEstadoHK('<?= $room['numero_hab'] ?>','<?= $estado_hk ?>','LV')">
                                  <i class="fa fa-address-card-o"></i>
                                  Limpia Vacante
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal"
                                  onclick="cambiaEstadoHK('<?= $room['numero_hab'] ?>','<?= $estado_hk ?>','SV')">
                                  <i class="fa fa-calendar-plus-o"></i>
                                  Sucia Vacante
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <?php
    }
    ?>
</div>
    </div>
  </div>

  ?>
  <footer>
    <?php
    include_once '../res/shared/archivo_pie.php';
    ?>
  </footer>
  <?php
  include_once '../res/shared/archivo_script.php';
  include_once '../views/modal/modalUsuario.php';
  ?>

  <script src="<?= BASE_RES ?>dist/jquery.dataTables.min.js"></script>
  <?php

  ?>

  <script src="<?= BASE_PMS ?>res/js/pms.js"></script>
  <script src="<?= BASE_WEB ?>res/js/inicio.js"></script>
  <?php
  ?>
</body>

</html>