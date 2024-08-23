<?php
  $rooms = $hotel->estadoHabitacionesHK();
?>

<div class="content-wrapper">
  <div class="container-fluid moduloCentrar">
    <div class="panel panel-success" style="width:100%">
      <div class="container-fluid">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="estadoHabitaciones">
          <div class="row">
            <div class="col-lg-6 col-xs-6">
              <h3 class="tituloPagina"><i class="fa fa-language" aria-hidden="true"></i> Estado Habitaciones </h3>
            </div>
            <div class="col-lg-6 col-xs-6">
              <div class="container-fluid mt-10 pd0">
                <div class="btn btn-xs bg btn-default category_item" category="all"><label>Todas</label></div>
                <div class="btn btn-xs bg category_item bg-limpia" category="limpias"><label>Disponibles</label></div>
                <div class="btn btn-xs bg category_item bg-ocupada" category="ocupadas"><label>Ocupadas</label></div>
                <div class="btn btn-xs bg category_item bg-sucia" category="sucias"><label>Sucia</label></div>
                <div class="btn btn-xs bg category_item bg-bloqueada" category="bloqueadas"><label>Bloqueada</label></div>
              </div>
            </div>
          </div>
        </div>
        <div class="store-wrapper">
          <section class="products-list">
            <?php
            foreach ($rooms as $room) {
              if($room['mantenimiento']==1){
                $color = 'bg-bloqueada';
                $categ = 'bloqueadas';
              }else{
                if($room['ocupada'] == 1){
                  $color = 'bg-ocupada';
                  $categ = 'ocupadas';
                }else{
                  if($room['sucia']==0){
                    $color = 'bg-limpia';
                    $categ = 'limpias';
                  }else{
                    $color = 'bg-sucia';
                    $categ = 'sucias';
                  }
                }
              }
              ?>
              <div class="product-item col-sm-2 col-xs-12 btnRoomStatus <?php echo $color; ?>" category="<?= $categ ?>" id="<?php echo $room['numero_hab']; ?>">
                <?php
                  if ($room['mantenimiento'] == 0) {
                    if($room['ocupada'] == 0){
                      ?>
                      <nav class="btn btn-xs btn-default navbar" style="margin-bottom: 0px;min-height:0px;">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                          <ul class="nav navbar-nav">
                            <li class="dropdown submenu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px 5px;font-size:11px;color: #000;"><i class="fa-solid fa-bars"></i></a>
                              <ul class="dropdown-menu" style="left:20px;top:5px;">
                                <li>
                                  <a
                                    data-toggle="modal" 
                                    href="#myModalObservaciones"
                                    data-reserva="0"
                                    data-numero="<?php echo $room['numero_hab']; ?>" 
                                    data-sucia="<?php echo $room['sucia']; ?>" 
                                    data-ocupada="<?php echo $room['ocupada']; ?>" 
                                    >
                                    <!-- onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','0','<?php echo $room['sucia']; ?>')" -->
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>Limpia</a>
                                  </li>
                                <li>
                                  <a 
                                    data-toggle="modal"
                                    href="#myModalObservaciones"
                                    data-reserva="0"
                                    data-numero="<?php echo $room['numero_hab']; ?>" 
                                    data-sucia="<?php echo $room['sucia']; ?>" 
                                    data-ocupada="<?php echo $room['ocupada']; ?>" 
                                    >
                                    <!-- onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','1','<?php echo $room['sucia']; ?>')" -->
                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                    Sucia</a>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </nav>
                      <?php
                    }else {
                      ?>
                      <nav class="btn btn-xs btn-default navbar" style="margin-bottom: 0px;min-height:0px;">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                          <bottom 
                            data-toggle="modal" 
                            class="btn btn-xs btn-success"
                            href="#myModalObservaciones"
                            data-reserva="<?php echo $room['num_reserva']; ?>"
                            data-numero="<?php echo $room['numero_hab']; ?>"
                            data-sucia="0"
                            data-ocupada="1"
                            title="Observaciones Estadia"><i class="fa-solid fa-comments"></i></bottom>
                        </div>
                      </nav>
                      <?php
                    }
                  }
                ?>
                <div class="inner">
                  <h5 class="habLimpia">HABITACION</h5>
                  <h3 class="sombraBlanca"><?php echo $room['numero_hab']; ?></h3>
                  <h4><?php echo $room['descripcion_habitacion']; ?>
                    <span><?php echo $room['caracteristicas']; ?></span>
                  </h4>
                  <?php
                  if($room['ocupada'] == 1){ ?>
                    <h4 class="lb-ocupada">Fecha Salida <span><?php echo $room['fecha_salida']; ?></span></h4>
                  <?php 
                  }
                  ?>
                </div>
              </div>
            <?php
            }
            ?>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
?>