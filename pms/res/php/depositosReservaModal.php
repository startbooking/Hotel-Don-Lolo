<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';
$reserva = $_POST['reserva'];

$datosReserva = $hotel->getReservasDatos($reserva);
$depositos = $hotel->getDepositosReservas($reserva);

?>

<div class="container-fluid" style="padding:0px;margin-top:10px;">
  <form class="form-horizontal" id="formHuespedes" action="#" method="POST">
    <div class="panel panel-success">
      <div class="panel-heading" style="padding:5px;">
        <div class="container-fluid" style="padding:0px;">
          <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">Habitacion</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva['num_habitacion']; ?>" readonly>
            </div>
            <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva['nombre_completo']; ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="llegada" class="col-sm-2 control-label">Llegada</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="llegada" id="llegada" readonly="" value="<?php echo $datosReserva['fecha_llegada']; ?>">
            </div>
            <label for="noches" class="col-sm-1 control-label">Noches</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="noches" id="noches" readonly="" value='<?php echo $datosReserva['dias_reservados']; ?>'>
            </div>
            <label for="salida" class="col-sm-1 control-label">Salida</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="salida" id="salida" readonly="" value="<?php echo $datosReserva['fecha_salida']; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="padding:5px">
        <div class="container-fluid" style="padding:0">
          <div class="table-responsive-lg">
            <table id="example1" class="table modalTable table-bordered">
              <thead class="warning">
                <tr>
                  <th>Deposito</th>
                  <th>Forma de Pago</th>
                  <th>Descripcion</th>
                  <th>Fecha</th>
                  <th>Valor</th>
                  <th>Usuario</th>
                  <th style="width:10%;">Doc</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pagos = 0;
                foreach ($depositos as $deposito) {
                  $pagos = $pagos + $deposito['pagos_cargos'];
                  $docu = $hotel->buscaDocumentoDeposito($deposito['concecutivo_abono']);
                ?>
                  <tr align="right">
                    <td><?php echo $deposito['concecutivo_abono']; ?></td>
                    <td align="left"><?php echo $deposito['descripcion_cargo']; ?></td>
                    <td align="left"><?php echo $deposito['informacion_cargo']; ?></td>
                    <td><?php echo $deposito['fecha_cargo']; ?></td>
                    <td><?php echo number_format($deposito['pagos_cargos'], 2); ?></td>
                    <td><?php echo $hotel->nombreUsuario($deposito['id_usuario']); ?></td>
                    <td>
                      <?php
                      if ($docu != '') { ?>
                        <a class="btn btn-success btn-xs" data-toggle="modal" data-imagen="<?php echo BASE_PMS; ?>uploads/<?php echo $docu; ?>" title="Ver Comprobante de Deposito" href="#myModalMuestraDeposito">
                          <i class="fa fa-picture-o" aria-hidden="true"></i>
                        </a>
                      <?php
                      }
                      ?>
                      <a class="btn btn-info btn-xs" data-toggle="modal" onclick="mostrarRC('<?php echo $deposito['concecutivo_abono'] ?>')" data-recibo="" title="Ver Recibo de Caja">
                        <i class="fa fa-money" aria-hidden="true"></i>
                      </a>
                    </td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="container-fluid" style="padding:5px;background-color:#dff0d8">
            <div class="form-group">
              <label for="apellidos" class="col-sm-3 control-label">Total Deposito</label>
              <div class="col-sm-3">
                <input align="right" type="text" class="form-control" id="saldototal" placeholder="" value="<?php echo number_format($pagos, 2); ?>" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>