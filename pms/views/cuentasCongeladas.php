    <div class="content-wrapper"> 
      <section class="content" style="height: 780px" id="listado">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="cuentasCongeladas">
                <h3 class="w3ls_head tituloPagina"> <i class="fa fa-snowflake-o icon" style="font-size:36px;color:black" ></i> Cuentas Congeladas</h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning" style="font-weight: bold">
                    <td>Nro Hab.</td>
                    <!-- <td>Tipo Hab.</td> -->
                    <td>Huesped</td>
                    <td>Tarifa</td>
                    <td>Llegada</td>
                    <td>Salida</td>
                    <td style="text-align:center;">Consumos</td>
                    <td style="text-align:center;">Impuesto</td>
                    <td style="text-align:center;">Pagos</td>
                    <td style="text-align:center;">Saldo</td>
                    <td style="text-align:center;">Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  // print_r($reservas);
                  foreach ($reservas as $reserva) {
                      $consumos = $hotel->getConsumosReserva($reserva['num_reserva']);
                      if (count($consumos) == 0) {
                          $consumos[0]['cargos'] = 0;
                          $consumos[0]['imptos'] = 0;
                          $consumos[0]['pagos'] = 0;
                      }
                      ?> 
                    <tr style='font-size:12px'> 
                      <td>
                        <div style="display: flex">
                          <?php
                              echo $reserva['num_habitacion'];
                      if ($reserva['causar_impuesto'] == 2) { ?>
                              <span class="fa-stack fa-xs" title="Sin Impuestos" style="margin-left:5px;cursor:pointer;">
                                <i style="font-size:10px;margin-top: 1px;margin-left: -3px;" class="fa fa-percent fa-stack-1x"></i>
                                <i style="font-size:20px" class="fa fa-ban text-danger"></i>
                              </span>
                              <?php
                      }
                      if (!empty($reserva['observaciones'])) { ?>
                              <span class="fa-stack fa-xs" title="Observaciones a la Reserva" style="margin-left:0px;cursor:pointer;" onclick="verObservaciones(<?php echo $reserva['num_reserva']; ?>,'1')">
                                <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                                <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                              </span>
                              <?php
                      }
                      ?>
                        </div>

                        <?php
                      ?>
                      </td>
                      <td><?php echo $reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']; ?></td>
                      <td><?php echo number_format($reserva['valor_diario'], 2); ?></td>
                      <td><?php echo $reserva['fecha_llegada']; ?></td> 
                      <td><?php echo $reserva['fecha_salida']; ?></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['cargos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['imptos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['pagos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['cargos'] + $consumos[0]['imptos'] - $consumos[0]['pagos'], 2); ?></td>
                      
                      <td style="padding:3px;width: 12%">
                        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                            <ul class="nav navbar-nav" style="margin :0;width:100%">
                              <li class="dropdown submenu" style="width:100%">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 700;color:#000">Facturacion<span class="caret" style="margin-left:10px;"></span></a>
                                <ul class="dropdown-menu" style="float:left;margin-left:-180px;top:40px;">                                   
                                  <li>
                                    <a 
                                      onclick="regresaCasa('<?php echo $reserva['num_reserva']; ?>')"
                                      >
                                      <i class="fa-solid fa-house"></i>
                                      <!-- <i class="fa fa-pencil-square" aria-hidden="true"></i> -->
                                      Regresar a Casa</a>
                                  </li>
                                  <!-- <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalModificaCongelada"
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
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-idtarifa      ="<?php echo $reserva['tarifa']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-valor         ="<?php echo $reserva['valor_reserva']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Estadia</a>
                                  </li> -->
                                  <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalInformacionReserva"
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
                                      data-tipo          ="<?php echo $reserva['tipo_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      data-usuario       ="<?php echo $reserva['usuario']; ?>" 
                                      data-fechacrea     ="<?php echo $reserva['fecha_ingreso']; ?>" 
                                      >
                                      <i class="fa fa-address-card-o" aria-hidden="true"></i>Informacion Estadia</a>
                                  </li>
                                  <li>
                                    <a data-toggle="modal" 
                                      data-id="<?php echo $reserva['id_huesped']; ?>" 
                                      data-apellido1="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2="<?php echo $reserva['nombre2']; ?>" 
                                      data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                      data-impto="<?php echo $reserva['causar_impuesto']; ?>" 
                                      href="#myModalInformacionHuesped">
                                    <i class="fa fa-user-md" aria-hidden="true"></i>
                                     Perfil Huesped</a> 
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle="modal" 
                                      data-id="<?php echo $reserva['num_reserva']; ?>" 
                                      data-idhue="<?php echo $reserva['id_huesped']; ?>" 
                                      data-idcia="<?php echo $reserva['id_compania']; ?>" 
                                      data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                      data-impto="<?php echo $reserva['causar_impuesto']; ?>" 
                                      href="#myModalInformacionCompania">
                                      <i class="fa fa-industry" aria-hidden="true"></i>
                                      Datos Compañia</a>
                                  </li>
                                  <li> 
                                    <a 
                                      data-toggle  ="modal" 
                                      data-target  = "#myModalEstadoCuenta"
                                      data-id      ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-nombre  ="<?php echo $reserva['nombre_completo']; ?>" 
                                      data-impto   ="<?php echo $reserva['causar_impuesto']; ?>" 
                                      data-nrohab  ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-tipohab ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>"
                                      >
                                      <i class="fa fa-book" aria-hidden="true"></i>
                                    Estado de Cuenta</a>
                                  </li> 
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                                      data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                                      onclick        ="movimientosCongelada(<?php echo $reserva['num_reserva']; ?>)" 
                                      href           ="">
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                     Facturacion</a>  
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
      <section class="container-fluid" style="height: 900px" id="movimiento" style="display:none;margin-top:20px"></section>
    </div>
