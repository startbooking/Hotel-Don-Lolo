<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$data = json_decode(file_get_contents('php://input'), true);
	extract($data);

	$tarifas = $hotel->getTarifasTipoHabitacion($tipoHabitacion, $llegada, $salida) ;

	echo json_encode($tarifas) ;

 ?>
