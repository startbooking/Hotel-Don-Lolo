<?php 
  $hoy    = substr(FECHA_PMS,5,5);  
?>

<div class="content-wrapper" id="pantallaenCasa"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6 col-md-6"> 
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="encasa">
            <h3 class="w3ls_head tituloPagina fa-2x"> <i style="color:black;" class="fa fa-home"></i> Huespedes En Casa </h3>
          </div>
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a type="button" class="btn btn-success btnAdiciona" href="llegadasDelDia"> 
              <i class="fa fa-briefcase" aria-hidden="true"></i>
              Llegadas Del Dia
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablaReservas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
          </div>
        </div> 
      </div>
      <div class="panel-body" id="paginaenCasa">
        <div class="table-responsive">
          <table id="example1" class="table modalTable table-condensed">
          
            <thead>
              <tr class="warning" style="font-weight: bold">
                <td style="">Hab.</td>
                <!-- <td></td> -->
                <td style="text-align:center;">Huesped</td>
                <td style="text-align:left;">Compañia</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td> 
                <!-- <td>Niñ</td> -->
                <td>Tarifa</td>
                <td style="text-align:center;">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($reservas as $reserva) {
                  $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                  if ($reserva['id_compania'] == 0) {
                    $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                    $nitcia = '222.222.222';
                  } else {
                    $cias = $hotel->getBuscaCia($reserva['id_compania']);
                    if (count($cias) != 0) {
                        $nombrecia = $cias[0]['empresa'];
                        $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
                    }
                  }
                  ?>
                  <tr style='font-size:12px'>
                    <td>
                      <div style="display: flex">
                        <span><?php echo $reserva['num_habitacion']; ?></span>                      
                        <?php
                          if ($reserva['causar_impuesto'] == 2) { ?>
                            <span class="btn btn-default faReservas" title="Sin Impuestos" style="padding:2px;">
                              <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                              <i style="font-size:12px" class="fa fa-ban text-danger"></i>
                            </span>
                            <?php
                          }
                          if (count($depositos) != 0) { ?>
                            <span 
                              class="btn btn-success faReservas" 
                                title="Reserva con Depositos" 
                                onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">                          
                                <i class="fa fa-usd fa-stack-1x fa-inverse "></i>
                            </span>
                            <?php
                          } 
                          if (!empty($reserva['observaciones'])) { ?>
                            <span class="btn btn-info faReservas" 
                              title="Observaciones a la Reserva" 
                              data-toggle  ="modal"
                              data-target  = "#myModalVerObservaciones"
                              data-reserva ="<?php echo $reserva['num_reserva']; ?>" 
                              data-estado  ="1" >
                              <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                            </span>
                            <?php
                          }                        
                          if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
                            <span class="btn btn-warning faReservas" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;" >
                              <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i> 
                            </span>
                          <?php
                          }
                        ?>
                      </div>
                    </td>
                    <td style="width:70px;">
                      <span class="btn btn-primary" style="padding:1px 4px; font-size:12px;font-weight: bold;">
                        <?php echo substr($reserva['nombre_completo'],0,35); ?></span>
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
                    <td style="padding:2px"><?php echo substr($nombrecia,0,30); ?></td>
                    <td style="padding:2px"><?php echo $reserva['fecha_llegada']; ?></td>
                    <td style="padding:2px"><?php echo $reserva['fecha_salida']; ?></td>
                    <td style="padding:2px;text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                    <td style="padding:2px;text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                    <td style="padding:2px;text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                    <td style="padding:2px;text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
                    <td style="padding:2px;width: 13%">
                      <nav class="navbar navbar-default" id="menuFicha" style="margin-bottom: 0px;min-height:0px;">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                          <ul class="nav navbar-nav" style="margin :0;width: 100%">
                            <li class="dropdown " style="width: 100%">
                              <a id="menuFicha"
                                href          ="#"  
                                class         ="dropdown-toggle" 
                                data-toggle   ="dropdown" 
                                role          ="button" 
                                aria-haspopup ="true" 
                                aria-expanded ="false" 
                                style         ="padding:3px 5px;font-weight: bold;color:#000">Ficha Estadia
                                  <span class="caret" style="margin-left:5px;"></span>
                              </a>
                              <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">  
                                <li>
                                  <a 
                                    data-toggle        ="modal"
                                    data-target        = "#myModalAcompanantesReserva"
                                    data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nombre        ="<?php echo $reserva['nombre_completo']; ?>" 
                                    >
                                    <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle    ="modal" 
                                    onclick        ="imprimirRegistro(<?php echo $reserva['num_reserva']; ?>,<?php echo $reserva['causar_impuesto']; ?>)" 
                                    >
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                  Imprimir Registro Hotelero</a>
                                </li>
                                <?php 
                                  if(TRA==1){ ?>
                                    <li>
                                  <a 
                                    data-toggle    ="modal" 
                                    data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                    onclick        ="enviaTRA(<?php echo $reserva['num_reserva']; ?>,'<?php echo FECHA_PMS; ?>')" 
                                    >
                                    <i class="fa-regular fa-paper-plane"></i>
                                  Envio Tarjeta Registro</a>
                                </li>
                                <?php
                                  }
                                ?>
                                <li>
                                  <a 
                                    data-toggle        ="modal" 
                                    data-target        = "#myModalModificaEstadia"
                                    data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nombre        ="<?php echo $reserva['nombre_completo']; ?>" 
                                    >
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Estadia</a>
                                </li>
                                <?php
                                  if ($reserva['fecha_llegada'] == FECHA_PMS) { ?>
                                    <li>
                                      <a 
                                        data-toggle        ="modal" 
                                        data-target        = "#myModalAnulaIngreso"
                                        data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                        data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                        data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                        data-nombre        ="<?php echo $reserva['nombre_completo']; ?>" 
                                        data-impto         ="<?php echo $reserva['causar_impuesto']; ?>" 
                                        data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                        data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                        data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                        data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                        data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                        data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                        data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                        data-idtarifa      ="<?php echo $reserva['tarifa']; ?>" 
                                        data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                                        data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                        >
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Anular Ingreso</a>
                                    </li>                 
                                  <?php
                                }
                                if ($reserva['num_habitacion'] != CTA_DEPOSITO) { ?>
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                                      href           ="#myModalCambiaHabitacion">
                                      <i class="fa fa-clone" aria-hidden="true"></i>
                                    Cambiar Habitacion</a>
                                  </li>  
                                  <li>
                                    <a  
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-nombre    ="<?php echo $reserva['nombre_completo']; ?>"  
                                      href           ="#myModalCambiaTarifa">
                                      <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    Cambiar Tarifa</a>
                                  </li>    
                                  <?php
                                  }
                                ?>
                                <li>
                                  <a 
                                    data-toggle    ="modal" 
                                    data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                                    data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                                    href           ="#myModalModificaPerfilHuesped">
                                    <i class="fa fa-user-md" aria-hidden="true"></i>
                                    Perfil Huesped</a> 
                                </li>
                                <li>
                                  <a 
                                    data-toggle    ="modal" 
                                    data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                                    data-idres     ="<?php echo $reserva['num_reserva']; ?>" 
                                    data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                                    data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                                    href           ="#myModalAsignarCompania">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                  Asignar Compañia</a>
                                </li>
                                <?php
                                  if ($reserva['id_compania'] != 0) { ?>
                                    <li>
                                      <a 
                                        data-toggle    ="modal" 
                                        data-id        ="<?php echo $reserva['id_compania']; ?>" 
                                        data-empresa   ="<?php echo $nombrecia; ?>" 
                                        href           ="#myModalModificaPerfilCia">                                        
                                        <i class="fa fa-industry" aria-hidden="true"></i>
                                      Datos Compañia</a>
                                    </li>
                                    <?php
                                  }
                                  if ($reserva['fecha_llegada'] == FECHA_PMS) { ?>
                                    <li id="cambiaHuesped">
                                      <a 
                                        data-toggle        ="modal" 
                                        data-target        = "#myModalReasignarHuesped"
                                        data-reserva       ="<?php echo $reserva['num_reserva']; ?>" 
                                        >
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                      </a>
                                    </li>
                                  <?php
                                  }
                                ?>
                                <li>
                                  <a 
                                    data-toggle    ="modal" 
                                    data-id        ="<?php echo $reserva['num_reserva']; ?>"
                                    data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                    data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
                                    data-llegada   ="<?php echo $reserva['fecha_llegada']; ?>" 
                                    data-salida    ="<?php echo $reserva['fecha_salida']; ?>" 
                                    data-noches    ="<?php echo $reserva['dias_reservados']; ?>" 
                                    data-observa   ="<?php echo $reserva['observaciones']; ?>" 
                                    href           ="#myModalAdicionaObservaciones">
                                    <i class="fa-regular fa-comments"></i>
                                  Adicionar Observaciones</a>
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
        <table id="tablaReservas" class="table modalTable table-bordered" style="display: none">
          <thead>
            <tr class="warning" style="font-weight: bold">
              <td>Nro Hab.</td>
              <td style="text-align:center;">Huesped</td>
              <td>Llegada</td>
              <td>Salida</td>
              <td>Noches</td>
              <td>Hombres</td>
              <td>Mujeres</td>
              <td>Niños</td>
              <td>Tarifa</td>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($reservas as $reserva) {
                $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                if ($reserva['id_compania'] == 0) {
                  $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                  $nitcia = '222.222';
                } else {
                  $cias = $hotel->getBuscaCia($reserva['id_compania']);
                  if (count($cias) != 0) {
                    $nombrecia = $cias[0]['empresa'];
                    $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
                  }
                }
                ?>
                <tr style='font-size:12px'>
                  <td>
                    <div style="display: flex">
                      <span><?php echo $reserva['num_habitacion']; ?></span>
                    </div>
                  </td>
                  <td><?php echo $reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']; ?></td>
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_ninos']; ?></td>
                  <td style="text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
