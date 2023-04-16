

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
  $reservas = $hotel->getReservasActuales(1);

  foreach ($reservas as $reserva) {
		$entrastr = strtotime($reserva['fecha_llegada']);
		$salidatr = strtotime($reserva['fecha_salida']);
		$reser    = $reserva['num_reserva'];
		$cambia   = $hotel->updatefechaReservaStr($reser,$entrastr, $salidatr);
  	echo $cambia;
  	# code...
  }

?>