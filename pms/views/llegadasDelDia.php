<?php 
  $hoy    = substr(FECHA_PMS,5,5);
?>

    <div class="content-wrapper" id="pantallaLlegadas"> 
      <section class="content" style="margin-bottom: 40px">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
                <input type="hidden" name="ubicacion" id="ubicacion" value="llegadasDelDia.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-sign-in" aria-hidden="true"></i> Llegadas del Dia </h3>
              </div>
            </div>
          </div>
          <div class="panel-body" id="paginaLlegadas">
            <div class="table-responsive">  
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning" style="font-weight: bold">
                    <td>Reserva Nro</td>
                    <td>Nro Hab.</td>
                    <td style="text-align:center;">Huesped</td>
                    <td>Compañia</td>
                    <td>Llegada</td>
                    <td>Salida</td>
                    <td>Noc</td>
                    <td>Hom</td>
                    <td>Muj</td>
                    <!-- <td>Niño</td> -->
                    <td style="text-align:center">Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($reservas as $reserva) {
                    $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                    if ($reserva['id_compania'] == 0) {
                        $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                        $nitcia = '';
                    } else {
                        $cias = $hotel->getBuscaCia($reserva['id_compania']);
                        $nombrecia = $cias[0]['empresa'];
                        $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
                    }
                    ?>
                    <tr style='font-size:12px'>
                      <td style="padding:2px">
                        <div style="display: flex">
                          <span><?php echo $reserva['num_reserva']; ?></span>
                          <?php
                            if ($reserva['causar_impuesto'] == 2) { ?>
                              <span class="fa-stack fa-xs" title="Sin Impuestos" style="margin-left:5px;cursor:pointer;">
                                <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                                <i style="font-size:20px" class="fa fa-ban text-danger"></i>
                              </span>
                              <?php
                            }
                            if (count($depositos) != 0) { ?>
                              <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                                <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                                <i style="font-size:10px;margin-top: 1px;margin-left: 0px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                              </span>
                              <?php
                            }
                            if (!empty($reserva['observaciones'])) { ?>
                              <span class="fa-stack fa-xs" 
                                title="Observaciones a la Reserva" 
                                style="margin-left:0px;cursor:pointer;" 
                                data-toggle  ="modal"
                                data-target  = "#myModalVerObservaciones"
                                data-reserva ="<?php echo $reserva['num_reserva']; ?>" 
                                data-estado  ="1" >
                                <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                                <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                              </span>
                              <?php
                            }
                            if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
                              <span class="fa-stack fa-xs" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;" >
                                <i style="font-size:20px;color: yellow" class="fa fa-circle fa-stack-2x"></i>                
                                <i style="font-size:10px;margin-top: 1px;margin-left: 0px;color:black" class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i> 
                              </span>
                            <?php
                            }
                          ?>
                        </div>
                      </td>
                      <td style="padding:2px"><?php echo $reserva['num_habitacion']; ?></td>
                      <td style="padding:2px">
                        <span class="badge" style="background: #20b2aa91;padding: 2px 6px 0px 11px;">
                          <label for="" class="control-label" style="text-align: left;color:#000">
                            <?php echo $reserva['nombre_completo']; ?>
                          </label>
                        </span>
                        <?php
                        $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                        if (count($acompanas) > 0) {
                          foreach ($acompanas as $key => $acompana) { ?>
                            <span class="badge" style="background: #3faa558a;margin-top:2px;margin-left:15px;font-size:12px">
                              <label for="" class="control-label" style="font-size:11px;text-align: left;padding: 5px 0px 2px 2px;color:#000"><?php echo $acompana['nombre_completo']; ?>
                              </label>
                            </span>
                            <?php
                          }
                        }
                        ?>
                      </td>
                      <td style="padding:2px;"><?php echo $nombrecia; ?></td>
                      <td style="padding:2px">
                        <?php echo $reserva['fecha_llegada']; ?></td>
                      <td style="padding:2px">
                        <?php echo $reserva['fecha_salida']; ?></td>
                      <td style="padding:2px;text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                      <td style="padding:2px;text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                      <td style="padding:2px;text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                      <!-- 
                      <td style="padding:2px;text-align:center;"><?php echo $reserva['can_ninos']; ?></td>
                      <td style="padding:2px">
                      <?php echo estadoReserva($reserva['estado']); ?></td> -->
                      <td style="padding:2px;width: 13%">
                        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                            <ul class="nav navbar-nav" style="margin :0">
                              <li class="dropdown dropdownMenu pull-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ficha Estadia<span class="caret" style="margin-left:10px"></span></a>
                                <ul class="dropdown-menu submenu" style="float:left;margin-left:none;top:40px;">  
                                  <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalRegistraReserva"
                                      data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-tipohab       ="<?php echo $hotel->getNombreTipoHabitacion2($reserva['tipo_habitacion']); ?>" 
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
                                      data-valor         ="<?php echo $reserva['valor_reserva']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-sign-out" aria-hidden="true"></i>
                                      Ingresar Reserva</a>
                                  </li>
                                  <li id="cambiaHuesped">
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalReasignarHuesped"
                                      data-reserva       ="<?php echo $reserva['num_reserva']; ?>" 
                                      >
                                      <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                    </a>
                                  </li>            
                                  <li>
                                    <a 
                                      data-toggle="modal" 
                                      data-target = "#myModalAcompanantesReserva"
                                      data-id="<?php echo $reserva['num_reserva']; ?>" 
                                      data-nombre="<?php echo $reserva['nombre_completo']; ?>"  
                                      >
                                      <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                    </a>
                                  </li> 
                                  <li>
                                    <a data-toggle="modal"                                       
                                      onclick="imprimirRegistro(<?php echo $reserva['num_reserva']; ?>,<?php echo $reserva['causar_impuesto']; ?>)"  
                                      >
                                      <i class="fa fa-book" aria-hidden="true"></i>
                                    Imprimir Registro Hotelero</a>
                                  </li> 
                                  <li>
                                    <a data-toggle="modal" 
                                      data-target = "#myModalCancelaReserva"
                                      data-id="<?php echo $reserva['num_reserva']; ?>" 
                                      data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                      >
                                      <i class="fa fa-times" aria-hidden="true"></i>
                                      Cancelar Reserva
                                    </a>
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle="modal" 
                                      data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                                      data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                                      href           ="#myModalModificaPerfilHuesped">
                                      <i class="fa fa-user-md" aria-hidden="true"></i>Perfil Huesped
                                    </a>
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle="modal" 
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
            <div id="imprimeRegistroHotelero"></div>            
          </div>
        </div>
      </section>
    </div>
