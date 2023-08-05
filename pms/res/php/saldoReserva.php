<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $reserva             =  $_POST['reserva'];
  $_SESSION['reserva'] = $reserva;

  $consumos = $hotel->getConsumosReserva($reserva);
  if(count($consumos)==0){
		$consumos[0]['cargos'] = 0;
		$consumos[0]['imptos'] = 0;
		$consumos[0]['pagos']  = 0;
  }
  $totalFolio = ($consumos[0]['cargos'] + $consumos[0]['imptos']) - $consumos[0]['pagos'];
  echo $totalFolio;
 ?>
