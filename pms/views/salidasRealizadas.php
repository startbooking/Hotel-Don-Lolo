
<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="salidasRealizadas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px" class="fa fa-sign-out"></i> Salidas Realizadas </h3>
          </div>
          <div class="col-lg-6" style="text-align:right;">
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="datos_ajax_delete"></div>
        <div class='table-responsive'>
          <table id="example1" class="table table-bordered">
            <thead>
              <tr class="warning" style="font-weight: bold">
                <!-- <td>Reserva</td> -->
                <td>Hab.</td>
                <td>Huesped</td>
                <td>Compañia</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noches</td>
                <td>Hombres</td>
                <td>Mujeres</td>
                <!-- <td>Niños</td> -->
                <td style="text-align:center;">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($reservas as $reserva) { 
                if(empty($reserva['id_compania'])){
                  $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                  $nitcia    = '';
                }else{
                  $cias      = $hotel->getBuscaCia($reserva['id_compania']);
                  $nombrecia = $cias[0]['empresa'];
                  $nitcia    = $cias[0]['nit'].'-'.$cias[0]['dv'];
                }
                ?>
                <tr style='font-size:12px'>
                  <!-- <td><?php echo $reserva['num_reserva']?></td> -->
                  <td><?php echo $reserva['num_habitacion']; ?></td>
                  <td style="width:50px;"> 
                    <span class="btn btn-primary" style="padding:1px 4px; font-size:12px;font-weight: bold;">
                      <?php echo substr($reserva['nombre_completo'],0,35); ?>
                    </span>
                    <?php
                      $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                      if (count($acompanas) > 0) {
                        foreach ($acompanas as $key => $acompana) { ?>
                          <span class="btn btn-info" style="padding:1px 4px; margin-left:15px;margin-top:3px;font-size:10px;font-weight: bold;">
                            <?php echo substr($acompana['nombre_completo'],0,35); ?>                            
                          </span>              
                          <?php
                        }
                      }
                    ?>
                  </td>
                  <td><?php echo substr($nombrecia,0,50); ?></td>
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <td style="padding:3px;width: 12%">
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                        <ul class="nav navbar-nav" style="margin :0">
                          <li class="dropdown dropdownMenu pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" 
                            style ="padding:3px 5px;font-weight: bold;color:#000">                            
                            Ficha Estadia<span class="caret" style="margin-left:10px;"></span></a>
                            <ul class="dropdown-menu submenu" style="float:left;margin-left:none;">
                              <li>
                                <a 
                                  data-toggle        ="modal" 
                                  href               ="#myModalAnularSalida"
                                  data-id            ="<?php echo $reserva['num_reserva']?>" 
                                  data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion'])?>" 
                                  data-nrohab        ="<?php echo $reserva['num_habitacion']?>" 
                                  data-nombre        ="<?php echo $reserva['nombre_completo']?>" 
                                  data-impto         ="<?php echo $reserva['causar_impuesto']?>" 
                                  data-llegada       ="<?php echo $reserva['fecha_llegada']?>" 
                                  data-salida        ="<?php echo $reserva['fecha_salida']?>" 
                                  data-noches        ="<?php echo $reserva['dias_reservados']?>" 
                                  data-hombres       ="<?php echo $reserva['can_hombres']?>" 
                                  data-mujeres       ="<?php echo $reserva['can_mujeres']?>" 
                                  data-ninos         ="<?php echo $reserva['can_ninos']?>" 
                                  data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa'])?>" 
                                  data-valor         ="<?php echo $reserva['valor_reserva']?>" 
                                  data-observaciones ="<?php echo $reserva['observaciones']?>"                                        >
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Reactivar Estadia</a> 
                              </li>
                              <li>  
                                <a 
                                  data-toggle    ="modal" 
                                  data-id        ="<?php echo $reserva['num_reserva']?>" 
                                  data-apellido1 ="<?php echo $reserva['apellido1']?>" 
                                  data-apellido2 ="<?php echo $reserva['apellido2']?>" 
                                  data-nombre1   ="<?php echo $reserva['nombre1']?>" 
                                  data-nombre2   ="<?php echo $reserva['nombre2']?>" 
                                  onclick        ="imprimirRegistro(<?=$reserva['num_reserva']?>,<?= $reserva['causar_impuesto']?>)" 
                                  >
                                  <i class="fa fa-book" aria-hidden="true"></i>Imprimir Registro Hotelero
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </nav>                                                  
                  </td>
                </tr>
                <?php 
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
