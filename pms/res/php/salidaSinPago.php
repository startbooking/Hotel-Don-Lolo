<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$folio     = $_POST['folio'];
	$reserva   = $_POST['reserva'];
	$room      = $_POST['nrohab'];
	$usuario   = $_POST['usuario'];
	$idusuario = $_POST['usuario_id'];
	$fecha     = FECHA_PMS;	
	
	$salida   = $hotel->updateReservaHuespedSalida($reserva,$usuario,$idusuario,$fecha);		
	$habSucia = $hotel->updateEstadoHabitacion($room);		

 ?>