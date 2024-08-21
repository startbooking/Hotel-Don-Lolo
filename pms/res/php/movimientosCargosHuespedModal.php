<?php

// require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';
$reserva = $_POST['reserva'];

$datosReserva = $hotel->getReservasDatos($reserva);
$datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$folios = $hotel->getCargosReservaModal($reserva);

$cia = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
$centros = $hotel->getBuscaCentroCia($datosReserva[0]['idCentroCia']);

?>

<div class="container-fluid" style="padding:0px;margin-top:10px;">
	<form class="form-horizontal" id="formHuespedes" action="javascript:guardaHuesped()" method="POST">
    <div class="panel panel-success">
    	<div class="panel-heading" style="padding:5px;">
    		<div class="container-fluid" style="padding:0px;">
					<div class="form-group">
			      <label for="apellidos" class="col-sm-2 control-label">Habitacion</label>
			      <div class="col-sm-2">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva[0]['num_habitacion']; ?>" readonly>
			      </div>
			      <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
			      <div class="col-sm-6">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva[0]['nombre_completo']; ?>" readonly>
			      </div>
		      </div>
					<div class="form-group">
					  <label for="llegada" class="col-sm-2 control-label">Llegada</label>
					  <div class="col-sm-3">
					    <input type="text" class="form-control" name="llegada" id="llegada" readonly="" value="<?php echo $datosReserva[0]['fecha_llegada']; ?>"> 
					  </div>
					  <label for="noches" class="col-sm-1 control-label">Noches</label>
					  <div class="col-sm-2">
					    <input type="text" class="form-control" name="noches" id="noches" readonly="" value='<?php echo $datosReserva[0]['dias_reservados']; ?>'>
					  </div>
					  <label for="salida" class="col-sm-1 control-label">Salida</label>
					  <div class="col-sm-3">
					    <input type="text" class="form-control" name="salida" id="salida" readonly="" value="<?php echo $datosReserva[0]['fecha_salida']; ?>">
					  </div>
					</div>
			    <?php
         if ($datosReserva[0]['id_compania'] != 0) { ?>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Empresa</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $cia[0]['empresa']; ?>" disabled="">
              </div>
              <label for="inputEmail3" class="col-sm-1 control-label">Nit</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="nit" id="nit" value="<?php echo $cia[0]['nit'].'-'.$cia[0]['dv']; ?>" disabled="">
              </div>
            </div>
            <?php
           if ($datosReserva[0]['idCentroCia'] != 0) { ?>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Centro de Costo</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="centroCia" id="centroCia" value="<?php echo $centros[0]['descripcion_centro']; ?>" disabled="">
                </div>
              </div>
              <?php
           }
         }
?>
		    </div>
    	</div>
    	<div class="panel-body" style="padding:5px;max-height:360px; overflow:auto;">
			  <div class="container-fluid" style="padding:0">
			  	<h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Consumo Huesped</h5>
          <div class="table-responsive-lg" >
            <table id="example1" class="table table-bordered">
              <thead class="warning">
                <tr>
                  <th>Detalle</th>
                  <th>Consumos</th>
                  <th>Impuestos</th>
                  <th>Total</th>
                  <th style="text-align:center;">Abonos</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $consumos = 0;
$impto = 0;
$pagos = 0;
foreach ($folios as $folio1) {
    $consumos = $consumos + $folio1['monto_cargo'];
    $impto = $impto + $folio1['impuesto'];
    $pagos = $pagos + $folio1['pagos_cargos'];
    ?>
                  <tr style="text-align:right;">
                    <td style="padding:4px;text-align:left;"><?php echo $folio1['descripcion_cargo']; ?></td>
                    <td style="padding:4px"><?php echo number_format($folio1['monto_cargo'], 2); ?></td>
                    <td style="padding:4px"><?php echo number_format($folio1['impuesto'], 2); ?></td>
                    <td style="padding:4px"><?php echo number_format($folio1['monto_cargo'] + $folio1['impuesto'], 2); ?></td>
                    <td style="padding:4px"><?php echo number_format($folio1['pagos_cargos'], 2); ?></td>
                    <td style="padding:4px"><?php echo date($folio1['fecha_cargo']); ?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="container-fluid" style="padding:5px;background-color:#dff0d8">
            <div class="form-group">
              <label for="apellidos" class="col-sm-3 control-label">Consumos</label>
              <div class="col-sm-3">
                <input type="text" class="form-control derecha" id="consumo" value="<?php echo number_format($consumos, 2); ?>" readonly>
              </div>
              <label for="apellidos" class="col-sm-3 control-label">Abonos / Pagos</label>
              <div class="col-sm-3">
                <input type="text" class="form-control derecha" id="apellidos" placeholder="" value="<?php echo number_format($pagos, 2); ?>" readonly>
              </div>
            </div>          
            <div class="form-group">
              <label for="apellidos" class="col-sm-3 control-label">Impuesto</label>
              <div class="col-sm-3">
                <input type="text" class="form-control derecha" id="imptos" placeholder="" value="<?php echo number_format($impto, 2); ?>" readonly>
              </div>
              <label for="apellidos" class="col-sm-3 control-label">Total Folio</label>
              <div class="col-sm-3">
                <input type="text" class="form-control derecha" id="saldototal" placeholder="" value="<?php echo number_format(($consumos + $impto) - $pagos, 2); ?>" readonly>
              </div>
            </div>
          </div>				
        </div>				  
    	</div>
    </div>
	</form>
</div>
