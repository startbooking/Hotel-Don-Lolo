<?php 
  $rooms = $hotel->getHabitaciones(5);
?>

<div class="content-wrapper" >
  <div class="container-fluid moduloCentrar">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="estadoHabitaciones">
          <h1 style="font-size:34px;text-align:left;margin-bottom: 20px;"><i class="fa fa-language" aria-hidden="true"></i> Estado Habitaciones </h1>
          <div class="container-fluid" style="text-align: center">
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
            switch ($room['estado_hk']) {
              case 'SO':
                $color= 'bg-suciaOcu';
                break;
              case 'SV':
                $color= 'bg-suciaVac';
                break;
              case 'LO':
                $color= 'bg-limpiaOcu';
                break;
              case 'LV':
                $color= 'bg-limpiaVac';
                break;
              case 'FO':
                $color= 'bg-maroon';
                break;
              case 'FS':
                $color= 'bg-red';
                break;
              default:
                $color= 'aliceblue';
                break;
            }
            
            ?>

            <div class="col-sm-2 col-xs-12 small-box <?=$color?>" style="padding:2px;margin:2px;color:#FFF;width: 16%;" id="<?php echo $room['numero_hab']?>">
              <div class="inner" style="min-height: 120px">
                <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000">HABITACION</h5>
                <h3 style="font-size:30px;margin:0"><?=$room['numero_hab']?></h3>
                <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000"><?=$room['descripcion_habitacion']?></h5>
              </div>
              <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                  <ul class="nav navbar-nav">
                    <li class="dropdown submenu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px;font-size:11px;color: #000;margin-left: 15px; ">Estado Habitacion<span class="caret" style="margin-left:25px"></span></a>
                      <ul class="dropdown-menu" style="left: 120px">  
                        <li>
                          <a data-toggle="modal" 
                            data-numero="<?php echo $room['numero_hab']?>" 
                            data-estado="<?php echo $room['estado_hk']?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','LO')"
                            >
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                           Habitacion Limpia Ocupada</a> 
                        </li>
                        <li>
                          <a data-toggle="modal"
                            data-numero="<?php echo $room['numero_hab']?>" 
                            data-estado="<?php echo $room['estado_hk']?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','SO')"
                            >
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Habitacion Sucia Ocupada</a>
                        </li>
                        <li>
                          <a data-toggle="modal" 
                            data-numero="<?php echo $room['numero_hab']?>" 
                            data-estado="<?php echo $room['estado_hk']?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','LV')"
                            >
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                           Habitacion Limpia Vacante</a> 
                        </li>
                        <li>
                          <a data-toggle="modal"
                            data-numero="<?php echo $room['numero_hab']?>" 
                            data-estado="<?php echo $room['estado_hk']?>" 
                            onclick="cambiaEstado('<?php echo $room['numero_hab']?>','<?php echo $room['estado_hk']?>','SV')"
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
</div>

<?php 
?>