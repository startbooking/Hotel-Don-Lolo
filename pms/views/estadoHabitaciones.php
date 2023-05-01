<?php
$rooms = $hotel->getHabitaciones(5);
?>

<div class="content-wrapper" >
  <div class="container-fluid moduloCentrar">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="estadoHabitaciones">
          <div class="row">
            <div class="col-lg-9">
              <h1 style="font-size:34px;text-align:left;margin-bottom: 20px;"><i class="fa fa-language" aria-hidden="true"></i> Estado Habitaciones </h1>
            </div>
            <div class="col-lg-3">
              <ul class="menuEstadHab">
                <li class="bg-limpiaVac">Limpia Vacante</li>
                <li class="bg-limpiaOcu">Limpia Ocupada</li>
                <li class="bg-suciaVac">Sucia Vacante</li>
                <li class="bg-suciaOcu">Sucia Ocupada</li>
                <li class="bg-maroon">Fuera de Orden</li>
                <li class="bg-red">Fuera de Servicio</li>
              </ul>
              <!-- <div class="col-sm-2 bg-limpiaVac" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div>
              <div class="col-sm-2 bg-limpiaOcu" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div>
              <div class="col-sm-2 bg-suciaVac" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div>
              <div class="col-sm-2 bg-suciaOcu" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div>
              <div class="col-sm-2 bg-maroon" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div>
              <div class="col-sm-2 bg-red" style="padding:8px;font-weight: 600;">
                <span class="info-box-text" style="color:#000"></span>
              </div> -->
            </div>
          </div>
        </div>
        <div class="panel-body moduloCentrar" style="color:#FFF">
          <?php
          foreach ($rooms as $room) {
              switch ($room['estado_hk']) {
                  case 'SO':
                      $color = 'bg-suciaOcu';
                      break;
                  case 'SV':
                      $color = 'bg-suciaVac';
                      break;
                  case 'LO':
                      $color = 'bg-limpiaOcu';
                      break;
                  case 'LV':
                      $color = 'bg-limpiaVac';
                      break;
                  case 'FO':
                      $color = 'bg-maroon';
                      break;
                  case 'FS':
                      $color = 'bg-red';
                      break;
                  default:
                      $color = 'aliceblue';
                      break;
              }

              ?>

            <div class="col-sm-2 col-xs-12 small-box  btnRoomStatus <?php echo $color; ?>" style="" id="<?php echo $room['numero_hab']; ?>">
              <div class="inner">
                <h5 style="">HABITACION</h5>
                <h3 ><?php echo $room['numero_hab']; ?></h3>
                <h4><?php echo $room['descripcion_habitacion']; ?></h4>
              </div>
              <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                  <ul class="nav navbar-nav">
                    <li class="dropdown submenu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px;font-size:11px;color: #000;margin-left: 15px; ">Estado<span class="caret" style="margin-left:25px"></span></a>
                      <ul class="dropdown-menu" style="left: 120px">  
                        <li>
                          <a data-toggle="modal" 
                            data-numero="<?php echo $room['numero_hab']; ?>" 
                            data-estado="<?php echo $room['estado_hk']; ?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']; ?>','<?php echo $room['estado_hk']; ?>','LO')"
                            >
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                           Limpia Ocupada</a> 
                        </li>
                        <li>
                          <a data-toggle="modal"
                            data-numero="<?php echo $room['numero_hab']; ?>" 
                            data-estado="<?php echo $room['estado_hk']; ?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']; ?>','<?php echo $room['estado_hk']; ?>','SO')"
                            >
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Sucia Ocupada</a>
                        </li>
                        <li>
                          <a data-toggle="modal" 
                            data-numero="<?php echo $room['numero_hab']; ?>" 
                            data-estado="<?php echo $room['estado_hk']; ?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']; ?>','<?php echo $room['estado_hk']; ?>','LV')"
                            >
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                           Limpia Vacante</a> 
                        </li>
                        <li>
                          <a data-toggle="modal"
                            data-numero="<?php echo $room['numero_hab']; ?>" 
                            data-estado="<?php echo $room['estado_hk']; ?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']; ?>','<?php echo $room['estado_hk']; ?>','SV')"
                            >
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Sucia Vacante</a>
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
</div>

<?php
?>