<?php 
  $fechapms = $hotel->getDatePms();

  $rooms    = $hotel->getHabitaciones(CTA_MASTER);
  $fechaini = $hotel->getPrimerDia(CTA_MASTER);
  $fechafin = $hotel->getUltimoDia(CTA_MASTER);
  $fecha1   = strtotime ($fechaini);
  $fecha2   = strtotime ($fechafin);
  $resta    = $fecha2 - $fecha1;
  $dias     = ($resta / (24 * 60 * 60))+1;
  if($dias<30){
    $dias = 30; 
  }

 ?>
<style type="text/css" media="screen">
  body{
    overflow : auto;
  }
</style>

<div class="content-wrapper"> 
  <section class="content" style="margin-bottom: 100px !important">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="forecast">
            <h3 class="w3ls_head tituloPagina"> <i style="color:black;font-size:36px;" class="fa fa-calendar" aria-hidden="true"></i> Forecast Hotel</h3>
          </div>
        </div>
      </div>
      <div class="panel-body" style="padding:0;">
        <div class="row-fluid" style="overflow-y: auto;height: 490px">
          <?php 
            $anchop = $dias*44; 
           ?>
          <div class="col-sm-11 col-sm-offset-1" style="margin-left:6.1%;padding:2px;width: <?=$anchop?>px;height: 26px;">
            <?php 
              for ($i = 0; $i <= $dias; $i++) {
                $fecha      = strtotime ( '+'.$i.'day',strtotime($fechaini)); ?>
                  <div class="col-sm-1 btn btn-warning btn-sm" style="width: 40px;border-radius: 0px;padding:1px" title="<?= strftime("%A, %d de %B de %Y", $fecha);?>">
                    <?=date ('d', $fecha );?>
                  </div>
                <?php
              } 
            ?>   
          </div>                
          <div class="col-sm-1" style="width: 6%;padding-left:2px;padding-right: 0">
            <?php 
            foreach ($rooms as $room) { ?>
              <button style="width: 100%;padding:1px;margin-bottom: 1px;border-radius: 0" class="btn btn-success" type="button" title="<?=$room['descripcion_habitacion']?>"><?=$room['tipo_hab'].' '.$room['numero_hab']?></button>
              <?php 
            }
            ?>      
          </div>
          <div class="col-sm-11" style="padding-left:2px">
            <?php 
              foreach ($rooms as $room) { 
                $numero = $room['numero_hab']; ?>
                <div class="row" style="width: <?=$anchop?>px;margin-left:0px;">
                  <?php 
                  for ($i = 0; $i <= $dias; $i++) {
                    $fecha      = strtotime ( '+'.$i.'day' , strtotime ( $fechaini ) ) ;
                    $fechabusca = date ('Y-m-d' , $fecha );
                    $estadias   = $hotel->buscaEstadia($fechabusca,$numero);
                    if(count($estadias)==0){
                      $izq = 42 * $i
                      ?>                        
                      <div style="width: 40px;height: 24px;padding:0;border:1px solid #2A1C1C33;margin-bottom: 1px;z-index: 1" class="col-sm-1 libre">
                      </div>
                      <?php 
                    }else{
                      $izq  = 42 * $i;
                      $alto = 1;
                      ?>
                        <div style="width: 40px;position: relative;padding:0;border:1px solid #2A1C1C33;height: 24px;margin-bottom: 1px;z-index: 10" class="col-sm-1 ocupada">
                          <?php 
                          if(count($estadias)>1){
                            $mas   = 1;
                            $altoh = 10;
                          }else{
                            $mas   = 0;
                            $altoh = 21;
                          }
                          foreach ($estadias as $estadia) { 
                            if($estadia['estado']=='CA'){
                              $color = 'btn-warning';
                            }else{
                              if($mas==1){
                                $color = 'btn-danger';
                              }else{                                
                                $color = 'btn-info';
                              }
                            }
                            $ancho = (40 * $estadia['dias_reservados'])-2;
                            if($estadia['estado']<>"SA" && $estadia['estado']<>"CX" ){
                          ?>
                            <a type="button" style="padding:2px 12px;margin-bottom: 1px;height: <?=$altoh?>px;width: <?=$ancho?>px;margin-top:<?=$alto?>px;margin-left:20px;z-index:20;display: block;border: 1px solid #000A;position:absolute;border-radius: 0;font-size:10px;color:#000;overflow: hidden;font-weight: 600" class="info btn <?=$color?> reserva" title="" draggable="true"> 
                              <span style="position: fixed;left: 500px; top: 52px;">Huesped <?=$estadia['apellido1'].' '.$estadia['apellido2'].' '.$estadia['nombre1'].' '.$estadia['nombre2']?><br>Habitacion <?=$estadia['num_habitacion']?><br>Adultos <?=$estadia['can_hombres']+$estadia['can_mujeres']?> Niños <?=$estadia['can_ninos']?> <br>Fecha Llegada <?=$estadia['fecha_llegada'] ?><br>Fecha Salida <?=$estadia['fecha_salida']?><br>Tarifa <?=number_format($estadia['valor_diario'],2)?></span>
                              <?=$estadia['apellido1']?>
                            </a>
                            <?php 
                              $alto = $alto + 10;
                            }
                          }
                          ?>
                        </div>
                      <?php 
                    }
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
  </section>
</div>
