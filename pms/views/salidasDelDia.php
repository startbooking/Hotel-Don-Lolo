<?php
$reservas = $hotel->getSalidasDia(FECHA_PMS, 2, "CA");
?>

<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?= CTA_DEPOSITO ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="salidasDelDia">
            <h3 class="w3ls_head tituloPagina"> <i style="color:black;font-size:36px;" class="fa fa-home"></i> Salidas Pendientes del Dia </h3>
          </div>
          <div class="col-lg-6" style="text-align:right;">
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="table-responsive">
          <table id="example1" class="table modalTable table-bordered">
            <thead>
              <tr class="warning" style="font-weight: bold">
                <td>Hab.</td>
                <td style="text-align:center;">Huesped</td>
                <td style="text-align:left;">Compañia</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td>
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
                  $nitcia    = '222.222';
                } else {
                  $cias      = $hotel->getBuscaCia($reserva['id_compania']);
                  if (count($cias) <> 0) {
                    $nombrecia = $cias[0]['empresa'];
                    $nitcia    = $cias[0]['nit'] . '-' . $cias[0]['dv'];
                  }
                }
              ?>
                <tr style='font-size:12px'>
                  <td>
                    <?php echo $reserva['num_habitacion'] ?></span>
                  </td>
                  <td>
                    <span class="btn btn-primary" style="padding:1px 4px; font-size:12px;font-weight: bold;">
                      <?php echo substr($reserva['nombre_completo'], 0, 35); ?>
                    </span>
                    <?php
                    $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                    if (count($acompanas) > 0) {
                      foreach ($acompanas as $key => $acompana) { ?>
                        <span class="btn btn-info" style="padding:1px 4px; margin-left:15px;margin-top:3px;font-size:10px;font-weight: bold;">
                          <?php echo substr($acompana['nombre_completo'], 0, 35); ?>
                        </span>
                    <?php
                      }
                    }
                    ?>                    
                  </td>
                  <td><?php echo $nombrecia; ?></td>
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <td style="text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
                  <td style="padding:2px;width: 13%">
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                        <ul class="nav navbar-nav" style="margin :0;font-weight: bold;">
                          <li class="dropdown dropdownMenu pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ficha Estadia<span class="caret" style="margin-left:10px"></span></a>
                            <ul class="dropdown-menu submenu" style="float:left;margin-left:none;top:40px;">
                              <!-- <li>
                                <a data-toggle="modal" data-target="#myModalAcompanantesReserva" data-id="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-nombre="<?php echo $reserva['nombre_completo'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" data-llegada="<?php echo $reserva['fecha_llegada'] ?>" data-salida="<?php echo $reserva['fecha_salida'] ?>" data-noches="<?php echo $reserva['dias_reservados'] ?>" data-hombres="<?php echo $reserva['can_hombres'] ?>" data-mujeres="<?php echo $reserva['can_mujeres'] ?>" data-ninos="<?php echo $reserva['can_ninos'] ?>" data-tipo="<?php echo $reserva['tipo_reserva'] ?>" data-tarifa="<?php echo descripcionTarifa($reserva['tarifa']) ?>" data-valor="<?php echo $reserva['valor_diario'] ?>" data-observaciones="<?php echo $reserva['observaciones'] ?>">
                                  <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                </a>
                              </li> -->
                              <li>
                                <a data-toggle="modal" data-id="<?php echo $reserva['num_reserva'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" onclick="imprimirRegistro(<?= $reserva['num_reserva'] ?>,<?= $reserva['causar_impuesto'] ?>)">
                                  <i class="fa fa-book" aria-hidden="true"></i>
                                  Imprimir Registro Hotelero</a>
                              </li>
                              <!-- 
                              <li>
                                <a data-toggle="modal" data-target="#myModalModificaEstadia" data-id="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-nombre="<?php echo $reserva['nombre_completo'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" data-llegada="<?php echo $reserva['fecha_llegada'] ?>" data-salida="<?php echo $reserva['fecha_salida'] ?>" data-noches="<?php echo $reserva['dias_reservados'] ?>" data-hombres="<?php echo $reserva['can_hombres'] ?>" data-mujeres="<?php echo $reserva['can_mujeres'] ?>" data-ninos="<?php echo $reserva['can_ninos'] ?>" data-tarifa="<?php echo descripcionTarifa($reserva['tarifa']) ?>" data-valor="<?php echo $reserva['valor_reserva'] ?>" data-observaciones="<?php echo $reserva['observaciones'] ?>">
                                  <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Estadia</a>
                              </li>
                              <?php
                              if ($reserva['fecha_llegada'] == FECHA_PMS) { ?>
                                <li>
                                  <a data-toggle="modal" data-target="#myModalAnulaIngreso" data-id="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" data-llegada="<?php echo $reserva['fecha_llegada'] ?>" data-salida="<?php echo $reserva['fecha_salida'] ?>" data-noches="<?php echo $reserva['dias_reservados'] ?>" data-hombres="<?php echo $reserva['can_hombres'] ?>" data-mujeres="<?php echo $reserva['can_mujeres'] ?>" data-ninos="<?php echo $reserva['can_ninos'] ?>" data-tarifa="<?php echo descripcionTarifa($reserva['tarifa']) ?>" data-valor="<?php echo $reserva['valor_reserva'] ?>" data-observaciones="<?php echo $reserva['observaciones'] ?>">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Anular Ingreso</a>
                                </li>
                              <?php
                              }
                              ?> -->
                              <!-- <?php
                              if ($reserva['num_habitacion'] <> CTA_DEPOSITO) { ?>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" href="#myModalCambiaHabitacion">
                                    <i class="fa fa-clone" aria-hidden="true"></i>
                                    Cambiar Habitacion</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" href="#myModalCambiaTarifa">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    Cambiar Tarifa</a>
                                </li>
                              <?php
                              }
                              ?> -->
                              <li>
                                <a data-toggle="modal" data-id="<?php echo $reserva['id_huesped'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-nombre="<?php echo $reserva['nombre_completo'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" href="#myModalInformacionHuesped">
                                  <i class="fa fa-user-md" aria-hidden="true"></i>
                                  Perfil Huesped</a>
                              </li>
                              <!-- <li>
                                <a data-toggle="modal" data-idres="<?php echo $reserva['num_reserva'] ?>" data-idcia="<?php echo $reserva['id_compania'] ?>" data-idcentro="<?php echo $reserva['idCentroCia'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-nombre="<?php echo $reserva['nombre_completo'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" data-nombrecia="<?php echo $nombrecia ?>" data-nitcia="<?php echo $nitcia ?>" href="#myModalAsignarCompania">
                                  <i class="fa fa-window-restore" aria-hidden="true"></i>
                                  Asignar Compañia</a>
                              </li>
                              <?php
                              if ($reserva['id_compania'] != 0) { ?>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $reserva['num_reserva'] ?>" data-idhue="<?php echo $reserva['id_huesped'] ?>" data-idcia="<?php echo $reserva['id_compania'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-nombre="<?php echo $reserva['nombre_completo'] ?>" data-impto="<?php echo $reserva['causar_impuesto'] ?>" href="#myModalInformacionCompania">
                                    <i class="fa fa-industry" aria-hidden="true"></i>
                                    Datos Compañia</a>
                                </li>
                              <?php
                              }
                              ?> 
                              <li id="cambiaHuesped" style="display: none">
                                <a data-toggle="modal" data-target="#myModalReasignarHuesped" data-reserva="<?php echo $reserva['num_reserva'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-llegada="<?php echo $reserva['fecha_llegada'] ?>" data-salida="<?php echo $reserva['fecha_salida'] ?>" data-noches="<?php echo $reserva['dias_reservados'] ?>" data-hombres="<?php echo $reserva['can_hombres'] ?>" data-mujeres="<?php echo $reserva['can_mujeres'] ?>" data-ninos="<?php echo $reserva['can_ninos'] ?>" data-tipo="<?php echo $reserva['tipo_reserva'] ?>" data-tarifa="<?php echo descripcionTarifa($reserva['tarifa']) ?>" data-valor="<?php echo $reserva['valor_diario'] ?>" data-observaciones="<?php echo $reserva['observaciones'] ?>">
                                  <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                </a>
                              </li>
                              -->
                              <li>
                                <a data-toggle="modal" data-id="<?php echo $reserva['num_reserva'] ?>" data-cia="<?php echo $reserva['id_compania'] ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']) ?>" data-nrohab="<?php echo $reserva['num_habitacion'] ?>" data-apellido1="<?php echo $reserva['apellido1'] ?>" data-apellido2="<?php echo $reserva['apellido2'] ?>" data-nombre1="<?php echo $reserva['nombre1'] ?>" data-nombre2="<?php echo $reserva['nombre2'] ?>" data-nombrecia="<?php echo $nombrecia ?>" data-llegada="<?php echo $reserva['fecha_llegada'] ?>" data-salida="<?php echo $reserva['fecha_salida'] ?>" data-noches="<?php echo $reserva['dias_reservados'] ?>" data-nitcia="<?php echo $nitcia ?>" data-observa="<?php echo $reserva['observaciones'] ?>" href="#myModalAdicionaObservaciones">
                                  <i class="fa fa-commenting-o" aria-hidden="true"></i>
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
      </div>
    </div>
  </section>
</div>