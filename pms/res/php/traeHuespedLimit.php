<?php 
  require '../../../res/php/app_topHotel.php'; 
	
  $regis      = $_POST['regis'];
  $filas      = $_POST['filas']; 
  
  // echo $regis,$filas;
  
  $huespedes = $hotel->getPerfilHuespedes($regis,$filas);

  echo json_encode($huespedes);
 
?>
 