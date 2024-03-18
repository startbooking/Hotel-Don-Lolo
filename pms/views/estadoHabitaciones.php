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
            <div class="col-lg-6 col-xs-6">
              <h3 class="tituloPagina"><i class="fa fa-language" aria-hidden="true"></i> Estado Habitaciones </h3>
            </div>
            <div class="col-lg-6 col-xs-6">
              <ul class="menuEstadHab">
                <li class="bg-limpiaVac"> 
                  <span class="fa-stack fa-lg" style="color:#FFF">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa-solid fa-bed iconoEstado"></i>
                  </span>  
                  Limpias</li>
                <li class="bg-limpiaOcu">
                  <span class="fa-stack fa-lg" style="color:#FFF">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa-solid fa-suitcase iconoEstado"></i>
                  </span>  
                  Ocupada</li>
                
                  <li class="bg-maroon">
                    <span class="fa-stack fa-lg" style="color:#FFF">
                      <i class="fa fa-square-o fa-stack-2x"></i>
                      <i class="fa-solid fa-gears iconoEstado"></i>
                    </span>  
                    Bloqueada
                    </li>

                  <li class="bg-suciaOcu">
                  <span class="fa-stack fa-lg" style="color:#FFF">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa-solid fa-broom iconoEstado"></i>
                  </span>  
                  Sucias</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="panel-body estadoHabitacion moduloCentrar" style="color:#FFF">
          <?php
          foreach ($rooms as $room) {
            switch ($room['sucia']) {
              case '0':
                $color = 'bg-limpiaVac';
                break;
              case '1':
                $color = 'bg-suciaOcu';
                break;              
            }
            switch ($room['mantenimiento']) {
              case '1':
                $color = 'bg-maroon';
                break;              
            }
            switch ($room['ocupada']) {
              case '1':
                $color = 'bg-limpiaOcu';
                break;              
            }           
            ?>
            <div class="col-sm-2 col-xs-12 small-box btnRoomStatus <?php echo $color; ?>" id="<?php echo $room['numero_hab']; ?>">
              <div class="inner">
                <h5 class="habLimpia">
                  <?php 
                  if($room['sucia']== 1){ ?>
                  <i class="fa-solid fa-broom escoba"></i>
                  <?php
                  }else { ?>
                  <i class="fa-solid fa-broom escoba apaga"></i>
                  <?php
                  }
                  ?>
                  HABITACION
                </h5>
                <h3><?php echo $room['numero_hab']; ?></h3>
                <h4><?php echo $room['descripcion_habitacion']; ?></h4>
              </div>
              <?php 
              if($room['mantenimiento']==0){ ?>
                <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                    <ul class="nav navbar-nav" style="width:100%">
                      <li class="dropdown submenu" style="width:100%">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px 5px;font-size:11px;color: #000;">Estado<span class="caret" style="right: 5px;position: absolute;top: 10px;"></span></a>
                        <ul class="dropdown-menu" style="left:20px;top:5px;">  
                          <li>
                            <a data-toggle="modal" 
                              data-numero="<?php echo $room['numero_hab']; ?>" 
                              data-sucia="<?php echo $room['sucia']; ?>" 
                              data-ocupada="<?php echo $room['ocupada']; ?>" 
                              onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','0','0')"
                              >
                            <i class="fa fa-address-card-o" aria-hidden="true"></i>Limpia</a> 
                          </li>
                          <li>
                            <a data-toggle="modal"
                              data-numero="<?php echo $room['numero_hab']; ?>" 
                              data-sucia="<?php echo $room['sucia']; ?>" 
                              data-ocupada="<?php echo $room['ocupada']; ?>" 
                              onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','1','1')"
                              >
                            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            Sucia</a>
                          </li>                        
                        </ul>
                      </li>
                    </ul>
                  </div>
                </nav> 
                
                <?php
              }
              ?>
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