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
    <title><?=TITLE_ADM?> | Administracion Hotelera</title>
    <?php include_once("../res/shared/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="res/css/pms.css">  
  </head>

  <body class="skin-red sidebar-mini">
  <script>
    user = {
      usuario_id: 8,
      usuario:'CAMARERA',
      nombres:'CAMARERA',
      apellidos:'<?=NAME_HOTEL?>',
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
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="estadoHabitaciones">
            <h1 style="font-size:34px;text-align:center">
            Estado Habitaciones
            </h1>
            <div class="container-fluid" >
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
                <span class="info-box-text" style="color:#000">Fuera  de Orden</span>
              </div>
              <div class="col-sm-2 bg-red" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000">Fuera  de Servicio</span>
              </div>
            </div>
          </div>
          <div class="panel-body moduloCentrar" style="color:#FFF">
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
                  $color= $sucOcu;
                  break;
                case 'SV':
                  $color= $sucVac;
                  break;
                case 'LO':
                  $color= $limOcu;
                  break;
                case 'LV':
                  $color= $limVac;
                  break;
                case 'FO':
                  $color= $fueOrd;
                  break;
                case 'FS':
                  $color= $fueSer;
                  break;
                default:
                  $color= 'aliceblue';
                  break;
              }
              
              ?>

              <div class="col-sm-2 col-xs-12 small-box <?=$color?>" style="padding:2px;margin:2px;color:#FFF;">
                <div class="inner" style="height: 108px">
                  <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000">HABITACION</h5>
                  <h3 style="font-size:30px;margin:0"><?=$room['numero_hab']?></h3>
                  <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000"><?=$room['descripcion_habitacion']?></h5>
                </div>
                <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                    <ul class="nav navbar-nav">
                      <li class="dropdown submenu" style="padding:5px 2px">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size:14px ">Estado Habitacion<span class="caret" style="margin-left:10px"></span></a>
                        <ul class="dropdown-menu" style="left: 120px;padding:5px ">  
                          <li style="padding:10px 2px">
                            <a style="font-size:16px" data-toggle="modal" 
                              data-numero="<?php echo $room['numero_hab']?>" 
                              data-estado="<?php echo $room['estado_hk']?>" 
                              onclick="cambiaEstadoHK('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','LO')"
                              >
                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                             Habitacion Limpia Ocupada</a> 
                          </li>
                          <li style="padding:10px 2px">
                            <a style="font-size:16px" data-toggle="modal"
                              data-numero="<?php echo $room['numero_hab']?>" 
                              data-estado="<?php echo $room['estado_hk']?>" 
                              onclick="cambiaEstadoHK('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','SO')"
                              >
                            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            Habitacion Sucia Ocupada</a>
                          </li>
                          <li style="padding:10px 2px">
                            <a style="font-size:16px" data-toggle="modal" 
                              data-numero="<?php echo $room['numero_hab']?>" 
                              data-estado="<?php echo $room['estado_hk']?>" 
                              onclick="cambiaEstadoHK('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','LV')"
                              >
                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                             Habitacion Limpia Vacante</a> 
                          </li>
                          <li style="padding:10px 2px">
                            <a style="font-size:16px" data-toggle="modal"
                              data-numero="<?php echo $room['numero_hab']?>" 
                              data-estado="<?php echo $room['estado_hk']?>" 
                              onclick="cambiaEstadoHK('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','SV')"
                              >
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
    
    <script src="<?=BASE_PMS?>res/js/pms.js"></script> 
    <script src="<?=BASE_WEB?>res/js/inicio.js"></script>
    <?php 
    ?>
  </body>
</html>