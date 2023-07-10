<?php   
  // echo getcwd() . "\n";
  require '../config.php' ;
  // define("COMPANY", HOTEL_ID);
  require '../titles.php';
  require '../app_top.php';  
  $activo      = 1;
  
  $hotel       = $_POST['idhotel'];
  $fechain     = $_POST['fechain'];
  $fechaout    = $_POST['fechaout']; 
  $adultos     = $_POST['adultos'];
  $ninos       = $_POST['ninos']; 
  $noches      = $_POST['noches'];
  $fechainuni  = strtotime($fechain.' 12:00:00') ; 
  $fechaoutuni = strtotime(($fechaout).' 12:00:00'); 

  $valtarifa = 0;
  $valorrese = 0;


  $user    = new User_Actions();
  $hoteles = $user->getHoteles(HOTEL_ID);

  foreach($hoteles as $hotel): 
    $imptoinc = $hotel['tax_inc'] ;?>
    <div class="row-fluid bookingRoom">
      <?php 
        $rooms = $user->getRoomHotel($hotel['id_hotel']);
        foreach($rooms as $room): ?>
          <div class="row" >
            <div class="col-lg-5 col-md-5 col-xs-6" style='margin-top:15px;padding-right: 10px;padding-left: 0px;'>
              <img class="thumbnail" src="<?php echo BASE_IMAGES ?>rooms/md-<?=$room['image']?>" alt="" style='height: 100%;width: 100%;'>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6 infoRoom" style='margin-top:15px'>
              <div class="row">
                <label id="nameRoom" for=""><?=$room['room_name']?></label><br>
                <label id="textRoom" for=""><?=$room['sub_text']?></label><br>
                <div class="row">
                  <label for="" style="font-size:0.7em">Camas <?php echo $room['beds']?></label>
                  <?php 
                    for ($i = 1; $i <= $room['beds']; $i++) {
                      ?>
                      <i class="fa fa-hotel" aria-hidden="true"></i>
                      <?php 
                    }
                  ?>
                </div>
                <div class="row">
                  <label for="" style="font-size:0.7em">Capacidad</label>
                  <?php 
                    for ($i = 1; $i <= $room['pax_max']; $i++) { ?>
                      <i class="fa fa-male" aria-hidden="true"></i>
                      <?php 
                    }
                  ?>
                </div>
                <div class="row row-facility" style="margin-top:5px">
                  <?php 
                    $facilidades = $user->getFacilityRoom($room['id_room']);
                    foreach($facilidades as $facilidad): ?>
                      <div class="col-lg-2 col-md-2 col-xs-3 divFacility" style="">
                          <img class="img-thumbnail" src="<?php echo BASE_IMAGES ?>facility/<?=$facilidad['image']?>" alt="<?=$facilidad['description']?>" title="<?=$facilidad['description']?>">  
                        </div>
                    <?php endforeach; 
                  ?>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12" style='margin-top:15px;padding: 0'>
              <?php
                if($activo==2){?>
                  <h2 class="alert alert-danger" style="color:brown;font-weight: 600;margin-top:25px;padding:10px;width: 220px">Sin Disponibilidad</h2>
                  <?php 
                }else{
                  $botonreserva = "SI";                
                  $fechasale = $fechaoutuni;

                  $tarifas = $user->getRateRoom($room['id_room'],$fechainuni,$fechasale);
                  $valtarifa = 0;
                  $valorrese =  0;

                  $numreg = count($tarifas);
                  if($numreg==0){   ?>
                    <div class='alert alert-danger diagonal' style='color:#620808;font-size:0.8em;font-weight:600;text-transform: uppercase;'>
                      <center>Sin Disponibilidad</center>
                    </div>
                    <?php 
                  }else{ ?>
                    <div class="row div_reserva">
                      <?php 
                      foreach($tarifas as $tarifa): 
                        $valtarifa = $tarifa['value'];
                        $valorrese = $valorrese + $tarifa['value'];
                        ?>
                        <label for="" style="font-size:0.7em;color:brown;margin-bottom: 0">Fecha: <?= date('Y-m-d',$tarifa['date_num'])?></label>
                        <label for="" style="font-size:0.7em;color:brown;margin-bottom: 0"> <?= $hotel['currency'].' '.number_format($tarifa['value'],2)?></label>
                      <?php endforeach;  ?>
                    </div> 
                    <div class="row div_reserva">
                      <center>
                        <span style="font-size:1.3em;font-weight: 600;">
                          <?=number_format($valorrese,2)?>
                        </span>
                        <br>
                        <input type="hidden" id="tipohabi_<?=$room['id_room']?>" value="<?=$room['id_room']?>">
                        <input type="hidden" id="nombhabi_<?=$room['id_room']?>" value="<?=$room['room_name']?>">
                        <input type="hidden" id="tarifa_<?=$room['id_room']?>"   value="<?=$valorrese?>">
                        <input type="hidden" id="valesta_<?=$room['id_room']?>"  value="<?=$valorrese?>">
                        <label for=""><small>Valor Estadia</small>
                        <small>X <?=$noches?> Noches </small></label>
                      </center>
                      <center style="margin-top:-10px">
                        <small style="font-size:0.7em;font-weight: bold;">
                          <?php 
                            if($imptoinc==1){?>
                              (Impuestos Incluidos)
                              <?php 
                            }else{?>
                              (Impuestos No Incluidos)
                              <?php 
                            }
                          ?>
                        </small>
                      </center>
                      <?php 
                      $max = "NO";
                      $min = "NO";
                      $est = "NO";
                      $disp = "SI";
                      foreach($tarifas as $tarifa): 
                        $inveRoom = $tarifa['inv_room'];
                        $fechRoom = $tarifa['date_num'];
                        $disponible = $user->getDisponibilidadRoom($tarifa['id_room'],$tarifa['date_num']);
                        if($disponible>=$inveRoom){
                          $disp = "NO";
                          $mine = $disponible;
                          $botonreserva = "NO";
                        }
                        if($noches<$tarifa['min_stay']){
                          $est = "SI";
                          $mine = $tarifa['min_stay'];
                          $botonreserva = "NO";
                        }
                        if($adultos <$tarifa['min_pax']){ 
                          $min = "SI";
                          $cmin = $tarifa['min_pax'];
                          $botonreserva = "NO";
                        }
                        if ($adultos > $tarifa['max_pax']){ 
                          $max = "SI";
                          $cmax = $tarifa['max_pax'] ;
                          $botonreserva = "NO";
                        }
                        if ($tarifa['inv_room']==0) {
                          $disp = "NO";
                          $botonreserva = "NO";
                        }
                      endforeach;
                      if($max=="SI") { ?>
                        <center>  <label for="" style="margin-top:5px;color:darkred" class="mensaje">Ocupacion Maxima <?=number_format($cmax,0)?> Pers</label></center>
                        <?php 
                      }
                      if($min=="SI") { ?>
                        <center>  <label for="" style="margin-top:5px;color:darkred" class="mensaje">Ocupacion Minima <?=number_format($cmin,0)?> Pers</label></center>
                        <?php 
                      }
                      if($est=="SI") { ?>
                        <center>  <label for="" style="margin-top:5px;color:darkred" class="mensaje">Estadia Minima <?=number_format($mine,0)?> Noches</label></center>
                        <?php 
                      }
                      if($disp=="NO") { ?>
                        <center>  <label for="" style="margin-top:5px;color:darkred" class="mensaje">Habitacion No Disponible</label></center>
                        <?php 
                      } ?>
                    </div>
                    <?php 
                      if($botonreserva<>"NO"){
                        if($activo==1){ ?>
                          <center>   
                            <button style="margin-top:10px" type="button" class="btn btn-info btn-block" 
                              title="Selecciona Tipo de Habitacion a Reservar" 
                              id = "<?=$room['id_room']?>"
                              tipohabi = "<?=$room['room_name']?>"
                              onclick="reservar(this.id,<?= $hotel['id_hotel'] ?>,<?=$valtarifa?>,<?=$valorrese?>)">
                              <i class='glyphicon glyphicon-edit'></i> Reservar
                            </button>
                          </center>
                          <?php 
                        }else{ ?>
                          <center>   
                            <button style="margin-top:10px" type="button" class="btn btn-info btn-block" 
                              title="Selecciona Tipo de Habitacion a Reservar" 
                              id = "<?=$room['id_room']?>"
                              tipohabi = "<?=$room['room_name']?>"
                              onclick="reservar(this.id,<?= $hotel['id_hotel'] ?>,<?=$valtarifa?>,<?=$valorrese?>)">
                              <i class='glyphicon glyphicon-edit' disabled></i> Reservar
                            </button>
                          </center>
                          <?php 
                        }
                      }else{ ?>
                        <button style="margin-top:10px" type="button" class="btn btn-warning btn-block" 
                          title="Selecciona Tipo de Habitacion a Reservar" 
                          id = "<?=$room['id_room']?>"
                          tipohabi = "<?=$room['room_name']?>"
                          onclick="reservar(this.id,<?= $hotel['id_hotel'] ?>,<?=$valtarifa?>,<?=$valorrese?>)" disabled>
                          <i class='glyphicon glyphicon-edit'></i> Reservar
                        </button>                    
                        <?php 
                      }
                  }
                }
              ?>
            </div>
          </div>             
        <?php endforeach; 
      ?>
    </div>   
  <?php endforeach; ?> 

