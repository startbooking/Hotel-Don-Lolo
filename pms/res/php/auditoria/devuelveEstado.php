<?php 
  /// require '../../../res/php/app_topHotel.php'; 

	$fecha       = FECHA_PMS;
	$fechanueva  = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;	
	$limpiaCargo = $hotel->limpiaCargoHabitaciones();
	$limpiaAud   = $hotel->EstadoAuditoriaPMS(2);

?>
