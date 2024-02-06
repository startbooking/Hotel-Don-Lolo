<?php
require '../../../res/php/app_topHotel.php';

extract($_POST);
$hoy = substr(FECHA_PMS, 5, 5);
$reservas = $hotel->getHuespedesenCasa(2, 'CA');

?>

<div class="table-responsive">
  <table id="example1" class="table modalTable table-hover">
    <thead>
      <tr class="warning" style="font-weight: bold">
        <td>Nro Hab.</td>
        <!-- <td></td> -->
        <td>Huesped</td>
        <td>Compañia</td>
        <td>Tarifa</td>
        <td>Llegada</td>
        <td>Salida</td>
        <td style="text-align:center;">Abonos</td>
        <td style="text-align:center;">Saldo</td>
        <td style="text-align:center;">Accion</td>
      </tr>
    </thead> 
    <tbody>
      <?php
    foreach ($reservas as $reserva) {
        if ($reserva['id_compania'] == 0) {
          $nombrecia = 'SIN COMPAÑIA ASOCIADA';
          $nitcia = '';
        } else {
          $cias = $hotel->getBuscaCia($reserva['id_compania']);
          $nombrecia = $cias[0]['empresa'];
          $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
        }

        $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
        $consumos = $hotel->getConsumosReserva($reserva['num_reserva']);
        if (count($consumos) == 0) {
            $consumos[0]['cargos'] = 0;
            $consumos[0]['imptos'] = 0;
            $consumos[0]['pagos'] = 0;
        }
        ?>
        <tr style='font-size:12px'> 
          <td style="width:8%;display: inline-flex;" >
            <?php echo $reserva['num_habitacion']; ?>
          <!-- </td>
          <td style="width: 10%"> -->
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
                  <i style="font-size:10px;margin-top: 1px;margin-left: 5px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                </span>
                <?php
              }
              if (!empty($reserva['observaciones'])) { ?>
                <span class="fa-stack fa-xs" title="Observaciones a la Reserva" style="margin-left:0px;cursor:pointer;" onclick="verObservaciones('<?php echo $reserva['num_reserva']; ?>','1')">
                  <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                  <i style="font-size:10px;margin-top: 1px;margin-left: 5px;" class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                </span>
                <?php
              }
              
        ?>
          </td> 
          <td>
            <label for="" class="huespedPpal">
              <?php echo $reserva['nombre_completo']; ?>
            </label>
            <?php
          $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
        if (count($acompanas) > 0) {
          foreach ($acompanas as $key => $acompana) { ?>
            <span class="badge huespedAcom" style="background: #3faa558a;margin-top:2px;margin-left:15px;font-size:12px">
              <label for="" class="control-label" style="font-size:11px;text-align: left;padding: 5px 0px 2px 2px;color:#000"><?php echo $acompana['nombre_completo']; ?>
              </label>
            </span>
            <?php
          }
        } 
        ?>
          </td>
          <td style="width: 20%"><?php echo $nombrecia; ?></td>
          <td style="width: 7%;text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
          <td style="width: 7%"><?php echo $reserva['fecha_llegada']; ?></td> 
          <td style="width: 7%"><?php echo $reserva['fecha_salida']; ?></td>
          <td style="width: 7%;text-align:right;cursor: pointer;">
            <a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['pagos'], 2); ?></a>
          </td>
          <td style="width: 7%;text-align:right;cursor: pointer;">
            <a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['cargos'] + $consumos[0]['imptos'] - $consumos[0]['pagos'], 2); ?></a>
          </td>
          <td style="padding:3px;width: 13%">
            <nav class="navbar navbar-default " style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                <ul class="nav navbar-nav" style="margin :0;width:100%;">
                  <li class="dropdown" style="margin :0;width:100%;">
                    <a href="#" class="dropdown-toggle aSub" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 700;color:#000">Ficha Facturacion<span class="caret caretSub" ></span></a>
                    <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">  
                      <?php
                      if($vigencia==0){?>
                        <li>
                          <a 
                            data-toggle="modal" 
                            data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                            data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                            data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                            data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                            data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                            data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
                            data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                            onclick        ="movimientosFactura(<?php echo $reserva['num_reserva']; ?>)" 
                            href           ="">
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                            Facturacion</a>  
                        </li>
                        <?php
                      }?>
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
                        <a 
                          data-toggle    ="modal" 
                          data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                          data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                          data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                          data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                          data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                          data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
                          data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                          href           ="#myModalInformacionHuesped">
                          <i class       ="fa fa-user" aria-hidden="true"></i>
                          Datos Huesped</a> 
                      </li>
                      <?php
                      if ($reserva['id_compania'] != 0) { ?>
                        <li>
                          <a 
                            data-toggle    ="modal" 
                            data-idres     ="<?php echo $reserva['num_reserva']; ?>" 
                            data-idhue     ="<?php echo $reserva['id_huesped']; ?>" 
                            data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                            data-idcentro  ="<?php echo $reserva['idCentroCia']; ?>" 
                            data-nombre ="<?php echo $reserva['nombre_completo']; ?>" 
                            data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                            href           ="#myModalInformacionCompania">
                            <i class="fa fa-industry" aria-hidden="true"></i>
                          Datos Compañia</a>
                        </li>
                        <?php
                      }
                      ?>
                      <li>
                        <a 
                          data-toggle    ="modal" 
                          data-idres     ="<?php echo $reserva['num_reserva']; ?>" 
                          data-id        ="<?php echo $reserva['id_compania']; ?>" 
                          data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                          data-idcentro  ="<?php echo $reserva['idCentroCia']; ?>" 
                          data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                          data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                          data-nombre    ="<?php echo $reserva['nombre_completo']; ?>" 
                          data-impto     ="<?php echo $reserva['causar_impuesto']; ?>" 
                          data-nombrecia ="<?php echo $nombrecia; ?>" 
                          data-nitcia    ="<?php echo $nitcia; ?>" 
                          href           ="#myModalAsignarCompania">
                          <i class="fa fa-window-restore" aria-hidden="true"></i>
                        Asignar Compañia</a>
                      </li>                                  
                      <?php
                      if ($reserva['num_habitacion'] != CTA_DEPOSITO) {?>
                        <li>
                          <a 
                            data-toggle="modal" 
                            data-id="<?php echo $reserva['num_reserva']; ?>" 
                            data-apellido1="<?php echo $reserva['apellido1']; ?>" 
                            data-apellido2="<?php echo $reserva['apellido2']; ?>" 
                            data-nombre1="<?php echo $reserva['nombre1']; ?>" 
                            data-nombre2="<?php echo $reserva['nombre2']; ?>" 
                            data-impto="<?php echo $reserva['causar_impuesto']; ?>" 
                            data-nrohab="<?php echo $reserva['num_habitacion']; ?>" 
                            data-idhuesped="<?php echo $reserva['id_huesped']; ?>" 
                            data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
                            href="#myModalCargosConsumo"
                            >
                          <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                          Ingreso Consumos</a>
                        </li>
                        <li>
                          <a 
                            data-toggle  ="modal" 
                            data-target = "#myModalAbonosConsumos"
                            data-id="<?php echo $reserva['num_reserva']; ?>" 
                            data-idhuesped="<?php echo $reserva['id_huesped']; ?>" 
                            data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                            data-nrohab="<?php echo $reserva['num_habitacion']; ?>" 
                            data-apellido1="<?php echo $reserva['apellido1']; ?>" 
                            data-apellido2="<?php echo $reserva['apellido2']; ?>" 
                            data-nombre1="<?php echo $reserva['nombre1']; ?>" 
                            data-nombre2="<?php echo $reserva['nombre2']; ?>" 
                            data-impto="<?php echo $reserva['causar_impuesto']; ?>" 
                            data-llegada="<?php echo $reserva['fecha_llegada']; ?>" 
                            data-salida="<?php echo $reserva['fecha_salida']; ?>" 
                            data-noches="<?php echo $reserva['dias_reservados']; ?>" 
                            data-hombres="<?php echo $reserva['can_hombres']; ?>" 
                            data-mujeres="<?php echo $reserva['can_mujeres']; ?>" 
                            data-ninos="<?php echo $reserva['can_ninos']; ?>" 
                            data-observaciones="<?php echo $reserva['observaciones']; ?>"
                            data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                            data-valor="<?php echo $reserva['valor_reserva']; ?>" 
                            data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
                            >
                          <i class="fa fa-money" aria-hidden="true"></i>Abono a Estadia</a>
                        </li>
                        <?php
                        }
                      ?>                                  
                      <!-- <li>
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
                      </li>  -->
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
                          data-nombre   ="<?php echo $reserva['nombre_completo']; ?>" 
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


