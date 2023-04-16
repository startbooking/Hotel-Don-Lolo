<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$reserva =  $_POST['reserva'];

  $consumos = $hotel->getConsumosReserva($reserva);
  if(count($consumos)==0){
		$consumos[0]['cargos'] = 0;
		$consumos[0]['imptos'] = 0;
		$consumos[0]['pagos']  = 0;
  }
  $totalFolio = ($consumos[0]['cargos'] + $consumos[0]['imptos']) - $consumos[0]['pagos'];
 ?>

<div class="container-fluid" style="padding:15px;">
	<div class="form-group">
    <label for="apellidos" class="col-sm-2 control-label">Consumos</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="consumo" value="<?php echo number_format($consumos[0]['cargos'],2) ?>" readonly>
    </div>
    <label for="apellidos" class="col-sm-2 control-label">Abonos / Pagos</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo number_format($consumos[0]['pagos'],2) ?>" readonly>
    </div>
    <label for="apellidos" class="col-sm-2 control-label">Impuesto</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo number_format($consumos[0]['imptos'],2)  ?>" readonly>
    </div>
  </div>    			
	<div class="form-group right">
    <label for="apellidos" class="col-sm-2 col-sm-offset-8 control-label">Total Cuenta</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo number_format($totalFolio,2)?>" readonly>
    </div>
  </div>
</div>