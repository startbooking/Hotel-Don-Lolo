<?php
require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];

$hoy = substr(FECHA_PMS, 5, 5);

/* $dia = date('d',FECHA_PMS);

echo $dia;
 */
$reservas = $hotel->getHuespedesenCasa(2, 'CA');

?>
  <div class="table-responsive">
    <table id="example1" class="table modalTable table-bordered">
      <thead>
        <tr class="warning" style="font-weight: bold">
          <td>Hab.</td>
          <td></td>
          <td style="text-align:center;">Huesped</td>
          <td style="text-align:center;">Compañia</td>
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
                <span><?php echo $reserva['num_habitacion']; ?></span>                      
              </td>
              <td style="padding:2px;width:7%;">
                <div style="display: flex">
                  <?php
                    if ($reserva['causar_impuesto'] == 2) { ?>
                      <span class="fa-stack fa-xs" title="Sin Impuestos" style="margin-left:5px;cursor:pointer;">
                        <i style="font-size:10px;margin-top: 1px;margin-left: -3px;" class="fa fa-percent fa-stack-1x"></i>
                        <i style="font-size:20px" class="fa fa-ban text-danger"></i>
                      </span>
                      <?php
                    } 
                    if (count($depositos) != 0) { ?>
                      <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                        <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                    }
                    if (!empty($reserva['observaciones'])) { ?>
                      <span 
                        class="fa-stack fa-xs" 
                        title="Observaciones a la Reserva" 
                        style="margin-left:0px;cursor:pointer;" 
                        onclick="verObservaciones(<?php echo $reserva['num_reserva']; ?>,'1')">
                        <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                    }
                    if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
                      <span class="fa-stack fa-xs" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;" >
                        <i style="font-size:20px;color: yellow" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;margin-top: 1px;margin-left: 1px;color:black" class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i> 
                      </span>
                    <?php
                    }
                  ?>
                </div>
              </td>
              <td style="padding:2px;width:50px;">
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
              <td style="padding:2px"><?php echo $nombrecia; ?></td>
              <td style="padding:2px"><?php echo $reserva['fecha_llegada']; ?></td>
              <td style="padding:2px"><?php echo $reserva['fecha_salida']; ?></td>
              <td style="padding:2px;text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
              <td style="padding:2px;text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
              <td style="padding:2px;text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
              <!-- <td style="padding:2px;text-align:center;"><?php echo $reserva['can_ninos']; ?></td> -->
              <td style="padding:2px;text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
              <td style="padding:2px;width: 13%">
                <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                    <ul class="nav navbar-nav" style="margin :0;width: 100%">
                      <li class="dropdown submenu" style="width: 100%">
                        <a 
                          href          ="#" 
                          class         ="dropdown-toggle" 
                          data-toggle   ="dropdown" 
                          role          ="button" 
                          aria-haspopup ="true" 
                          aria-expanded ="false" 
                          style         ="padding:3px 5px;font-weight: bold;color:#000">Ficha Estadia
                            <span class="caret" style="margin-left:5px;"></span>
                        </a>
                        <ul class="dropdown-menu" style="float:left;margin-left:-180px;top:40px;">  
                          <li>
                            <a 
                              data-toggle        ="modal" 
                              data-target        = "#myModalAcompanantesReserva"
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
                              data-idtarifa      ="<?php echo $reserva['tarifa']; ?>" 
                              data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                              data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                              >
                              <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                            </a>
                          </li> 
                          <li>
                            <a 
                              data-toggle    ="modal" 
                              data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                              data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                              data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                              onclick        ="imprimirRegistro(<?php echo $reserva['num_reserva']; ?>,<?php echo $reserva['causar_impuesto']; ?>)" 
                              >
                              <i class="fa fa-book" aria-hidden="true"></i>
                            Imprimir Registro Hotelero</a>
                          </li>
                          <li>
                            <a 
                              data-toggle        ="modal" 
                              data-target        = "#myModalModificaEstadia"
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
                              data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                              data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
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
                                data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                                data-llegada   ="<?php echo $reserva['fecha_llegada']; ?>" 
                                data-salida    ="<?php echo $reserva['fecha_salida']; ?>" 
                                data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                                href           ="#myModalCambiaHabitacion">
                                <i class="fa fa-clone" aria-hidden="true"></i>
                              Cambiar Habitacion</a>
                            </li>  
                            <li>
                              <a  
                                data-toggle    ="modal" 
                                data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                                data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
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
                              data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                              data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                              data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                              data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                              data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                              data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                              href           ="#myModalInformacionHuesped">
                            <i class="fa fa-user-md" aria-hidden="true"></i>
                              Perfil Huesped</a> 
                          </li>
                          <li>
                            <a 
                              data-toggle    ="modal" 
                              data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                              data-idres     ="<?php echo $reserva['num_reserva']; ?>" 
                              data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                              data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                              data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                              data-idcen     ="<?php echo $reserva['idCentroCia']; ?>" 
                              data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                              data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                              data-nombrecia ="<?php echo $nombrecia; ?>" 
                              data-nitcia    ="<?php echo $nitcia; ?>" 
                              href           ="#myModalAsignarCompania">
                              <i class="fa fa-window-restore" aria-hidden="true"></i>
                            Asignar Compañia</a>
                          </li>
                          <?php
                            if ($reserva['id_compania'] != 0) { ?>
                              <li>
                                <a 
                                  data-toggle    ="modal" 
                                  data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                  data-idhue     ="<?php echo $reserva['id_huesped']; ?>" 
                                  data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                                  data-idcen     ="<?php echo $reserva['idCentroCia']; ?>" 
                                  data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                                  data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                                  href           ="#myModalInformacionCompania">
                                  <i class="fa fa-industry" aria-hidden="true"></i>
                                Datos Compañia</a>
                              </li>
                              <?php
                            }
                            if ($reserva['fecha_llegada'] == FECHA_PMS && $tipo == 1) { ?>
                              <li id="cambiaHuesped">
                                <a 
                                  data-toggle        ="modal" 
                                  data-target        = "#myModalReasignarHuesped"
                                  data-reserva       ="<?php echo $reserva['num_reserva']; ?>" 
                                  data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                  data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                  data-apellido1     ="<?php echo $reserva['apellido1']; ?>" 
                                  data-apellido2     ="<?php echo $reserva['apellido2']; ?>" 
                                  data-nombre1       ="<?php echo $reserva['nombre1']; ?>" 
                                  data-nombre2       ="<?php echo $reserva['nombre2']; ?>"  
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
                              data-cia       ="<?php echo $reserva['id_compania']; ?>" 
                              data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                              data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                              data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                              data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                              data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                              data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                              data-nombrecia ="<?php echo $nombrecia; ?>" 
                              data-llegada   ="<?php echo $reserva['fecha_llegada']; ?>" 
                              data-salida    ="<?php echo $reserva['fecha_salida']; ?>" 
                              data-noches    ="<?php echo $reserva['dias_reservados']; ?>" 
                              data-nitcia    ="<?php echo $nitcia; ?>" 
                              data-observa   ="<?php echo $reserva['observaciones']; ?>" 
                              href           ="#myModalAdicionaObservaciones">
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
  <table id="tablaReservas" class="table modalTable table-bordered" style="display: none">
    <thead>
      <tr class="warning" style="font-weight: bold">
        <td>Nro Hab.</td>
        <td>Tipo Hab.</td>
        <td align="center">Huesped</td>
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
            <td><?php echo $reserva['tipo_habitacion']; ?></td>
            <td><?php echo $reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']; ?></td>
            <td><?php echo $reserva['fecha_llegada']; ?></td>
            <td><?php echo $reserva['fecha_salida']; ?></td>
            <td align="center"><?php echo $reserva['dias_reservados']; ?></td>
            <td align="center"><?php echo $reserva['can_hombres']; ?></td>
            <td align="center"><?php echo $reserva['can_mujeres']; ?></td>
            <td align="center"><?php echo $reserva['can_ninos']; ?></td>
            <td align="right"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
          </tr>
          <?php
}
?>
    </tbody>
  </table>



