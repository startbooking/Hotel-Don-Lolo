<?php
  require '../../../res/php/app_topHotel.php';
  extract($_POST);
  $reservas = $hotel->traeBalanceHabitaciones('CA');
  
?>

<div class="table-responsive">
  <table id="example1" class="table modalTable table-hover">
    <thead>
      <tr class="warning" style="font-weight: bold">
        <td>Hab.</td>
        <td>Huesped</td>
        <td>Compañia</td>
        <td>Tarifa</td>
        <td>Llegada</td>
        <td>Salida</td>
        <td style="text-align:center;">Consumos</td>
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
          $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
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
          <td style="width:8%;display: inline-flex;">
            <span class="btn btn-default" style="padding:0 2px;font-size:12px;">
              <?php echo $reserva['num_habitacion']; ?>
            </span>
            <?php
            if ($reserva['causar_impuesto'] == 2) { ?>
              <span class="btn btn-default faReservas" title="Sin Impuestos" style="padding:2px;">
                <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                <i style="font-size:12px" class="fa fa-ban text-danger"></i>
              </span>
            <?php
            }
            if (count($depositos) != 0) { ?>
              <span class="btn btn-success faReservas" title="Reserva con Depositos" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                <i class="fa fa-usd fa-stack-1x fa-inverse "></i>
              </span>
            <?php
            }
            if (!empty($reserva['observaciones'])) { ?>
              <span class="btn btn-info faReservas" title="Observaciones a la Reserva" data-toggle="modal" data-target="#myModalVerObservaciones" data-reserva="<?php echo $reserva['num_reserva']; ?>" data-estado="1">
                <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
              </span>
            <?php
            }
            if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
              <span class="btn btn-warning faReservas" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;">
                <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i>
              </span>
            <?php
            }
            ?>
          </td>
          <td>
            <span class="btn alert-info alert-function" style="padding:1px 4px; font-size:12px;font-weight: bold;">
              <?php echo substr($reserva['nombre_completo'], 0, 35); ?></span>
            <?php
            $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
            if (count($acompanas) > 0) {
              foreach ($acompanas as $key => $acompana) { ?>
                <span class="btn alert-success alert-function" style="padding:1px 4px; margin-left:15px;margin-top:3px;font-size:10px;font-weight: bold;">
                  <?php echo substr($acompana['nombre_completo'], 0, 35); ?>
                </span>
            <?php
              }
            }
            ?>
          </td>
          <td style="width: 20%"><?php echo substr($nombrecia, 0, 35); ?></td>
          <td style="width: 7%;text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
          <td style="width: 7%"><?php echo $reserva['fecha_llegada']; ?></td>
          <td style="width: 7%"><?php echo $reserva['fecha_salida']; ?></td>
          <td style="width: 7%;text-align:right;cursor: pointer;">
            <a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($reserva['cargos'], 2); ?></a>
          </td>
          <td style="width: 7%;text-align:right;cursor: pointer;">
            <a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($reserva['pagos'], 2); ?></a>
          </td>
          <td style="width: 7%;text-align:right;cursor: pointer;">
            <a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($reserva['cargos'] - $reserva['pagos'], 2); ?></a>
          </td>
          <td style="padding:3px;width: 15%">
            <nav class="navbar navbar-default " style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                <ul class="nav navbar-nav" style="margin :0;width:100%;">
                  <li class="dropdown" style="margin :0;width:100%;">
                    <a href="#" class="dropdown-toggle aSub" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 700;color:#000">Ficha Facturacion<span class="caret caretSub"></span></a>
                    <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">
                      <?php
                      if ($vigencia == 0) { ?>
                        <li>
                          <a 
                            data-toggle="modal" 
                            data-id="<?php echo $reserva['num_reserva']; ?>" 
                            onclick="movimientosFactura(<?php echo $reserva['num_reserva']; ?>)" 
                            href="">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            Facturacion</a>
                        </li>
                      <?php
                      } ?>
                      <li>
                        <a 
                          data-toggle="modal" 
                          data-target="#myModalInformacionReserva" 
                          data-id="<?php echo $reserva['num_reserva']; ?>" 
                          data-nombre="<?php echo $reserva['nombre_completo']; ?>">
                          <i class="fa fa-address-card" aria-hidden="true"></i>Informacion Estadia</a>
                      </li>
                      <li>
                        <a 
                          data-toggle="modal" 
                          data-id="<?php echo $reserva['id_huesped']; ?>" 
                          data-nombre="<?php echo $reserva['nombre_completo']; ?>" href="#myModalModificaPerfilHuesped">
                          <i class="fa fa-user-md" aria-hidden="true"></i>
                          Perfil Huesped</a>
                      </li>
                      <li>
                        <a 
                          data-toggle="modal" 
                          data-id="<?php echo $reserva['id_huesped']; ?>" 
                          data-idres="<?php echo $reserva['num_reserva']; ?>" 
                          data-idcia="<?php echo $reserva['id_compania']; ?>" 
                          data-nombre="<?php echo $reserva['nombre_completo']; ?>" href="#myModalAsignarCompania">
                          <i class="fa fa-window-restore" aria-hidden="true"></i>
                          Asignar Compañia</a>
                      </li>
                      <?php
                      if ($reserva['id_compania'] != 0) { ?>
                        <li>
                          <a 
                            data-toggle="modal" 
                            data-id="<?php echo $reserva['id_compania']; ?>" 
                            data-empresa="<?php echo $nombrecia; ?>" href="#myModalModificaPerfilCia">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Datos Compañia</a>
                        </li>
                      <?php
                      }
                      if ($reserva['num_habitacion'] != CTA_DEPOSITO) { ?>
                        <li>
                          <a data-toggle="modal" 
                          data-id="<?php echo $reserva['num_reserva']; ?>" 
                          data-impto="<?php echo $reserva['causar_impuesto']; ?>" data-nrohab="<?php echo $reserva['num_habitacion']; ?>" data-idhuesped="<?php echo $reserva['id_huesped']; ?>" data-nombre="<?php echo $reserva['nombre_completo']; ?>" href="#myModalCargosConsumo">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Ingreso Consumos</a>
                        </li>
                        <li>
                          <a 
                            data-toggle="modal" 
                            data-target="#myModalAbonosConsumos" 
                            data-id="<?php echo $reserva['num_reserva']; ?>" 
                            data-idhuesped="<?php echo $reserva['id_huesped']; ?>" 
                            data-nrohab="<?php echo $reserva['num_habitacion']; ?>" 
                            data-observaciones="<?php echo $reserva['observaciones']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                            data-valor="<?php echo $reserva['valor_reserva']; ?>" data-nombre="<?php echo $reserva['nombre_completo']; ?>">
                            <i class="fa-solid fa-money-bills"></i>Abono a Estadia</a>
                        </li>
                      <?php
                      }
                      ?>
                      <li>
                        <a 
                        data-toggle="modal" 
                        data-id="<?php echo $reserva['num_reserva']; ?>" 
                        data-cia="<?php echo $reserva['id_compania']; ?>" 
                        data-nrohab="<?php echo $reserva['num_habitacion']; ?>" 
                        data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                        data-nombrecia="<?php echo $nombrecia; ?>" 
                        data-nitcia="<?php echo $nitcia; ?>" 
                        data-observa="<?php echo $reserva['observaciones']; ?>" href="#myModalAdicionaObservaciones">
                          <i class="fa fa-commenting" aria-hidden="true"></i>Adicionar Observaciones</a>
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