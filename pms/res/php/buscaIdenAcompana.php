<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id    = $_POST['id'];
	$fecha = FECHA_PMS; 
	
	$huesped = $hotel->buscaHuespedAcompanante($id);

	echo json_encode($huesped);

 ?>
