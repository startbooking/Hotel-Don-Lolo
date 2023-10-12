<?php 
  $fechapms = $hotel->getDatePms();

  $tipohabis = $hotel->getTipoHabitacion();

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
<div class="content-wrapper"> 
  <section class="content" style="margin-bottom: 10px !important">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="forecast">
            <h3 class="w3ls_head tituloPagina" style="padding:0;"> <i style="color:black;" class="fa fa-calendar ga-2x" aria-hidden="true"></i> Forecast Hotel</h3>
          </div>
          <div class="col-lg-6" >
            <div class="wrap">
              <div class="store-wrapper">
                <div class="category_list pull-right">                  
                  <a href="#" class="category_item btn btn-default" category="all">Todo</a>
                  <?php
                    foreach($tipohabis as $tipohabi){
                      ?>
                      <a href="#" 
                        class="category_item btn btn-default" 
                        category="<?= $tipohabi['codigo'];?>"
                        title="<?=$tipohabi['descripcion_habitacion']?>"
                        >
                      <?= $tipohabi['codigo'];?>
                      </a>
                      <?php
                    }
                  ?>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="padding:0;">
        <div class="row-fluid products-list" style="overflow:auto;">
          <?php 
            $anchop = $dias*44; 
           ?>
          <div class="col-sm-11 col-sm-offset-1" style="width: <?=$anchop?>px;padding:2px;height: 26px;">
            <?php 
              for ($i = 0; $i <= $dias; $i++) {
                $fecha      = strtotime ( '+'.$i.'day',strtotime($fechaini)); ?>
                  <div class="col-sm-1 btn btn-warning btn-sm" style="width: 40px;border-radius: 0px;padding:1px" title="<?= date('Y-m-d',$fecha)?>">
                    <?=date ('d', $fecha );?>
                  </div>
                <?php
              } 
            ?>   
          </div>                
          <div class="col-sm-1" style="padding-left:2px;padding-right: 0">
            <?php 
            foreach ($rooms as $room) { ?>
              <button 
                style="width: 100%;padding:1px;margin-bottom: 1px;border-radius: 0" 
                class="btn btn-success product-item" 
                type="button" 
                title="<?=$room['descripcion_habitacion']?>"
                category="<?=$room['tipo_hab']?>"
              >
                <?=$room['tipo_hab'].' '.$room['numero_hab']?>
              </button>
              <?php 
            }
            ?>      
          </div>
          <div class="col-sm-11" style="padding-left:2px">
            <?php 
              foreach ($rooms as $room) { 
                $numero = $room['numero_hab']; 
                $mmto   = $room['mantenimiento']; 
                ?>
                <div class="row product-item" category="<?=$room['tipo_hab'];?>" style="width: <?=$anchop?>px;margin-left:0px;">
                  <?php 
                  for ($i = 0; $i <= $dias; $i++) {
                    $fecha      = strtotime ( '+'.$i.'day' , strtotime ( $fechaini ) ) ;
                    $fechabusca = date ('Y-m-d' , $fecha );
                    $estadias   = $hotel->buscaEstadia($fechabusca,$numero);
                    if(count($estadias)==0){
                      $izq = 42 * $i ;                      
                      if($mmto==1){
                        ?>                                              
                          <div class="col-sm-1 libre mmto"></div>
                        <?php 
                      }else{
                        ?>                                              
                        <div class="col-sm-1 libre"></div>
                      <?php 
                      }
                    }else{
                      $izq  = 42 * $i;
                      $alto = 1;
                      ?>
                        <div class="col-sm-1 ocupada">
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

                            $desde = $estadia['fecha_llegada'];
                            $hasta = $estadia['fecha_salida'];                            
                            $diasEs = (strtotime($hasta) - strtotime($desde)) /86400 ;
                            $ancho = (40 * $diasEs)-2;
                            if($estadia['estado']<>"SA" && $estadia['estado']<>"CX" ){
                          ?>
                            <a 
                              type="button" 
                              style="padding:2px 12px;margin-bottom: 1px;height: <?=$altoh?>px;width:<?=$ancho?>px;margin-top:<?=$alto?>px;margin-left:20px;z-index:20;display: block;border: 1px solid #000A;position:absolute;border-radius: 0;font-size:10px;color:#000;overflow: hidden;font-weight: 600" 
                              class="info btn <?=$color?> reserva" 
                              title="" 
                              draggable="true" 
                              onclick="muestraReserva(this)"
                              reserva="<?=$estadia['num_reserva']?>"
                              estado="<?=$estadia['estado']?>"> 
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

<script>
    let ancho=screen.width;
    let alto=screen.height;
    forecast = document.querySelector('.products-list');
    console.log(alto);
    forecast.style.height = (alto-268)+'px';
  </script>

