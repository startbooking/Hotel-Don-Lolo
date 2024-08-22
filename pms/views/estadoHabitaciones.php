<?php
$rooms = $hotel->getHabitaciones(5);

// echo print_r($rooms);

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
              <!-- <div class="category_list">
                <a href="#" class="btn btn-success category_item" category="all">Todo</a>
                <a href="#" class="btn btn-success category_item" category="limpias">Limpias</a>
                <a href="#" class="btn btn-success category_item" category="sucias">Sucias</a>
                <a href="#" class="btn btn-success category_item" category="bloqueadas">Bloqueadas</a>
              </div> -->
              <div class="container-fluid mt-10 pd0">
                <div class="btn btn-xs bg bg-limpiaVac"><label>Limpia Vacia</label></div>
                <div class="btn btn-xs bg bg-limpiaOcu"><label>Limpia Ocupada</label></div>
                <div class="btn btn-xs bg bg-suciaVac"><label>Sucia Vacia</label></div>
                <div class="btn btn-xs bg bg-suciaOcu"><label>Sucia Ocupada</label></div>
                <div class="btn btn-xs bg bg-bloqueada"><label>Bloqueada</label></div>
              </div>
            </div>
          </div>
        </div>
        <div class="store-wrapper">
          
          <section class="products-list">
            <?php
            foreach ($rooms as $room) {
              if($room['sucia']==0 && $room['ocupada'] == 0){
                $color = 'bg-limpiaVac';
                $categ = 'limpias';
              }elseif($room['sucia']==0 && $room['ocupada'] == 1){
                $categ = 'limpias';
                $color = 'bg-limpiaOcu';
              }elseif($room['sucia']==1 && $room['ocupada'] == 0){
                $categ = 'sucias';
                $color = 'bg-suciaVac';
              }elseif($room['sucia']==1 && $room['ocupada'] == 1){
                $categ = 'sucias';
                $color = 'bg-suciaOcu';
              }

              switch ($room['mantenimiento']) {
                case '1':
                  $categ = 'bloqueadas';
                  $color = 'bg-bloqueada';
                  break;
              }
              ?>
              <div class="product-item col-sm-2 col-xs-12 btnRoomStatus <?php echo $color; ?>" category="<?= $categ ?>" id="<?php echo $room['numero_hab']; ?>">
                <?php
                  if ($room['mantenimiento'] == 0) { ?>
                    <nav class="btn btn-xs btn-default navbar" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                        <ul class="nav navbar-nav">
                          <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px 5px;font-size:11px;color: #000;"><i class="fa-solid fa-bars"></i></a>
                            <ul class="dropdown-menu" style="left:20px;top:5px;">
                              <li>
                                <a 
                                  data-toggle="modal" 
                                  data-numero="<?php echo $room['numero_hab']; ?>" 
                                  data-sucia="<?php echo $room['sucia']; ?>" 
                                  data-ocupada="<?php echo $room['ocupada']; ?>" onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','0','0')">
                                  <i class="fa fa-address-card-o" aria-hidden="true"></i>Limpia</a>
                              </li>
                              <li>
                                <a data-toggle="modal" data-numero="<?php echo $room['numero_hab']; ?>" data-sucia="<?php echo $room['sucia']; ?>" data-ocupada="<?php echo $room['ocupada']; ?>" onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','1','1')">
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
                <div class="inner">
                  <h5 class="habLimpia">HABITACION</h5>
                  <h3 class="sombraBlanca"><?php echo $room['numero_hab']; ?></h3>
                  <h4><?php echo $room['descripcion_habitacion']; ?>
                    <span><?php echo $room['caracteristicas']; ?></span>
                  </h4>
                </div>
              </div>
              <!-- <div class="col-sm-2 col-xs-12 small-box btnRoomStatus <?php echo $color; ?>" id="<?php echo $room['numero_hab']; ?> product-item" category="<?= $categ ?>">
                <div class="inner">
                  <h5 class="habLimpia">
                    <?php
                    if ($room['sucia'] == 1) { ?>
                      <i class="fa-solid fa-broom escoba"></i>
                    <?php
                    } else { ?>
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
                if ($room['mantenimiento'] == 0) { ?>
                  <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                      <ul class="nav navbar-nav" style="width:100%">
                        <li class="dropdown submenu" style="width:100%">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:1px 5px;font-size:11px;color: #000;">Estado<span class="caret" style="right: 5px;position: absolute;top: 10px;"></span></a>
                          <ul class="dropdown-menu" style="left:20px;top:5px;">
                            <li>
                              <a data-toggle="modal" data-numero="<?php echo $room['numero_hab']; ?>" data-sucia="<?php echo $room['sucia']; ?>" data-ocupada="<?php echo $room['ocupada']; ?>" onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','0','0')">
                                <i class="fa fa-address-card-o" aria-hidden="true"></i>Limpia</a>
                            </li>
                            <li>
                              <a data-toggle="modal" data-numero="<?php echo $room['numero_hab']; ?>" data-sucia="<?php echo $room['sucia']; ?>" data-ocupada="<?php echo $room['ocupada']; ?>" onclick="cambiaEstadoAseo('<?php echo $room['numero_hab']; ?>','<?php echo $room['ocupada']; ?>','1','1')">
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
              </div> -->
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